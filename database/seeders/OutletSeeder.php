<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    public function run(): void
    {
        Outlet::create([
            'nm_outlet' => 'BubbleBliss Pusat',
            'alamat' => 'Jl. Merdeka No. 1',
            'no_telp' => '08123456789',
            'owner' => 'Dhika',
        ]);

    }
}