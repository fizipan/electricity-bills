<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $employee_permissions = $admin_permissions->filter(function ($permission) {
            return $permission->title != 'management_access' && substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(2)->permissions()->sync($employee_permissions);
        $customer_permissions = $admin_permissions->filter(function ($permission) {
            return $permission->title == 'dashboard_access' || substr($permission->title, 0, 5) == 'bill_' && substr($permission->title, 0, 13) != 'bill_confirm_' || substr($permission->title, 0, 12) == 'transaction_';
        });
        Role::findOrFail(3)->permissions()->sync($customer_permissions);
    }
}
