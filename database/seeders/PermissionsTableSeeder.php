<?php

namespace Database\Seeders;

use App\Models\Permission;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'title'      => 'dashboard_access',
                'menus_id'   => '2',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'dashboard_filter',
                'menus_id'   => '2',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'management_access',
                'menus_id'   => '1',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'user_access',
                'menus_id'   => '3',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'user_table',
                'menus_id'   => '3',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'user_create',
                'menus_id'   => '3',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'user_edit',
                'menus_id'   => '3',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'user_show',
                'menus_id'   => '3',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'user_delete',
                'menus_id'   => '3',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'user_filter',
                'menus_id'   => '3',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'user_reset_password',
                'menus_id'   => '3',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'role_access',
                'menus_id'   => '4',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'role_table',
                'menus_id'   => '4',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'role_create',
                'menus_id'   => '4',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'role_edit',
                'menus_id'   => '4',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'role_show',
                'menus_id'   => '4',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'role_delete',
                'menus_id'   => '4',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'permission_access',
                'menus_id'   => '5',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'permission_table',
                'menus_id'   => '5',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'permission_create',
                'menus_id'   => '5',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'permission_edit',
                'menus_id'   => '5',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'permission_show',
                'menus_id'   => '5',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'permission_delete',
                'menus_id'   => '5',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'permission_filter',
                'menus_id'   => '5',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'master_data_access',
                'menus_id'   => '1',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'operational_access',
                'menus_id'   => '1',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'transaction_access',
                'menus_id'   => '1',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'bill_access',
                'menus_id'   => '10',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'bill_table',
                'menus_id'   => '10',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'bill_show',
                'menus_id'   => '10',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'bill_pay',
                'menus_id'   => '10',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'bill_upload_pay',
                'menus_id'   => '10',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'bill_confirm_pay',
                'menus_id'   => '10',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'group_rate_access',
                'menus_id'   => '6',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'group_rate_table',
                'menus_id'   => '6',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'group_rate_create',
                'menus_id'   => '6',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'group_rate_edit',
                'menus_id'   => '6',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'group_rate_show',
                'menus_id'   => '6',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'group_rate_delete',
                'menus_id'   => '6',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'rate_access',
                'menus_id'   => '7',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'rate_table',
                'menus_id'   => '7',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'rate_create',
                'menus_id'   => '7',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'rate_edit',
                'menus_id'   => '7',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'rate_show',
                'menus_id'   => '7',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'rate_delete',
                'menus_id'   => '7',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_access',
                'menus_id'   => '8',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_table',
                'menus_id'   => '8',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_create',
                'menus_id'   => '8',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_edit',
                'menus_id'   => '8',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_show',
                'menus_id'   => '8',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_delete',
                'menus_id'   => '8',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_usage_access',
                'menus_id'   => '9',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_usage_table',
                'menus_id'   => '9',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_usage_create',
                'menus_id'   => '9',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_usage_edit',
                'menus_id'   => '9',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_usage_show',
                'menus_id'   => '9',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'customer_usage_delete',
                'menus_id'   => '9',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'transaction_table',
                'menus_id'   => '11',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'transaction_show',
                'menus_id'   => '11',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
        ];

        Permission::insert($permissions);
    }
}
