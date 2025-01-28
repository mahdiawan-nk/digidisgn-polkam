<?php

namespace App\Filament\Resources\DaftarSuratSayaResource\Pages;

use App\Filament\Resources\DaftarSuratSayaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\PengajuanSuratResource;

class ListDaftarSuratSayas extends ListRecords
{
    protected static string $resource = DaftarSuratSayaResource::class;

    protected static ?string $title = 'Daftar Surat Saya';
    protected function getTableQuery(): ?builder
    {
        return parent::getTableQuery()->with([
            'pengirim' => function ($q) {
                $q->select('id', 'name')
                    ->where('id', Auth::id());
            },
            'validation_steps'
        ]);
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Ajukan Surat')
                ->url(PengajuanSuratResource::getUrl('create'))
                ->visible(auth()->user()->can('surat-create', PengajuanSuratResource::class)),
        ];
    }
}
