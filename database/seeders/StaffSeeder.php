<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::firstOrCreate(
            ['email' => 'admin@klinik.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('123456'),
                'role'     => 'admin',
            ]
        );
    }
}