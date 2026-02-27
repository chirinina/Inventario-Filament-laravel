<?php

namespace App\Filament\Resources\Customers\Widgets;

use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomersOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            static::getCustomersOverviewStat()
        ];
    }

    public static function getCustomersOverviewStat()
    {
        $actualMonth = now()->month;
        $beforeMonth = now()->month - 1;

        $newCustomers = Customer::whereMonth('created_at', $actualMonth)->count();
        $beforeCustomer = Customer::whereMonth('created_at', $beforeMonth)->count();


        $status = ($newCustomers >= $beforeCustomer) ? true : false;

        $treding = $status ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $color = $status ? 'success' : 'danger';

        return Stat::make('Nuevas clientes', $newCustomers)
            ->descriptionIcon($treding)
            ->description($newCustomers - $beforeCustomer . ' en el último mes')
            ->color($color)
            ->chart([$beforeCustomer, $newCustomers]);
    }
}
