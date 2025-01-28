<?php

namespace App\Filament\Resources\DataJabatanResource\Pages;

use App\Filament\Resources\DataJabatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataJabatan extends EditRecord
{
    protected static string $resource = DataJabatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
