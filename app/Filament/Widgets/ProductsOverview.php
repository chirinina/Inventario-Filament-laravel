<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '2s';
    protected static Bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            static::getProductsOverviewStat()
        ];
    }

    public static function getProductsOverviewStat()
    {   

        $products = Product::count();

        return Stat::make('Productos', $products)
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->description('Productos registrados')
            ->color('success')
            ->chart([100, 2, 200, 125, 30, 35, 400]);
    }
}
