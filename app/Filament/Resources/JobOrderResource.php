<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Arr;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JobOrderResource\Pages;
use App\Filament\Resources\JobOrderResource\RelationManagers;

class JobOrderResource extends Resource
{
    protected static ?string $model = Vacancy::class;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Job Orders';

    protected static ?string $label = 'Job Order';

    protected static ?string $pluralLabel = 'Job Orders';

    protected static ?string $slug = 'job-orders';

    protected static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();

        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
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
                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options(Arr::except(Vacancy::STATUSES, Vacancy::STATUS_SYNCED))
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
                                // Field Notes: Employers can select only his/her company or no company
                                // Field Notes: Employers are required to select
                                Forms\Components\BelongsToSelect::make('company_id')
                                    ->relationship('company', 'company_name', function (Builder $query) {
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
                                    ->hidden(function () {
                                        $user = Auth::user();

                                        return !$user->super;
                                    })
                                    ->columnSpan(6),
                                // Field Notes: Employers can select only himself/herself
                                // Field Notes: Employers are required to select
                                Forms\Components\BelongsToSelect::make('user_id')
                                    ->relationship('user', 'contact_name', function (Builder $query) {
                                        $user = Auth::user();

                                        if ($user->employer) {
                                            return $query->where('id', $user->id);
                                        }

                                        return $query;
                                    })
                                    ->preload()
                                    ->searchable()
                                    ->label('Primary Contact')
                                    ->hidden(function () {
                                        $user = Auth::user();

                                        return !$user->super;
                                    })
                                    ->columnSpan(6),
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
                Tables\Columns\TextColumn::make('company.company_name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.contact_name')
                    ->label('Primary Contact')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->enum(Vacancy::STATUSES)
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
            'index' => Pages\ListJobOrders::route('/'),
            'create' => Pages\CreateJobOrder::route('/create'),
            'view' => Pages\ViewJobOrder::route('/{record}'),
            'edit' => Pages\EditJobOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->super) {
            return $query->where(function ($query) {
                $query->whereIn('status', [Vacancy::STATUS_OPEN, Vacancy::STATUS_HOLD])->orWhereNull('status');
            });
        }

        // Policy Notes: Employers CAN BROWSE/READ/EDIT only vacancies belong to him/her or his/her company
        if ($user->employer) {
            return $query->where(function ($query) use ($user) {
                $query->where('user_id', $user->id);

                if ($user->company) {
                    $query->orWhere('company_id', $user->company->id);
                }
            })->where(function ($query) {
                $query->whereIn('status', [Vacancy::STATUS_OPEN, Vacancy::STATUS_HOLD]);
            });
        }
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
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
            return true;
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
            return true;
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
