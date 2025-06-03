<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Kategori Kendaraan', \App\Models\KategoriKendaraan::count())
                ->label('Kategori Kendaraan')
                ->icon('heroicon-o-rectangle-stack')
                ->color('primary')
                ->description('Total kategori kendaraan yang tersedia')
                ->chart([10, 15, 12, 18, 20, 22])
                ->extraAttributes(['class' => 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg rounded-lg']),

            Stat::make('Jumlah Layanan', \App\Models\Layanan::count())
                ->label('Layanan')
                ->icon('heroicon-o-wrench-screwdriver')
                ->color('success')
                ->description('Total layanan yang tersedia')
                ->chart([5, 7, 8, 10, 12, 14])
                ->extraAttributes(['class' => 'bg-gradient-to-r from-green-400 to-emerald-500 text-white shadow-lg rounded-lg']),

            Stat::make('Jumlah Sparepart', \App\Models\Sparepart::count())
                ->label('Sparepart')
                ->icon('heroicon-o-cog-6-tooth')
                ->color('warning')
                ->description('Total sparepart yang tersedia')
                ->chart([20, 18, 25, 22, 28, 30])
                ->extraAttributes(['class' => 'bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-lg rounded-lg']),

            Stat::make(
                'Total Pendapatan',
                'Rp ' . number_format(Transaksi::where('status', 'selesai')->sum('total_bayar'), 0, ',', '.')
            )
                ->icon('heroicon-o-chart-bar')
                ->color('primary')
                ->description('Statistik pendapatan dari transaksi yang telah selesai.')
                ->chart(
                    Transaksi::where('status', 'selesai')
                        ->orderByDesc('created_at')
                        ->take(7)
                        ->pluck('total_bayar')
                        ->reverse()
                        ->toArray()
                )
                ->extraAttributes(['class' => 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg rounded-lg'])
        ];
    }
}
