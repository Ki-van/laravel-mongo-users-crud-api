<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var $super_admin_role Role
         */
        $super_admin_role = Role::all()->firstWhere('name', '=','Super Admin');
        $permission_ids = array_map(function ($item) {
            return $item['_id'];
        }, Permission::all('_id')->toArray());
        $super_admin_role->permissions()->attach($permission_ids);
        $super_admin_role->save();
    }
}
