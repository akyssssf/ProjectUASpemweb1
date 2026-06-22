<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::create([
            'name' => 'Petugas Klinik',
            'email' => 'petugas@klinik.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}