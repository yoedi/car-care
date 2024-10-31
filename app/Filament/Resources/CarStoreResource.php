<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarStoreResource\Pages;
use App\Filament\Resources\CarStoreResource\RelationManagers;
use App\Models\CarStore;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nette\Utils\ImageColor;

use function App\isOpenValue2;

class CarStoreResource extends Resource
{
    protected static ?string $model = CarStore::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->helperText('Masukan nama toko anda.')
                ->required()
                ->maxLength(50),

                TextInput::make('phone_number')
                ->helperText('Masukan nomor telepon toko anda.')
                ->numeric()
                ->maxLength(12),

                TextInput::make('cs_name')
                ->helperText('Masukan nama customer service toko anda.')
                ->maxLength(50),

                Select::make('is_open')
                ->options([
                    true => 'Open',
                    false => 'Closed',
                ])
                ->required(),

                Select::make('is_full')
                ->options([
                    true => 'Full Booked',
                    false => 'Available',
                ])
                ->required(),
                

                Select::make('city_id')
                ->relationship('city', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->label('City'),

                Textarea::make('address')
                ->helperText('Masukan alamat toko anda.')
                ->required()
                ->rows(10)
                ->cols(20),

                FileUpload::make('thumbnail'),

                Repeater::make('storeServices')
                ->relationship()
                ->required()
                ->schema([
                    Select::make('car_service_id')
                    ->relationship('service', 'name')
                    ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),

                TextColumn::make('city_id')
                ->label('Kota')
                ->searchable(),

                IconColumn::make('is_open')
                ->label('Buka')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle'),

                IconColumn::make('is_full')
                ->label('Tersedia')
                ->boolean()
                ->trueColor('danger')
                ->falseColor('success')
                ->trueIcon('heroicon-o-x-circle')
                ->falseIcon('heroicon-o-check-circle'),

                ImageColumn::make('thumbnail'),
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

    // public function isOpenValue(int $param): string
    // {
    //     return $param === 1 ? "Buka" : "Tutup";
    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarStores::route('/'),
            'create' => Pages\CreateCarStore::route('/create'),
            'edit' => Pages\EditCarStore::route('/{record}/edit'),
        ];
    }
}
