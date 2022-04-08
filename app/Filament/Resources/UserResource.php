<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Contacts';

    protected static ?string $label = 'Contact';

    protected static ?string $pluralLabel = 'Contacts';

    protected static ?string $slug = 'contacts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field Notes: For admin use only
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('For Admin Use Only')
                                    ->columnSpan(12),
                                Forms\Components\Placeholder::make('Role')
                                    ->columnSpan(12),
                                Forms\Components\Toggle::make('super')
                                    ->label('Admin')
                                    ->columnSpan(6),
                                Forms\Components\Toggle::make('employer')
                                    ->label('Employer')
                                    ->columnSpan(6),
                            ])->columns(12),
                    ])->hidden(function () {
                        $user = Auth::user();

                        return !$user->super;
                    })->columnSpan(12),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('First Name')
                                    ->required()
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('surname')
                                    ->label('Last Name')
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->required()
                                    ->email()
                                    ->unique(User::class, 'email', fn ($record) => $record)
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('password')
                                    ->label('New Password')
                                    ->password()
                                    ->same('password_confirmation')
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                    ->dehydrated(fn ($state): bool => (bool) ($state))
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('password_confirmation')
                                    ->label('Confirm Password')
                                    ->password()
                                    ->columnSpan(12),
                                Forms\Components\FileUpload::make('profile_photo_path')
                                    ->image()
                                    ->directory('profile-photos')
                                    ->label('Photo')
                                    ->columnSpan(12),
                                \App\Forms\Components\FileDownload::make('download_profile_photo_path')
                                    ->download('profile_photo_path')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('position')
                                    ->label('Position')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('department')
                                    ->label('Department')
                                    ->columnSpan(12),
                                // Field Notes: Employers can select only his/her company or no company
                                // Field Notes: Employers are required to select
                                Forms\Components\BelongsToSelect::make('company_id')
                                    ->relationship('contact', 'company_name', function (Builder $query) {
                                        $user = Auth::user();

                                        if ($user->employer) {
                                            if ($user->company) {
                                                return $query->where('id', $user->company->id);
                                            } else {
                                                return $query->where('id', -1);
                                            }
                                        }

                                        return $query;
                                    })
                                    ->preload()
                                    ->searchable()
                                    ->label('Company')
                                    ->required(function () {
                                        $user = Auth::user();

                                        if ($user->employer) {
                                            return true;
                                        }

                                        return false;
                                    })
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Phone')
                                    ->columnSpan(12),
                            ])->columns(12),
                    ])->columnSpan(12),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Reference')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_name')
                    ->label('Contact Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact.company_name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->label('Updated')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->super) {
            return $query;
        }

        // Policy Notes: Employers CAN BROWSE/READ/ADD/EDIT/DELETE only his/her company's users or no users
        if ($user->employer) {
            if ($user->company) {
                return $query->where('company_id', $user->company->id);
            } else {
                return $query->where('id', $user->id);
            }
        }
    }
}
