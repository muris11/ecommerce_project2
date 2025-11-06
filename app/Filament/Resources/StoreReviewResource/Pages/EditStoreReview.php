<?php

namespace App\Filament\Resources\StoreReviewResource\Pages;

use App\Filament\Resources\StoreReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStoreReview extends EditRecord
{
    protected static string $resource = StoreReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
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
