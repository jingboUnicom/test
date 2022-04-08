<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Subcategory;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JobAdResource\Pages;
use App\Filament\Resources\JobAdResource\RelationManagers;

class JobAdResource extends Resource
{
    protected static ?string $model = Vacancy::class;

    protected static ?string $navigationGroup = 'Job Adder Management';

    protected static ?int $navigationSort = 12;

    protected static ?string $navigationIcon = 'heroicon-o-volume-up';

    protected static ?string $navigationLabel = 'Job Ads';

    protected static ?string $label = 'Job Ad';

    protected static ?string $pluralLabel = 'Job Ads';

    protected static ?string $slug = 'job-ads';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->super;
    }

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
                                Forms\Components\TextInput::make('ja_ad_id')
                                    ->label('Job Ad Reference')
                                    ->columnSpan(4),
                                Forms\Components\TextInput::make('ja_job_id')
                                    ->label('Job Reference')
                                    ->columnSpan(4),
                                Forms\Components\BelongsToSelect::make('state_id')
                                    ->relationship('state', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label('State')
                                    ->columnSpan(4),
                                Forms\Components\DateTimePicker::make('posted_at')
                                    ->label('Posting Date')
                                    ->columnSpan(12),
                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options(Vacancy::STATUSES)
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
                                Forms\Components\BelongsToSelect::make('work_id')
                                    ->relationship('work', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Work Type')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('job_title')
                                    ->label('Job Title')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('salary_min')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->label('Salary Minimum')
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('salary_max')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->label('Salary Maximum')
                                    ->columnSpan(6),
                                Forms\Components\Textarea::make('short_description')
                                    ->rows(5)
                                    ->label('Short Description')
                                    ->columnSpan(12),
                                Forms\Components\Repeater::make('bullet_points')
                                    ->schema([
                                        Forms\Components\TextInput::make('point'),
                                    ])->columnSpan(12),
                                Forms\Components\RichEditor::make('job_description')
                                    ->label('Job Description')
                                    ->fileAttachmentsDirectory('vacancy-files')
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
                                Forms\Components\BelongsToSelect::make('location_id')
                                    ->relationship('location', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Location')
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
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Job Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->label('State')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('posted_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->label('Posted')
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
            'index' => Pages\ListJobAds::route('/'),
            'create' => Pages\CreateJobAd::route('/create'),
            'view' => Pages\ViewJobAd::route('/{record}'),
            'edit' => Pages\EditJobAd::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return $query->whereIn('status', [Vacancy::STATUS_SYNCED_WITH_JOB_ADDER]);
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    public static function canCreate(): bool
    {
        $user = auth()->user();

        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();

        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    public static function canDelete(Model $record): bool
    {
        $user = auth()->user();

        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    public static function canDeleteAny(): bool
    {
        $user = auth()->user();

        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }
}
