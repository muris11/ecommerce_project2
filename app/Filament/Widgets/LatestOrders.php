<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Order;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action; 
use App\Filament\Resources\OrderResource;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    
    protected static ?string $heading = 'Pesanan Terbaru';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                ->label('ID Pesanan')
                ->searchable(),

                TextColumn::make('user.name')
                ->label('Pelanggan')
                ->searchable(),

                TextColumn::make('grand_total')
                ->label('Total Pembayaran')
                ->money('IDR'),

                TextColumn::make('status')
                ->label('Status Pesanan')
                ->badge()
                ->color(fn (string $state): string => match ($state){
                    'new' => 'info',
                    'processing' => 'warning',
                    'shipped' => 'primary',
                    'delivered' => 'success',
                    'canceled' => 'danger',
                })
                ->icon(fn (string $state): string => match ($state){
                    'new' => 'heroicon-m-sparkles',
                    'processing' => 'heroicon-m-arrow-path',
                    'shipped' => 'heroicon-m-truck',
                    'delivered' => 'heroicon-m-check-badge',
                    'canceled' => 'heroicon-m-x-circle',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'new' => 'Baru',
                    'processing' => 'Diproses',
                    'shipped' => 'Dikirim',
                    'delivered' => 'Selesai',
                    'canceled' => 'Dibatalkan',
                    default => $state,
                })
                ->sortable(),

                TextColumn::make('payment_method')
                ->label('Metode Pembayaran')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'cod' => 'warning',
                    'stripe' => 'success',
                    'midtrans' => 'info',
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'cod' => 'COD',
                    'stripe' => 'Stripe',
                    'midtrans' => 'Midtrans',
                    default => strtoupper($state),
                })
                ->sortable()
                ->searchable(),

                TextColumn::make('payment_status')
                ->label('Status Pembayaran')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'paid' => 'success',
                    'failed' => 'danger',
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'pending' => 'Menunggu',
                    'paid' => 'Lunas',
                    'failed' => 'Gagal',
                    default => $state,
                })
                ->sortable()
                ->searchable(),

                TextColumn::make('created_at')
                ->label('Tanggal Pesanan')
                ->dateTime('d M Y H:i')
            ])
            ->actions([
                Action::make('View Order')
                ->label('Lihat Detail')
                ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                ->icon('heroicon-m-eye')
                ->color('info'),
            ]);
    }
}
