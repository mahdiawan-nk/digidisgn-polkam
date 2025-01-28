<?php

namespace App\Filament\Resources\PengajuanSuratResource\Pages;

use App\Filament\Resources\PengajuanSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SuratResource;

class ListPengajuanSurats extends ListRecords
{
    protected static string $resource = PengajuanSuratResource::class;
    /*************  ✨ Codeium Command ⭐  *************/
    /******  d2ab5540-80b5-40bb-83a3-1b77bd9a388d  *******/
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::generateUrl('create');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
