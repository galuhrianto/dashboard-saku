<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {

DB::table('users')->insert([
    [
        'name' => 'Admin',
        'username' => '1',
        'password' => Hash::make('1'),
        'role_id' => 1, // admin
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'User',
        'username' => '2',
        'password' => Hash::make('2'),
        'role_id' => 2, // user
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);
    }
}
