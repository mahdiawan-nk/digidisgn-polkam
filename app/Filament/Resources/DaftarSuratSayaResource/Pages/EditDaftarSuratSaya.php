<?php

namespace App\Filament\Resources\DaftarSuratSayaResource\Pages;

use App\Filament\Resources\DaftarSuratSayaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarSuratSaya extends EditRecord
{
    protected static string $resource = DaftarSuratSayaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['status_pengajuan'] = 'pending';
        $data['status_verifikasi'] = 'pending';
        $data['status_validasi'] = 'pending';

        return $data;
    }
}
