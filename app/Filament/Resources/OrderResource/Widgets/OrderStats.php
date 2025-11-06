<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Illuminate\Support\Number;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pesanan Baru', Order::query()->where('status', 'new')->count())
                ->description('Pesanan yang baru masuk')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info'),
            
            Stat::make('Pesanan Diproses', Order::query()->where('status', 'processing')->count())
                ->description('Sedang diproses')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),
            
            Stat::make('Pesanan Dikirim', Order::query()->where('status', 'shipped')->count())
                ->description('Dalam pengiriman')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),
            
            Stat::make('Rata-rata Nilai Pesanan', Number::currency(Order::query()->avg('grand_total') ?? 0, 'IDR'))
                ->description('Average order value')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
        ];
    }
}
