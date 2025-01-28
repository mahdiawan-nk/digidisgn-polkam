<?php

namespace App\Filament\Resources\VerifikasiSuratResource\Pages;

use App\Filament\Resources\VerifikasiSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\SuratValidationStep;

class ListVerifikasiSurats extends ListRecords
{
    protected static string $resource = VerifikasiSuratResource::class;
    protected function getTableQuery(): ?builder
    {
        $user = Auth::user();  // Mendapatkan pengguna yang sedang login
        $userRoles = $user->getRoleNames()->toArray();  // Mendapatkan role pengguna

        // Menyusun role yang diperlukan berdasarkan role pengguna yang terdaftar
        $roleRequired = [];
        if (in_array('verifikator-kabag', $userRoles)) {
            $roleRequired[] = 'verifikator-kabag';
        }
        if (in_array('verifikator-wd', $userRoles)) {
            $roleRequired[] = 'verifikator-wd';
        }

        // Jika tidak ada role yang sesuai, langsung kembalikan hasil kosong
        if (empty($roleRequired)) {
            return Surat::whereRaw('1 = 0');  // Menghasilkan query kosong (tidak ada data)
        }

        // Membangun query untuk Surat
        $query = Surat::whereIn('id', function ($subQuery) use ($user, $roleRequired) {
            $subQuery->select('surat_id')  // Pilih hanya surat_id dari SuratValidationStep
                ->from('surat_validation_steps')
                ->where('user_id', $user->id)
                ->whereIn('role_required', $roleRequired);
        })->orderBy('id', 'desc');  // Urutkan berdasarkan id (desc, boolean)

        // Mengembalikan hasil query
        return $query;
    }
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
