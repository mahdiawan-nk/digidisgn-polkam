<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataJabatan extends Model
{
    protected $fillable =[
        'nama_jabatan'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}