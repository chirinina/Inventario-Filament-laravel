<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('image')
                    ->label('Image')
                    ->imageSize(50)
                    ->disk('public'),

                TextColumn::make('code')
                    ->label('Code')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                
                TextColumn::make('summary')
                    ->label('Resumen'),

                TextColumn::make('is_active')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (bool $state) => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn (bool $state) => $state ? 'Activo' : 'Inactivo'),

                TextColumn::make('price')
                    ->label('Precio de venta')
                    ->money('USD', true)
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->date()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->date()
                    ->toggleable(),
                    
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Todas las categorías'),
                SelectFilter::make('is_active')
                    ->label('Estado')
                    ->options([
                        1 => 'Activo',
                        0 => 'Inactivo',
                    ])
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
