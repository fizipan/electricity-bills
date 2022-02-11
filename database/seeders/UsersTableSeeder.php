<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'           => 'Admin',
                'email'          => 'admin@mail.com',
                'password'       => '$2y$10$jA0iQrNaBwxrqITQEETQeOADwQZxyqo0BSfi6ngEuNz9H8MF.8vYG', //Admin@12345
                'remember_token' => null,
                'created_at'     => '2021-03-15 00:00:00',
                'updated_at'     => '2021-03-15 00:00:00',
            ],
            [
                'name'           => 'Employee',
                'email'          => 'employee@mail.com',
                'password'       => '$2a$12$bVkAc5KDFj5/9jYnBCfUL.6yM1V/dOCqcHxSVNfkAIebM7WT0q6um', //Employee@12345
                'remember_token' => null,
                'created_at'     => '2021-03-15 00:00:00',
                'updated_at'     => '2021-03-15 00:00:00',
            ],
        ];

        User::insert($users);
    }
}
