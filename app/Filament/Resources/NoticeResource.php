<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Notice;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NoticeResource\Pages;
use App\Filament\Resources\NoticeResource\RelationManagers;

class NoticeResource extends Resource
{
    protected static ?string $model = Notice::class;

    protected static ?string $navigationGroup = 'Portal Management';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-bell';

    protected static ?string $navigationLabel = 'Notices';

    protected static ?string $label = 'Notice';

    protected static ?string $pluralLabel = 'Notices';

    protected static ?string $slug = 'notices';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->columnSpan(12),
                                Forms\Components\DatePicker::make('started_at')->format('Y-m-d')
                                    ->label('Start Date')
                                    ->columnSpan(6),
                                Forms\Components\DatePicker::make('ended_at')->format('Y-m-d')
                                    ->label('End Date')
                                    ->columnSpan(6),
                                Forms\Components\RichEditor::make('description')
                                    ->fileAttachmentsDirectory('notice-files')
                                    ->label('Description')
                                    ->required()
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
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
            'index' => Pages\ListNotices::route('/'),
            'create' => Pages\CreateNotice::route('/create'),
            'view' => Pages\ViewNotice::route('/{record}'),
            'edit' => Pages\EditNotice::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->super) {
            return $query;
        }

        if ($user->employer) {
            return $query;
        }
    }
}
