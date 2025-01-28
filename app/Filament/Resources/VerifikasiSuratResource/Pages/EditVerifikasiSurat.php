<?php

namespace App\Filament\Resources\VerifikasiSuratResource\Pages;

use App\Filament\Resources\VerifikasiSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerifikasiSurat extends EditRecord
{
    protected static string $resource = VerifikasiSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
