<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use App\Models\Candidate;
use App\Models\Subcategory;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CandidateResource\Pages;
use App\Filament\Resources\CandidateResource\RelationManagers;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Candidates';

    protected static ?string $label = 'Candidate';

    protected static ?string $pluralLabel = 'Candidates';

    protected static ?string $slug = 'candidates';

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
                                Forms\Components\BelongsToManyMultiSelect::make('company_id')
                                    ->relationship('companies', 'company_name')
                                    ->preload()
                                    ->label('Company')
                                    ->columnSpan(12),
                                Forms\Components\BelongsToManyMultiSelect::make('user_id')
                                    ->relationship('users', 'contact_name')
                                    ->preload()
                                    ->label('Main Contacts')
                                    ->columnSpan(12),
                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options(Candidate::STATUSES)
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
                                Forms\Components\BelongsToSelect::make('vacancy_id')
                                    ->relationship('vacancy', 'job_title')
                                    ->preload()
                                    ->searchable()
                                    ->label('Job Title')
                                    ->columnSpan(12),
                                Forms\Components\Select::make('category_id')
                                    ->options(Category::all()->pluck('name', 'id')->toArray())
                                    ->reactive()
                                    ->label('Category')
                                    ->columnSpan(6),
                                Forms\Components\Select::make('subcategory_id')
                                    ->options(function (Closure $get) {
                                        return Subcategory::where('category_id', $get('category_id'))->pluck('name', 'id')->toArray();
                                    })
                                    ->label('Sub Category')
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('name')
                                    ->label('First Name')
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('surname')
                                    ->label('Last Name')
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('location')
                                    ->label('Location')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('current_job_title')
                                    ->label('Current Job Title')
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('experience')
                                    ->label('Experience')
                                    ->rows(5)
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('skills')
                                    ->label('Skills')
                                    ->rows(5)
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('education')
                                    ->label('Education')
                                    ->rows(5)
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('languages')
                                    ->label('Languages')
                                    ->rows(5)
                                    ->columnSpan(12),
                            ])->columns(12),
                    ])->columnSpan(6),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\FileUpload::make('photo')
                                    ->directory('candidate-files')
                                    ->label('Photo')
                                    ->columnSpan(12),
                                \App\Forms\Components\FileDownload::make('download_photo')
                                    ->download('photo')
                                    ->columnSpan(12),
                                Forms\Components\FileUpload::make('resume')
                                    ->directory('candidate-files')
                                    ->label('Resume')
                                    ->columnSpan(12),
                                \App\Forms\Components\FileDownload::make('download_resume')
                                    ->download('resume')
                                    ->columnSpan(12),
                                Forms\Components\FileUpload::make('cover_letter')
                                    ->directory('candidate-files')
                                    ->label('Cover Letter')
                                    ->columnSpan(12),
                                \App\Forms\Components\FileDownload::make('download_cover_letter')
                                    ->download('cover_letter')
                                    ->columnSpan(12),
                            ])->columns(12),
                    ])->columnSpan(6),
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
                Tables\Columns\TextColumn::make('candidate_name')
                    ->label('Candidate Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_job_title')
                    ->label('Current Job Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->enum(Candidate::STATUSES)
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
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'view' => Pages\ViewCandidate::route('/{record}'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->super) {
            return $query;
        }

        // Policy Notes: Employers CAN BROWSE/READ only candidates belong to him/her or his/her company
        if ($user->employer) {
            if ($user->candidates->count() || ($user->company && $user->company->candidates->count())) {
                return $query;
            } else {
                return $query->where('id', -1);
            }
        }
    }
}
