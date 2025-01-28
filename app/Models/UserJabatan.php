<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJabatan extends Model
{
    protected $table = 'user_jabatans';

    protected $fillable = [
        'user_id',
        'jabatan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(DataJabatan::class);
    }
}
