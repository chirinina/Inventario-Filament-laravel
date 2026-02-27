<?php

namespace App\Filament\Resources\Orders\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrdersOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        return [
            static::getOrdersOverviewStat()
        ];
    }

    public static function getOrdersOverviewStat()
    {
        $actualMonth = now()->month;
        $beforeMonth = now()->month - 1;

        $newOrders = Order::whereMonth('created_at', $actualMonth)->count();
        $beforeOrders = Order::whereMonth('created_at', $beforeMonth)->count();


        $status = ($newOrders >= $beforeOrders) ? true : false;

        $treding = $status ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $color = $status ? 'success' : 'danger';

        return Stat::make('Nuevas ordenes', $newOrders)
            ->descriptionIcon($treding)
            ->description($newOrders - $beforeOrders . ' en el último mes')
            ->color($color)
            ->chart([$beforeOrders, $newOrders]);

    }
}
