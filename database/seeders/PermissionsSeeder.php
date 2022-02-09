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
            ['name' => 'view_users','guard_name'=>'web'],
            ['name' => 'user_update','guard_name'=>'web'],
            ['name' => 'user_delete','guard_name'=>'web'],
            ['name' => 'add_category','guard_name'=>'web'],
            ['name' => 'edit_category','guard_name'=>'web'],
            ['name' => 'view_categories','guard_name'=>'web'],
            ['name' => 'delete_category','guard_name'=>'web'],
            ['name' => 'add_warehouse','guard_name'=>'web'],
            ['name' => 'edit_warehouse','guard_name'=>'web'],
            ['name' => 'view_warehouses','guard_name'=>'web'],
            ['name' => 'delete_warehouse','guard_name'=>'web'],
            ['name' => 'view_properties','guard_name'=>'web'],
            ['name' => 'update_property','guard_name'=>'web'],
            ['name' => 'delete_property','guard_name'=>'web'],
            ['name' => 'view_sections','guard_name'=>'web'],
            ['name' => 'view_products','guard_name'=>'web'],
            ['name' => 'add_product','guard_name'=>'web'],
            ['name' => 'update_product','guard_name'=>'web'],
            ['name' => 'delete_product','guard_name'=>'web'],
            ['name' => 'view_woocommerces','guard_name'=>'web'],
            ['name' => 'add_woocommerce','guard_name'=>'web'],
            ['name' => 'delete_woocommerce','guard_name'=>'web'],
            ['name' => 'my_woocommerces_products','guard_name'=>'web'],
            ['name' => 'sync_woocommerce_products','guard_name'=>'web'],
            ['name' => 'view_shopifies','guard_name'=>'web'],
            ['name' => 'add_shopify','guard_name'=>'web'],
            ['name' => 'delete_shopify','guard_name'=>'web'],
            ['name' => 'my_shopify_products','guard_name'=>'web'],
            ['name' => 'sync_shopify_products','guard_name'=>'web'],
            ['name' => 'view_third_paty_api','guard_name'=>'web'],
            ['name' => 'product_connect_to_shopify','guard_name'=>'web'],
            ['name' => 'product_connect_to_woocommerce','guard_name'=>'web'],
            ['name' => 'product_add_stock','guard_name'=>'web'],
            ['name' => 'Wallet','guard_name'=>'web'],
            ['name' => 'deposit_approve','guard_name'=>'web'],
            ['name' => 'view_order','guard_name'=>'web'],
            ['name' => 'view_all_orders','guard_name'=>'web'],
            ['name' => 'view_sloofi_orders','guard_name'=>'web'],
            ['name' => 'view_vendor_internal_orders','guard_name'=>'web'],
            ['name' => 'view_vendor_external_orders','guard_name'=>'web'],
        ];
        Permission::insert($permissions);
    }
}
