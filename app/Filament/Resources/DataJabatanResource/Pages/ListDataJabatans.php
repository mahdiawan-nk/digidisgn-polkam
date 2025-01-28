<?php

namespace App\Filament\Resources\DataJabatanResource\Pages;

use App\Filament\Resources\DataJabatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataJabatans extends ListRecords
{
    protected static string $resource = DataJabatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
