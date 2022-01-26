<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Roles-all',
            'Roles-read',
            'Roles-create',
            'Roles-update',
            'Roles-delete',
            'Permissions-all',
            'Permissions-read',
            'Permissions-create',
            'Permissions-update',
            'Permissions-delete',
        ];

        foreach ($permissions as $permission) {
            $input = [
                'name' => $permission,
            ];

            DB::connection('mongodb')->table('permissions')->insert($input);
        }
    }
}
