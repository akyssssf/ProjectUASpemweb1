<?php

namespace Database\Seeders;

use App\Models\Klinik;
use Illuminate\Database\Seeder;

class KlinikPoliDokterSeeder extends Seeder
{
    /**
     * PENTING: nama dokter di sini HARUS SAMA PERSIS dengan kolom `name`
     * di tabel `staffs` untuk akun staff bertipe dokter. DokterController
     * mencocokkan nama dokter di pendaftaran dengan nama staff yang login
     * (bukan lewat relasi/ID), jadi penulisan nama (termasuk "Dr." dan spasi)
     * harus konsisten antara tabel `dokters` dan akun staff terkait.
     */
    public function run(): void
    {
        $data = [
            'Klinik Red Grave' => [
                'Poli Bedah' => ['Dr. Dante', 'Dr. Vergil'],
                'Poli Umum'  => ['Dr. Lady', 'Dr. Trish'],
            ],
            'Klinik Raccoon City' => [
                'Poli Saraf' => ['Dr. Leon Kennedy', 'Dr. Jill Valentine'],
                'Poli Umum'  => ['Dr. Chris Redfield', 'Dr. Rebecca Chambers'],
            ],
            'Klinik Fortuna' => [
                'Poli Bedah' => ['Dr. Nero', 'Dr. Credo'],
                'Poli Saraf' => ['Dr. Kyrie', 'Dr. Nico'],
            ],
        ];

        foreach ($data as $namaKlinik => $poliList) {
            $klinik = Klinik::create(['nama' => $namaKlinik]);

            foreach ($poliList as $namaPoli => $dokterList) {
                $poli = $klinik->polis()->create(['nama' => $namaPoli]);

                foreach ($dokterList as $namaDokter) {
                    $poli->dokters()->create(['nama' => $namaDokter]);
                }
            }
        }
    }
}