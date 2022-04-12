<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Interview;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InterviewResource\Pages;
use App\Filament\Resources\InterviewResource\RelationManagers;

class InterviewResource extends Resource
{
    protected static ?string $model = Interview::class;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationLabel = 'Interviews';

    protected static ?string $label = 'Interview';

    protected static ?string $pluralLabel = 'Interviews';

    protected static ?string $slug = 'interviews';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                // Field Notes: Employers can select only his/her company's contacts
                                Forms\Components\BelongsToSelect::make('user_id')
                                    ->relationship('user', 'contact_name', function (Builder $query) {
                                        $user = Auth::user();

                                        if ($user->employer) {
                                            if ($user->company) {
                                                return $query->where('company_id', $user->company->id);
                                            } else {
                                                return $query->where('id', -1);
                                            }
                                        }

                                        return $query;
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->label('Main Contact')
                                    ->columnSpan(12),
                                Forms\Components\BelongsToSelect::make('candidate_id')
                                    ->relationship('candidate', 'candidate_name')
                                    ->searchable()
                                    ->preload()
                                    ->label('Candidate')
                                    ->disabled(function () {
                                        $user = Auth::user();

                                        return $user->employer;
                                    })
                                    ->columnSpan(12),
                                Forms\Components\DateTimePicker::make('interview_at')->format('Y-m-d H:i:s')
                                    ->label('Interview Time')
                                    ->columnSpan(12),
                            ])->columns(12),
                    ])->columnSpan(12),
                // Field Notes: For communication use only
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('For Communication Use Only')
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('notes')
                                    ->label('Notes')
                                    ->rows(5)
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
                Tables\Columns\TextColumn::make('candidate.candidate_name')
                    ->label('Candidate Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.contact_name')
                    ->label('Main Contact')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interview_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->label('Interview Time')
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
            'index' => Pages\ListInterviews::route('/'),
            'create' => Pages\CreateInterview::route('/create'),
            'view' => Pages\ViewInterview::route('/{record}'),
            'edit' => Pages\EditInterview::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->super) {
            return $query;
        }

        // Policy Notes: Employers CAN BROWSE/READ only interviews belong to him/her
        if ($user->employer) {
            return $query->where('user_id', $user->id);
        }
    }
}
