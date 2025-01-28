<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ValidationObserver;
class SuratValidationLog extends Model
{
    protected $table = 'surat_validation_logs';

    protected $fillable = [
        'surat_id',
        'user_id',
        'validation_step',
        'action',
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
