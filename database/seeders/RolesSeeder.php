<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataRole = [
            [
                'name' => 'super-admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'operator',
                'guard_name' => 'web',
            ],
            [
                'name' => 'validator-direktur',
                'guard_name' => 'web',
            ],
            [
                'name' => 'validator-kabag',
                'guard_name' => 'web',
            ],
            [
                'name' => 'validator-wd',
                'guard_name' => 'web',
            ],
            [
                'name' => 'verifikator-kabag',
                'guard_name' => 'web',
            ],
            [
                'name' => 'verifikator-wd',
                'guard_name' => 'web',
            ],
            [
                'name' => 'staff',
                'guard_name' => 'web',
            ]
        ];

        foreach ($dataRole as $role) {
            Role::create($role);
        }
    }
}
