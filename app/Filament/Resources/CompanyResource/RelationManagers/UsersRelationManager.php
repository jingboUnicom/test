<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class UsersRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'contacts';

    protected static ?string $recordTitleAttribute = 'contact_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
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
                                    ->email()
                                    ->unique(User::class, 'email', fn ($record) => $record)
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
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
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
