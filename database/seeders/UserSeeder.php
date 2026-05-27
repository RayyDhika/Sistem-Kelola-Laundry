<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN OUTLET 1
        User::create([
            'name' => 'Admin Outlet 1',
            'email' => 'admin1@gmail.com',
            'telepon' => '08123456789',
            'jk' => 'L',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'id_outlet' => 1,
        ]);
    }
}