<?php

namespace App\Filament\Resources\Orders\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class OrdersChart extends ChartWidget
{
    protected ?string $heading = 'Orders Chart';

    protected int | string | array $columnSpan = 2;
    protected ?string $maxHeight = '320px';

    protected function getData(): array
    {
        $now = Carbon::now();

        $yearCurrent = $now->year;

        // MES ACTUAL
        $monthCurrent = $now->month;
        $startCurrent = $now->copy()->startOfMonth();
        $daysInCurrent = $startCurrent->daysInMonth;

        // MES ANTERIOR
        $prev = $now->copy()->subMonth();
        $monthPrev = $prev->month;
        $startPrev = $prev->copy()->startOfMonth();
        $daysInPrev = $startPrev->daysInMonth;

        $totalsCurrent = Order::selectRaw('EXTRACT(DAY FROM created_at) AS day, SUM(total) AS total')
    ->whereYear('created_at', $yearCurrent)
    ->whereMonth('created_at', $monthCurrent)
    ->groupByRaw('EXTRACT(DAY FROM created_at)')
    ->pluck('total', 'day');

$totalsPrev = Order::selectRaw('EXTRACT(DAY FROM created_at) AS day, SUM(total) AS total')
    ->whereYear('created_at', $yearCurrent)
    ->whereMonth('created_at', $monthPrev)
    ->groupByRaw('EXTRACT(DAY FROM created_at)')
    ->pluck('total', 'day');

        $labels = [];
        $dataCurrent = [];
        $dataPrev = [];

        for ($day = 1; $day <= $daysInCurrent; $day++) {
            $labels[] = sprintf('%02d/%02d', $day, $monthCurrent);
            $dataCurrent[] = isset($totalsCurrent[$day]) ? (float) $totalsCurrent[$day] : 0;

            if( $day <= $daysInPrev ) {
                $dataPrev[] = isset($totalsPrev[$day]) ? (float) $totalsPrev[$day] : 0;
            }else {
                $dataPrev[] = 0;
            }
        }

        return [
            "labels" => $labels,
            "datasets" => [
                [
                    'label' => "Mes actual",
                    'data' => $dataCurrent,
                    'tension' => 0.3,
                    'borderColor' => '#4caf50'
                ],
                [
                    'label' => "Mes anterior",
                    'data' => $dataPrev,
                    'tension' => 0.3,
                ]
            ]
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getHeading(): string
    {
        return 'Ventas mensuales';
    }

    public function getDescription(): string|Htmlable|null
    {
        return 'Comparativa de ventas del mes actual y el mes anterior';
    }
}
