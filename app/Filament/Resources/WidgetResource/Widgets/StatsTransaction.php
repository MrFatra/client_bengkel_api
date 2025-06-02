<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use App\Models\Transaksi;

class StatsTransaction extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $stats = [];

        // Total Pendapatan Keseluruhan
        $total = Transaksi::where('status', 'selesai')->sum('total_bayar');
        $stats[] = Stat::make('Total Pendapatan', 'Rp ' . number_format($total, 0, ',', '.'));

        // Pendapatan 7 Hari Terakhir (per hari)
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dayTotal = Transaksi::where('status', 'selesai')->whereDate('created_at', $date)->sum('total_bayar');
            $stats[] = Stat::make(
                'Pendapatan ' . $date->format('d M Y'),
                'Rp ' . number_format($dayTotal, 0, ',', '.')
            );
        }

        return [
            Stat::make('Total Pendapatan', Transaksi::where('status', 'selesai')->sum('total_bayar'))
                ->icon('heroicon-o-chart-bar')
                ->color('primary')
                ->description('Statistik pendapatan dari transaksi yang telah selesai.')
                ->extraAttributes(['class' => 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg rounded-lg'])

        ];
    }


}
