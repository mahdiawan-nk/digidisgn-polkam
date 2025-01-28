<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\UserJabatan;
use Filament\Notifications\Notification;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    public function afterCreate(): void
    {
        $datajabatans = [
            'user_id' => $this->record->id,
            'jabatan_id' => $this->data['jabatan_id'],
        ];

        UserJabatan::create($datajabatans);
        Notification::make()
            ->title('Saved successfully')
            ->body('Data berhasil disimpan')
            ->success()
            ->send();
    }
}
