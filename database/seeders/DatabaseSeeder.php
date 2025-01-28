<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataJabatan;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // $dataJabatan = [
        //     'Direktur',
        //     'WD 1',
        //     'WD 2',
        //     'WD 3',
        //     'Ka Baak',
        // ];

        // foreach ($dataJabatan as $jabatan) {
        //     DataJabatan::create([
        //         'nama_jabatan' => $jabatan,
        //     ]);
        // }

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'id_jabatan' => 1,
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
        
    }
}