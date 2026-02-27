<?php

namespace App\Filament\Resources\Inventories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InventoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Registro de inventario')
                    ->columns(2)
                    ->schema([
                        Select::make('product_id')
                            ->label('Producto')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                                
                        Select::make('warehouse_id')
                            ->label('Almacén')
                            ->searchable()
                            ->preload()
                            ->relationship('warehouse', 'name')
                            ->required(),

                        TextInput::make('quantity')
                            ->label('Cantidad de stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
            ]);
    }
}
