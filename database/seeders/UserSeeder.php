<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $users = [
            [
                'name'     => 'Admin user',
                'email'    => 'admin@example.com',
                'password' => Hash::make('admin'),
                'birthday' => '2021-01-01',
                'role_id'  => 1
            ],
            [
                'name'     => 'User',
                'email'    => 'user@example.com',
                'password' => Hash::make('user'),
                'birthday' => '2021-01-01',
                'role_id'  => 2
            ]
        ];
        foreach ($users as $user) {
            User::create($user);

        }
    }
}
