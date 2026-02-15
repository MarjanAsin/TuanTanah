<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin1'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('admin2'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin 3',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('admin3'),
            'role' => 'pemilik',
        ]);
    }
}
