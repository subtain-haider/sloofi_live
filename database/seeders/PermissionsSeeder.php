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
            ['name' => 'user_view','guard_name'=>'web'],
            ['name' => 'user_update','guard_name'=>'web'],
            ['name' => 'user_delete','guard_name'=>'web'],
            ['name' => 'add_category','guard_name'=>'web'],
            ['name' => 'edit_category','guard_name'=>'web'],
            ['name' => 'view_category','guard_name'=>'web'],
            ['name' => 'delete_category','guard_name'=>'web'],
            ['name' => 'add_warehouse','guard_name'=>'web'],
            ['name' => 'edit_warehouse','guard_name'=>'web'],
            ['name' => 'view_warehouse','guard_name'=>'web'],
            ['name' => 'delete_warehouse','guard_name'=>'web'],
            ['name' => 'view_property','guard_name'=>'web'],
            ['name' => 'update_property','guard_name'=>'web'],
            ['name' => 'delete_property','guard_name'=>'web'],


        ];
        Permission::insert($permissions);
    }
}
