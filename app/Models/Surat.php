<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surats';

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'perihal',
        'deskripsi',
        'status_pengajuan',
        'pengirim_id',
        'qr_code_path',
        'validation_rule',
        'file_surat',
    ];


    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function validation_logs()
    {
        return $this->hasMany(SuratValidationLog::class);
    }

    public function validation_steps()
    {
        return $this->hasMany(SuratValidationStep::class);
    }

}
