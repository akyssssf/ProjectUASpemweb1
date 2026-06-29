<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::create([
            'name' => 'Admin',
            'email' => 'admin@klinik.com',
            'password' => Hash::make('123456'), // Ganti password sesuai keinginanmu
            'role' => 'admin',
        ]);
    }
}