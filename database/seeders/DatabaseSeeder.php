<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Urutan penting: Klinik/Poli/Dokter harus dibuat dulu sebelum
     * DokterStaffSeeder, karena DokterStaffSeeder membaca nama-nama
     * dokter yang sudah ada di tabel `dokters`.
     */
    public function run(): void
    {
        $this->call([
            StaffSeeder::class,            // akun admin@klinik.com
            KlinikPoliDokterSeeder::class, // klinik, poli, dokter awal
            PoliTambahanSeeder::class,     // poli & dokter tambahan
            DokterStaffSeeder::class,      // akun login untuk semua dokter
        ]);
    }
}