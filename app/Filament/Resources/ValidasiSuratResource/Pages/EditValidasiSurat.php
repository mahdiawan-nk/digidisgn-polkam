<?php

namespace App\Filament\Resources\ValidasiSuratResource\Pages;

use App\Filament\Resources\ValidasiSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditValidasiSurat extends EditRecord
{
    protected static string $resource = ValidasiSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
