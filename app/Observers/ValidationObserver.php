<?php

namespace App\Observers;

use App\Models\SuratValidationStep;
use App\Models\SuratValidationLog;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class ValidationObserver
{
    /**
     * Handle the SuratValidationStep "created" event.
     */
    public function created(SuratValidationStep $suratValidationStep): void
    {
        
        SuratValidationLog::create([
            'surat_id' => $suratValidationStep->surat_id,
            'user_id' => auth()->user()->id,
            'validation_step' => $suratValidationStep->step_order,
            'action' => $this->enumAction($suratValidationStep->status),
            'note' => $this->enumNotes($suratValidationStep->status),
        ]);
    }

    /**
     * Handle the SuratValidationStep "updated" event.
     */
    public function updated(SuratValidationStep $suratValidationStep): void
    {
        
        SuratValidationLog::create([
            'surat_id' => $suratValidationStep->surat_id,
            'user_id' => auth()->user()->id,
            'validation_step' => $suratValidationStep->step_order,
            'action' => $this->enumAction($suratValidationStep->status),
            'note' => $this->enumNotes($suratValidationStep->status),
        ]);
    }

    /**
     * Handle the SuratValidationStep "deleted" event.
     */
    public function deleted(SuratValidationStep $suratValidationStep): void
    {
        //
    }

    /**
     * Handle the SuratValidationStep "restored" event.
     */
    public function restored(SuratValidationStep $suratValidationStep): void
    {
        //
    }

    /**
     * Handle the SuratValidationStep "force deleted" event.
     */
    public function forceDeleted(SuratValidationStep $suratValidationStep): void
    {
        //
    }

    private function enumNotes(string $status)
    {
        $jabtanUser = auth()->user()->jabatan->jabatan->nama_jabatan;
        $noteApprove = "DiSetujui oleh $jabtanUser";
        $noteReject = "Ditolak oleh $jabtanUser";
        return $status == 'approved' ? $noteApprove : $noteReject;
    }

    private function enumAction(string $status)
    {
        $userRole = auth()->user()?->getRoleNames()->first(); // Mengambil role pertama user
        $action = '';

        if ($userRole === 'verifikator-kabag' || $userRole === 'verifikator-wd') {
            $action = $status === 'approved' ? 'verfied' : 'rejected';
        }
        if ($userRole === 'validator-kabag' || $userRole === 'validator-wd' || $userRole === 'validator-direktur') {
            $action = $status === 'approved' ? 'approved' : 'rejected';
        }

        // Mengembalikan status berdasarkan kondisi
        return $action;
    }
}
