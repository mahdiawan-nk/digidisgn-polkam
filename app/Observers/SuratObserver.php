<?php

namespace App\Observers;

use App\Models\Surat;
use App\Models\SuratValidationLog;

class SuratObserver
{
    /**
     * Handle the Surat "created" event.
     */
    public function created(Surat $surat): void
    {
        // SuratValidationLog::create([
        //     'surat_id' => $surat->id,
        //     'user_id' => auth()->user()->id,
        //     'validation_step' => 1,
        //     'action' => 'submited',
        //     'note' => 'Mengajukan Surat',
        // ]);
    }

    /**
     * Handle the Surat "updated" event.
     */
    public function updated(Surat $surat): void
    {
        $isStaff = auth()->user()->hasRole('staff');

        if ($isStaff) {
            SuratValidationLog::create([
                'surat_id' => $surat->id,
                'user_id' => auth()->user()->id,
                'validation_step' => 0,
                'action' => 're-submited',
                'note' => 'Mengajukan Ulang Surat',
            ]);
        }
    }

    /**
     * Handle the Surat "deleted" event.
     */
    public function deleted(Surat $surat): void
    {
        //
    }

    /**
     * Handle the Surat "restored" event.
     */
    public function restored(Surat $surat): void
    {
        //
    }

    /**
     * Handle the Surat "force deleted" event.
     */
    public function forceDeleted(Surat $surat): void
    {
        //
    }
}
