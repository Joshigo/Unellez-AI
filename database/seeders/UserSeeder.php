<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create users
        User::create([
            'role_id' => 1,
            'name' => 'Super Admin',
            'ci' => '12345678',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'Admin',
            'ci' => '87654321',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'role_id' => 3,
            'program_id' => 5,
            'name' => 'Trainer',
            'ci' => '123456780',
            'email' => 'trainer@example.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'role_id' => 4,
            'program_id' => 5,
            'name' => 'User',
            'ci' => '876543210',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'role_id' => 4,
            'program_id' => 5,
            'name' => 'User',
            'ci' => '29939125',
            'email' => 'hidalgojosemanuel59@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
