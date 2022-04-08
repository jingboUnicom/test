<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Invoice;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Invoices';

    protected static ?string $label = 'Invoice';

    protected static ?string $pluralLabel = 'Invoices';

    protected static ?string $slug = 'invoices';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\BelongsToSelect::make('company_id')
                                    ->relationship('company', 'company_name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Company')
                                    ->columnSpan(12),
                                Forms\Components\BelongsToSelect::make('user_id')
                                    ->relationship('user', 'contact_name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Main Contact')
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('number')
                                    ->label('Invoice Number')
                                    ->columnSpan(12),
                                Forms\Components\FileUpload::make('file')
                                    ->directory('invoice-files')
                                    ->label('Invoice File')
                                    ->columnSpan(12),
                                \App\Forms\Components\FileDownload::make('download_file')
                                    ->download('file')
                                    ->columnSpan(12),
                                Forms\Components\DatePicker::make('issued_at')->format('Y-m-d')
                                    ->label('Issue Date')
                                    ->columnSpan(6),
                                Forms\Components\DatePicker::make('due_at')->format('Y-m-d')
                                    ->label('Due Date')
                                    ->columnSpan(6),
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
                Tables\Columns\TextColumn::make('number')
                    ->label('Invoice Number')
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
                Tables\Columns\TextColumn::make('issued_at')
                    ->dateTime('d/m/Y')
                    ->label('Issue Date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_at')
                    ->dateTime('d/m/Y')
                    ->label('Due Date')
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->super) {
            return $query;
        }

        // Policy Notes: Employers CAN BROWSE/READ/EDIT only invoices belong to him/her or his/her company
        if ($user->employer) {
            return $query->where(function ($query) use ($user) {
                $query->where('user_id', $user->id);

                if ($user->company) {
                    $query->orWhere('company_id', $user->company->id);
                }
            });
        }
    }
}
