<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\OrderResource;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_processing')
                ->label('Tandai Diproses')
                ->icon('heroicon-m-arrow-path')
                ->color('warning')
                ->visible(fn () => $this->record->status === 'new')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'processing']);
                    Notification::make()
                        ->success()
                        ->title('Status diubah')
                        ->body('Pesanan ditandai sebagai Diproses')
                        ->send();
                }),

            Actions\Action::make('mark_shipped')
                ->label('Tandai Dikirim')
                ->icon('heroicon-m-truck')
                ->color('primary')
                ->visible(fn () => in_array($this->record->status, ['new', 'processing']))
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'shipped']);
                    Notification::make()
                        ->success()
                        ->title('Status diubah')
                        ->body('Pesanan ditandai sebagai Dikirim')
                        ->send();
                }),

            Actions\Action::make('mark_delivered')
                ->label('Tandai Selesai')
                ->icon('heroicon-m-check-badge')
                ->color('success')
                ->visible(fn () => in_array($this->record->status, ['shipped']))
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'delivered']);
                    Notification::make()
                        ->success()
                        ->title('Status diubah')
                        ->body('Pesanan ditandai sebagai Selesai')
                        ->send();
                }),

            Actions\Action::make('mark_canceled')
                ->label('Batalkan Pesanan')
                ->icon('heroicon-m-x-circle')
                ->color('danger')
                ->visible(fn () => !in_array($this->record->status, ['delivered', 'canceled']))
                ->requiresConfirmation()
                ->modalHeading('Batalkan Pesanan')
                ->modalDescription('Apakah Anda yakin ingin membatalkan pesanan ini?')
                ->action(function () {
                    $this->record->update(['status' => 'canceled']);
                    Notification::make()
                        ->warning()
                        ->title('Pesanan dibatalkan')
                        ->body('Pesanan telah dibatalkan')
                        ->send();
                }),

            Actions\EditAction::make()
                ->label('Edit'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Informasi Pesanan')
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Pelanggan'),
                                
                                TextEntry::make('payment_method')
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
                                    }),
                                
                                TextEntry::make('payment_status')
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
                                    }),
                                
                                TextEntry::make('status')
                                    ->label('Status Pesanan')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'new' => 'info',
                                        'processing' => 'warning',
                                        'shipped' => 'primary',
                                        'delivered' => 'success',
                                        'canceled' => 'danger',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'new' => 'Baru',
                                        'processing' => 'Diproses',
                                        'shipped' => 'Dikirim',
                                        'delivered' => 'Selesai',
                                        'canceled' => 'Dibatalkan',
                                        default => $state,
                                    }),

                                TextEntry::make('shipping_method')
                                    ->label('Metode Pengiriman')
                                    ->formatStateUsing(fn (?string $state): string => $state ? strtoupper($state) : '-'),

                                TextEntry::make('created_at')
                                    ->label('Tanggal Pesanan')
                                    ->dateTime('d M Y H:i'),

                                TextEntry::make('notes')
                                    ->label('Catatan')
                                    ->placeholder('Tidak ada catatan')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('Produk yang Dipesan')
                            ->schema([
                                RepeatableEntry::make('items')
                                    ->schema([
                                        TextEntry::make('product.name')
                                            ->label('Produk'),
                                        
                                        TextEntry::make('quantity')
                                            ->label('Jumlah'),
                                        
                                        TextEntry::make('unit_amount')
                                            ->label('Harga Satuan')
                                            ->money('IDR'),
                                        
                                        TextEntry::make('total_amount')
                                            ->label('Total')
                                            ->money('IDR'),
                                    ])
                                    ->columns(4),
                            ]),

                        Section::make('Ringkasan Pembayaran')
                            ->schema([
                                TextEntry::make('items_subtotal')
                                    ->label('Subtotal Produk')
                                    ->state(function ($record) {
                                        return $record->grand_total - $record->shipping_amount;
                                    })
                                    ->money('IDR'),

                                TextEntry::make('shipping_amount')
                                    ->label('Ongkos Kirim')
                                    ->money('IDR'),

                                TextEntry::make('grand_total')
                                    ->label('Total Pembayaran')
                                    ->money('IDR')
                                    ->weight('bold')
                                    ->size('lg'),
                            ])
                            ->columns(3),

                        Section::make('Alamat Pengiriman')
                            ->schema([
                                TextEntry::make('address.first_name')
                                    ->label('Nama Depan'),
                                
                                TextEntry::make('address.last_name')
                                    ->label('Nama Belakang'),
                                
                                TextEntry::make('address.phone')
                                    ->label('Telepon'),
                                
                                TextEntry::make('address.street_address')
                                    ->label('Alamat Lengkap')
                                    ->columnSpanFull(),
                                
                                TextEntry::make('address.city')
                                    ->label('Kota'),
                                
                                TextEntry::make('address.state')
                                    ->label('Provinsi'),
                                
                                TextEntry::make('address.zip_code')
                                    ->label('Kode Pos'),
                            ])
                            ->columns(3)
                            ->visible(fn ($record) => $record->address !== null),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
