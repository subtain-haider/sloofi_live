<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            ['name' => 'add_role','guard_name'=>'web'],
            ['name' => 'edit_role','guard_name'=>'web'],
            ['name' => 'view_roles','guard_name'=>'web'],
            ['name' => 'delete_role','guard_name'=>'web'],
            ['name' => 'assign_permissions_to_roles','guard_name'=>'web'],
            ['name' => 'view_permissions','guard_name'=>'web'],
            ['name' => 'add_permission','guard_name'=>'web'],
            ['name' => 'edit_permission','guard_name'=>'web'],
            ['name' => 'delete_permission','guard_name'=>'web'],
        ];
        Permission::insert($permissions);
    }
}
