<?php

namespace Database\Seeders;

use App\Models\Menus;

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            [
                'name'          => 'Section Menu',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Dashboard',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'User',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Role',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Permission',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Group Rate',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Rate',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Customer',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Customer Usage',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Bill',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
            [
                'name'          => 'Transaction',
                'information'   => '',
                'created_at'    => '2021-03-15 00:00:00',
                'updated_at'    => '2021-03-15 00:00:00',
            ],
        ];

        Menus::insert($menu);
    }
}
