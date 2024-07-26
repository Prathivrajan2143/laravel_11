<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'rajan',
            'email' => 'rajan@gmail.com',
            'phone' => '8056169617',
            'password' => bcrypt('123456'),
        ]);
        User::create([
            'name' => 'ram',
            'email' => 'ram@gmail.com',
            'phone' => '8056169617',
            'password' => bcrypt('123456'),
        ]);
        User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'phone' => '8056169617',
            'password' => bcrypt('123456'),
        ]);
        User::create([
            'name' => 'jeevan',
            'email' => 'jeevan@gmail.com',
            'phone' => '8056169617',
            'password' => bcrypt('123456'),
        ]);
        User::create([
            'name' => 'varadha',
            'email' => 'varadha@gmail.com',
            'phone' => '8056169617',
            'password' => bcrypt('123456'),
        ]);
    }
}
