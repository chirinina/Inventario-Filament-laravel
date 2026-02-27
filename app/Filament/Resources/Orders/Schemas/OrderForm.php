<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Información de salida')
                    ->columns(2)
                    ->schema([
                        Select::make('warehouse_id')
                            ->label('Almacén')
                            ->relationship('warehouse', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->placeholder('Seleccione un almacén')
                            ->live(),

                        Select::make('customer_id')
                            ->label('Cliente')
                            ->relationship('customer', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->placeholder('Seleccione un cliente')
                            ->live(),

                        TextInput::make('notes')
                            ->label('Notas')
                            ->columnSpanFull()
                            ->placeholder('Ingrese notas adicionales para la orden de salida'),
                    ]),

                Section::make('Carrito de compras')
                    ->hidden(
                        function (Get $get): bool {
                            $isVisible = empty($get('warehouse_id')) && empty($get('customer_id'));
                            return $isVisible;
                        }
                    )
                    ->schema([
                        Repeater::make('orderProducts')
                            ->relationship()
                            ->columns(3)
                            ->schema([
                                Select::make('product_id')
                                    ->label('Producto')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->live()
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Seleccione un producto')
                                    ->options(function (Get $get): array {
                                        $warehouseId = $get('../../warehouse_id');
                                        $products = Product::query()
                                            ->whereHas('inventories', fn($q) => $q->where('warehouse_id', $warehouseId))
                                            ->pluck('name', 'id')
                                            ->toArray();

                                        return $products;
                                    }),

                                TextInput::make('quantity')
                                    ->label('Cantidad')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->placeholder('Ingrese la cantidad')
                                    ->reactive()
                                    ->rule(function (Get $get) {

                                        $productId = $get('product_id');
                                        $warehouseId = $get('../../warehouse_id');

                                        $stock = Inventory::where('product_id', $productId)
                                            ->where('warehouse_id', $warehouseId)
                                            ->value('quantity') ?? 0;

                                        return "max:$stock";
                                    })
                                    ->validationMessages([
                                        'max' => "No hay stock suficiente"
                                    ])
                                    ->helperText(function (Get $get) {
                                        $productId = $get('product_id');
                                        $warehouseId = $get('../../warehouse_id');

                                        $stock = Inventory::where('product_id', $productId)
                                            ->where('warehouse_id', $warehouseId)
                                            ->value('quantity') ?? 0;

                                        return "Stock disponible: {$stock}";
                                    })
                                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                        $productId = $get('product_id');
                                        $quantity = $get('quantity');

                                        $product = Product::find($productId);

                                        $subTotal = $quantity * $product->price ?? 0;

                                        $set('sub_total', $subTotal);

                                        return $subTotal;
                                    }),

                                TextInput::make('sub_total')
                                    ->label('Subtotal')
                                    ->required()
                                    ->readOnly()
                                    ->numeric()
                                    ->minValue(0)
                                    ->placeholder('Ingrese el subtotal')
                            ])

                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                $total = 0;
                                foreach ($state as $item) {
                                    $productId = $item['product_id'];
                                    $quantity = $item['quantity'] ?? 0;

                                    $product = Product::find($productId);

                                    $total += (float) $quantity * (float)($product->price ?? 0);
                                }

                                $set('total', $total);
                            })

                    ]),
                Section::make('Resumen de la orden')
                    ->hidden(
                        function (Get $get): bool {
                            $isVisible = empty($get('warehouse_id')) && empty($get('customer_id'));
                            return $isVisible;
                        }
                    )
                    ->schema([
                        TextInput::make('total')
                            ->label('Total')
                            ->required()
                            ->readOnly()
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('Total de la orden de salida'),
                    ]),
            ]);
    }
}
