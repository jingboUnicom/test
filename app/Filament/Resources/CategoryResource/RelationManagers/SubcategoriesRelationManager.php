<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class SubcategoriesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'subcategories';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\BelongsToSelect::make('category_id')
                //     ->relationship('category', 'name')
                //     ->preload()
                //     ->searchable()
                //     ->label('Category')
                //     ->required()
                //     ->columnSpan(12),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->columnSpan(12),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
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
}
