<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\UserJabatan;
use Filament\Notifications\Notification;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

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

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['jabatan_id'] = UserJabatan::where('user_id', $this->record->id)->first()->jabatan_id;

        return $data;
    }

    protected function afterSave(): void
    {
        $datajabatans = [
            'user_id' => $this->record->id,
            'jabatan_id' => $this->data['jabatan_id'],
        ];


        UserJabatan::updateOrCreate($datajabatans);
        Notification::make()
            ->title('Saved successfully')
            ->body('Data berhasil disimpan')
            ->success()
            ->send();
    }
}
