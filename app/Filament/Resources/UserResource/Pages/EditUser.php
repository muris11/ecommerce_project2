<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function mount(int|string $record): void
    {
        // Debug: Log authentication state when accessing edit page
        Log::info('EditUser mount called', [
            'user_id' => Auth::id(),
            'user_is_admin' => Auth::user()?->is_admin,
            'record_id' => $record,
            'session_id' => session()->getId(),
        ]);

        parent::mount($record);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If updating current admin user, ensure they stay logged in
        if ($this->record->id === Auth::id()) {
            // Don't update password if empty
            if (empty($data['password'])) {
                unset($data['password']);
            }
        }

        return $data;
    }

    protected function afterSave(): void
    {
        // If admin updated themselves, refresh their session
        if ($this->record->id === Auth::id()) {
            // Re-authenticate the current user to refresh session
            Auth::login($this->record, true);
        }
    }
}
