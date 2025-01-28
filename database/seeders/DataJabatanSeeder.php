<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataJabatan;
class DataJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataJabatan = [
            'Direktur',
            'WD 1',
            'WD 2',
            'WD 3',
            'Ka BPM',
            'Ka P3M',
            'Ka BPP',
            'Ka Prodi TPS',
            'Ka Prodi PPM',
            'Ka Prodi TIF',
            'Ka Prodi ABI',
            'Ka Prodi TPKS',
            'Ka Prodi PP',
            'Ka Prodi MAB',
            'Ka Prodi TRL',
            'Ka BAA',
            'Ka BAK',
            'Ka BAKKU',
            'Ka BAKHA',
            'Ka UPT ICT',
            'Ka UPT Perpustakaan',
            'Ka Sub BAKU',
            'Ka UPT PPA',
            'Ka UPT Bisnis dan Pemasaran',
            'Ka UPT PMB',
            'Ka UPT Media Center',
            'Ka UPT PPK-PK',
            'Ka Lab TPS',
            'Ka Workshop',
            'Ka Lab TIF',
            'Ka Lab PP',
        ];

        foreach ($dataJabatan as $jabatan) {
            DataJabatan::create([
                'nama_jabatan' => $jabatan,
            ]);
        }
    }
}
