<?php

namespace App\Filament\Resources\SuratResource\Pages;

use App\Filament\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\Page;
use App\Models\Surat;
class ListSurats extends ListRecords
{
    protected static string $resource = SuratResource::class;
    // protected static ?string $title = static::Title();
    public function getTitle(): string
    {
        $title = '';
        if (auth()->user()->hasRole('Verifikator')) {
            $title = 'Riwayat Verifikasi Surat';
        } else if (auth()->user()->hasRole('Validator')) {
            $title = 'Riwayat Validasi Surat';
        } else if (auth()->user()->hasRole('Staff')) {
            $title = 'Daftar Surat Saya';
        } else {
            $title = 'Riwayat Surat';
        }
        return $title;
    }
    protected static ?string $breadcrumb = 'Daftar Riwayat Surat';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(auth()->user()->can('create', SuratResource::class)),

        ];
    }

    protected function getTableQuery(): ?builder
    {
        $user = Auth::user();  // Mendapatkan pengguna yang sedang login
        $userRoles = $user->getRoleNames()->toArray();  // Mendapatkan role pengguna

        // Menyusun role yang diperlukan berdasarkan role pengguna yang terdaftar
        $roleRequired = [];
        if (in_array('validator-kabag', $userRoles)) {
            $roleRequired[] = 'validator-kabag';
        }
        if (in_array('validator-wd', $userRoles)) {
            $roleRequired[] = 'validator-wd';
        }
        if (in_array('validator-direktur', $userRoles)) {
            $roleRequired[] = 'validator-direktur';
        }

        // Jika tidak ada role yang sesuai, langsung kembalikan hasil kosong
        if (empty($roleRequired)) {
            return parent::getTableQuery();  // Menghasilkan query kosong (tidak ada data)
        }

        // Membangun query untuk Surat
        $query = Surat::whereIn('id', function ($subQuery) use ($user, $roleRequired) {
            $subQuery->select('surat_id')  // Pilih hanya surat_id dari SuratValidationStep
                ->from('surat_validation_steps')
                ->where('user_id', $user->id);
        })->orderBy('id', 'desc');

        // Mengembalikan hasil query
        return $query;
    }
}
