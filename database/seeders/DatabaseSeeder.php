<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            StaffSeeder::class,             // admin@klinik.com / 123456
            KaresidenanMadiunSeeder::class, // 14 RS nyata Karesidenan Madiun
            DokterStaffSeeder::class,       // akun login semua dokter (dokter123)
            DummyDataSeeder::class,         // 20 pasien + pendaftaran + rekam medis + survei
            DemoScenarioSeeder::class,      // skenario demo siap pakai
        ]);
    }
}
