<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReview extends EditRecord
{
    protected static string $resource = ReviewResource::class;

    protected ?string $heading = 'Edit Ulasan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Ulasan berhasil diperbarui';
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If admin adds or updates a reply, set the replied_at timestamp
        if (!empty($data['admin_reply']) && $this->record->admin_reply !== $data['admin_reply']) {
            $data['replied_at'] = now();
        }

        return $data;
    }
}
