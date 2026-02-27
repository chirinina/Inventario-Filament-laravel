<?php

namespace App\Filament\Resources\Customers\RelationManagers;

use App\Filament\Resources\Customers\CustomerResource;
use App\Filament\Resources\Orders\OrderResource;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';
    protected static ?string $title = 'Ordenes del cliente';
    
    protected static string|BackedEnum|null $icon = 'heroicon-o-shopping-cart';


    protected static ?string $relatedResource = CustomerResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle('Compras del cliente')
            ->headerActions([
                CreateAction::make(),
            ])
            ->columns([
                TextColumn::make('user.name')
                    ->label('Vendedor')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('warehouse.name')
                    ->label('Almacén')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('total')
                    ->label('Total')
                    ->money('usd', true)
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->emptyStateHeading('Este cliente no tiene órdenes')
            ->emptyStateDescription('Cree una nueva orden para este cliente.')
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }
}
