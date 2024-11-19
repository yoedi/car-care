<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;
use App\Models\BookingTransaction;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),
                TextInput::make('trx_id')
                ->required()
                ->maxLength(255),

                TextInput::make('phone_number')
                ->required()
                ->maxLength(255),
                TextInput::make('total_amount')
                ->required()
                ->maxLength(255)
                ->prefix('IDR'),

                DatePicker::make('started_at')
                ->required(),
                TimePicker::make('time_at')
                ->required(),

                Select::make('is_paid')
                ->options([
                    true => 'Paid',
                    false => 'Not Paid'
                ])
                ->required(),

                Select::make('car_service_id')
                ->relationship('service_details', 'name')
                ->searchable()
                ->preload()
                ->required(),
                Select::make('car_store_id')
                ->relationship('store_details', 'name')
                ->searchable()
                ->preload()
                ->required(),

                FileUpload::make('proof')
                ->image()
                ->required(),

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('trx_id')
                ->searchable(),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('service_details.name'),
                TextColumn::make('started_at'),
                TextColumn::make('time_at'),
                TextColumn::make('is_paid')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Sudah Bayar?'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
