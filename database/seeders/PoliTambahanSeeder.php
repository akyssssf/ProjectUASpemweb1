<?php

namespace Database\Seeders;

use App\Models\Klinik;
use Illuminate\Database\Seeder;

class PoliTambahanSeeder extends Seeder
{
    /**
     * Menambahkan Poli Gigi, Poli Anak, dan Poli Ibu Hamil
     * ke semua klinik yang sudah ada (Red Grave, Raccoon City, Fortuna).
     *
     * PENTING: nama dokter di sini harus sama persis dengan kolom `name`
     * di tabel `staffs` jika nantinya dokter ini dibuatkan akun login,
     * karena DokterController mencocokkan berdasarkan nama, bukan ID.
     */
    public function run(): void
    {
        $poliTambahan = [
            'Poli Gigi' => ['dr. Andi Pratama', 'drg. Siti Rahmawati'],
            'Poli Anak' => ['dr. Budi Santoso, Sp.A', 'dr. Maya Putri, Sp.A'],
            'Poli Ibu Hamil' => ['dr. Ratna Dewi, Sp.OG', 'dr. Indra Wijaya, Sp.OG'],
        ];

        $kliniks = Klinik::all();

        foreach ($kliniks as $klinik) {
            foreach ($poliTambahan as $namaPoli => $dokterList) {
                $poli = $klinik->polis()->create(['nama' => $namaPoli]);

                foreach ($dokterList as $namaDokter) {
                    $poli->dokters()->create(['nama' => $namaDokter]);
                }
            }
        }
    }
}