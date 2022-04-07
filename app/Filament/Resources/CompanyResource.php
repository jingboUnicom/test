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

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationLabel = 'Company';

    protected static ?string $label = 'Company';

    protected static ?string $pluralLabel = 'Company';

    protected static ?string $slug = 'company';

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
                                Forms\Components\BelongsToSelect::make('membership_id')
                                    ->relationship('membership', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Membership Type')
                                    ->required()
                                    ->columnSpan(12),
                            ])->columns(12),
                    ])->hidden(function () {
                        $user = Auth::user();

                        return !$user->super;
                    })->columnSpan(12),
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
                                // Field Notes: Employers can select only himself/herself
                                // Field Notes: Admins can select only user who does not have a company yet
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
                                Forms\Components\BelongsToSelect::make('category_id')
                                    ->relationship('category', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Industry')
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
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Contact Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('membership.name')
                    ->label('Membership Type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.contact_name')
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

        // Policy Notes: Employers can BROWSE/READ/EDIT only his/her company or no company
        if ($user->employer) {
            if ($user->company) {
                return $query->where('id', $user->company->id);
            } else {
                return $query->where('id', -1);
            }
        }
    }
}
