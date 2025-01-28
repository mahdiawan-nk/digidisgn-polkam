<?php 
namespace App\Filament\Resources\SuratResource\Pages;

use App\Filament\Resources\SuratResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class SuratSaya extends ListRecords
{
    protected static string $resource = SuratResource::class;
    protected static ?string $title = 'Daftar Surat Saya';

    // Override the getTableQuery method to filter based on the authenticated user's staff_id
    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()->where('staff_id', Auth::id());
    }
}