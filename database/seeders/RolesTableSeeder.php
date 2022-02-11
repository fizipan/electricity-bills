<?php

namespace Database\Seeders;

use App\Models\Role;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'title'      => 'Admin',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'Employee',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'Customer',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
            [
                'title'      => 'Guest',
                'created_at' => '2021-03-15 00:00:00',
                'updated_at' => '2021-03-15 00:00:00',
            ],
        ];

        Role::insert($roles);
    }
}
