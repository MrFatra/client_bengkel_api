<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Transaksi;
use Carbon\Carbon;

class ChartTransaction extends LineChartWidget
{
    protected static ?string $heading = 'Transaksi 7 Hari Terakhir';

    // protected static ?int $columnSpan = 1;

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i)->format('l d F Y');
        });

        $dateKeys = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i)->format('Y-m-d');
        });

        $transactions = Transaksi::whereBetween('created_at', [
            Carbon::today()->subDays(6)->startOfDay(),
            Carbon::today()->endOfDay(),
        ])
            ->get()
            ->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
            });

        $data = $dateKeys->map(function ($day) use ($transactions) {
            return $transactions->get($day, collect())->count();
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Transaksi',
                    'data' => $data,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16,185,129,0.2)',
                    'width' => '100%'
                ],
            ],
            'labels' => $days->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
