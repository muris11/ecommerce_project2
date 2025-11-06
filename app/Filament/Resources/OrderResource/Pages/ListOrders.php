<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class
        ];
    }

    public function getTabs(): array {
        return[
            null => Tab::make('Semua')
                ->badge(Order::count())
                ->badgeColor('primary'),
            
            'new' => Tab::make('Baru')
                ->query(fn ($query) => $query->where('status', 'new'))
                ->badge(Order::where('status', 'new')->count())
                ->badgeColor('info'),
            
            'processing' => Tab::make('Diproses')
                ->query(fn ($query) => $query->where('status', 'processing'))
                ->badge(Order::where('status', 'processing')->count())
                ->badgeColor('warning'),
            
            'shipped' => Tab::make('Dikirim')
                ->query(fn ($query) => $query->where('status', 'shipped'))
                ->badge(Order::where('status', 'shipped')->count())
                ->badgeColor('primary'),
            
            'delivered' => Tab::make('Selesai')
                ->query(fn ($query) => $query->where('status', 'delivered'))
                ->badge(Order::where('status', 'delivered')->count())
                ->badgeColor('success'),
            
            'canceled' => Tab::make('Dibatalkan')
                ->query(fn ($query) => $query->where('status', 'canceled'))
                ->badge(Order::where('status', 'canceled')->count())
                ->badgeColor('danger'),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()
            ->with(['user', 'items.product', 'address']);
    }
}
