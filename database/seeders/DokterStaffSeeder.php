<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DokterStaffSeeder extends Seeder
{
    /**
     * Membuatkan 1 akun staff (role: dokter) untuk setiap NAMA dokter unik
     * yang ada di tabel `dokters`. Karena DokterController mencocokkan
     * antrean berdasarkan nama (bukan ID), nama akun staff di sini akan
     * sama persis dengan nama di tabel `dokters` -- jadi tidak perlu
     * diketik manual satu-satu lewat halaman admin.
     *
     * Password sama untuk semua: "dokter123"
     * Email auto-generate dari nama, contoh: "Dr. Dante" -> dr-dante@klinik.com
     *
     * Jalankan setelah KlinikPoliDokterSeeder & PoliTambahanSeeder, supaya
     * tabel `dokters` sudah terisi duluan.
     */
    public function run(): void
    {
        $namaUnik = Dokter::distinct()->pluck('nama');

        foreach ($namaUnik as $nama) {
            $email = Str::slug($nama) . '@klinik.com';

            Staff::firstOrCreate(
                ['name' => $nama],
                [
                    'email'    => $email,
                    'password' => Hash::make('dokter123'),
                    'role'     => 'dokter',
                ]
            );
        }

        $this->command->info('Akun dokter dibuat: ' . $namaUnik->count() . ' akun. Password semua: dokter123');
    }
}