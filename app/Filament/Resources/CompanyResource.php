<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Company;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationLabel = 'Company';

    protected static ?string $label = 'Company';

    protected static ?string $pluralLabel = 'Company';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\TextInput::make('company_name')
                                    ->label('Company Name')
                                    ->required()
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('legal_name')
                                    ->label('Legal Name')
                                    ->columnSpan(12),
                                // Field Notes: Employers can only select his/her own user id
                                // Field Notes: Can only select user who does not have a company yet
                                Forms\Components\BelongsToSelect::make('user_id')
                                    ->relationship('user', 'contact_name', function (Builder $query) {
                                        $user = Auth::user();

                                        if ($user->employer) {
                                            return $query->where('id', $user->id);
                                        }

                                        return $query->doesntHave('company');
                                    })
                                    ->preload()
                                    ->searchable()
                                    ->label('Main Contact')
                                    ->columnSpan(12),
                                Forms\Components\FileUpload::make('logo')
                                    ->image()
                                    ->directory('company-files')
                                    ->label('Logo')
                                    ->columnSpan(12),
                                \App\Forms\Components\FileDownload::make('download_logo')
                                    ->download('logo')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('address')
                                    ->label('Address')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Phone')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('url')
                                    ->label('URL')
                                    ->columnSpan(12),
                            ])->columns(12),
                    ])->columnSpan(6),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\BelongsToSelect::make('category_id')
                                    ->relationship('category', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Industry')
                                    ->columnSpan(12),
                                // Field Notes: Admin use only
                                Forms\Components\Select::make('membership_type')
                                    ->label('Membership Type')
                                    ->options(Company::MEMBERSHIP_TYPES)
                                    ->columnSpan(12)
                                    ->hidden(function () {
                                        $user = Auth::user();

                                        return !$user->super;
                                    }),
                            ])->columns(12),
                    ])->columnSpan(6),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Contact Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('membership_type')
                    ->label('Membership Type')
                    ->enum(Company::MEMBERSHIP_TYPES)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Main Contact')
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
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->super) {
            return $query;
        }

        if ($user->agent) {
            return $query;
        }

        // Policy Notes: Employers CAN BROWSE/READ/EDIT Companies, only his/her own companies or no companies
        if ($user->employer) {
            if ($user->company) {
                return $query->where('id', $user->company->id);
            } else {
                return $query->where('id', -1);
            }
        }
    }
}
