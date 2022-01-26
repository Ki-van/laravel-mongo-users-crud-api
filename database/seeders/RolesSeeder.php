<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Super Admin',
            'User'
        ];

        foreach ($roles as $role) {
            $input = [
                'name' => $role,
            ];
            DB::connection('mongodb')->table('roles')->insert($input);
        }
    }
}
