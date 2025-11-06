<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\OrderResource;

class EditOrder extends EditRecord
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
                    $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record]));
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
                    $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record]));
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
                    $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record]));
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
                    $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Actions\ViewAction::make()
                ->label('Lihat'),
            
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load relationships untuk form
        $this->record->load(['items.product', 'address', 'user']);
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Pastikan grand_total sudah termasuk shipping
        if (isset($data['shipping_amount'])) {
            $itemsTotal = 0;
            
            if (isset($data['items']) && is_array($data['items'])) {
                $itemsTotal = collect($data['items'])->sum('total_amount');
            }
            
            $data['grand_total'] = $itemsTotal + ($data['shipping_amount'] ?? 0);
        }
        
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Pesanan berhasil diperbarui';
    }
}
