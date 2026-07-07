<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DokterStaffSeeder extends Seeder
{
    public function run(): void
    {
        $namaUnik = Dokter::distinct()->pluck('nama');

        $dibuat = 0;
        $dilewati = 0;

        foreach ($namaUnik as $nama) {
            $email = Str::slug($nama) . '@klinik.com';

            $staff = Staff::firstOrCreate(
                ['email' => $email],
                [
                    'name'     => $nama,
                    'password' => Hash::make('dokter123'),
                    'role'     => 'dokter',
                ]
            );

            $staff->wasRecentlyCreated ? $dibuat++ : $dilewati++;
        }

        $this->command->info("Akun dokter dibuat: {$dibuat} akun baru, {$dilewati} sudah ada sebelumnya (dilewati). Password semua: dokter123");
    }
}