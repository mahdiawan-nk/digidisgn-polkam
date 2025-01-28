<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratValidationStep extends Model
{
    protected $table = 'surat_validation_steps';

    protected $fillable = [
        'surat_id',
        'user_id',
        'step_order',
        'role_required',
        'status',
        'note',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
