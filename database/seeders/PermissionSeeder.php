<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataPermission = [
            [
                'name' => 'surat-access',
                'guard_name' => 'web',
            ],
            [
                'name' => 'surat-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'surat-update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'surat-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'surat-validation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'surat-verification',
                'guard_name' => 'web',
            ],
            [
                'name' => 'jabatan-access',
                'guard_name' => 'web',
            ],
            [
                'name' => 'jabatan-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'jabatan-update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'jabatan-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-access',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'role-access',
                'guard_name' => 'web',
            ],
            [
                'name' => 'role-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'role-update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'role-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'permission-access',
                'guard_name' => 'web',
            ],
            [
                'name' => 'permission-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'permission-update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'permission-delete',
                'guard_name' => 'web',
            ],
        ];
        Permission::insert($dataPermission);
    }
}
