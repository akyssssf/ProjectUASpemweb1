<?php

namespace Database\Seeders;

use App\Models\Klinik;
use App\Models\Poli;
use App\Models\Dokter;
use Illuminate\Database\Seeder;

class KaresidenanMadiunSeeder extends Seeder
{
    /**
     * RS nyata di Karesidenan Madiun (Kota Madiun, Kab. Madiun,
     * Magetan, Ngawi, Ponorogo, Pacitan, Trenggalek).
     * Nama dokter fiktif tapi realistis — sesuaikan dengan data nyata
     * jika diperlukan untuk keperluan produksi.
     */
    public function run(): void
    {
        $data = [

            // ── KOTA MADIUN ──────────────────────────────────────────────
            [
                'nama' => 'RSUD dr. Soedono Madiun',
                'polis' => [
                    'Poli Umum'        => ['dr. Andi Susanto', 'dr. Siti Rahayu'],
                    'Poli Penyakit Dalam' => ['dr. Budi Santoso Sp.PD', 'dr. Dewi Lestari Sp.PD'],
                    'Poli Bedah'       => ['dr. Agus Wahyudi Sp.B', 'dr. Rina Marlina Sp.B'],
                    'Poli Jantung'     => ['dr. Hendra Kusuma Sp.JP', 'dr. Lina Fitriani Sp.JP'],
                    'Poli Anak'        => ['dr. Maya Sari Sp.A', 'dr. Dimas Aditya Sp.A'],
                    'Poli Saraf'       => ['dr. Teguh Prasetyo Sp.S'],
                    'Poli Kandungan'   => ['dr. Yuni Astuti Sp.OG'],
                    'Poli Mata'        => ['dr. Reza Pratama Sp.M'],
                    'Poli Gigi'        => ['drg. Anita Permata', 'drg. Fajar Nugroho'],
                ],
            ],
            [
                'nama' => 'RS Santa Clara Madiun',
                'polis' => [
                    'Poli Umum'        => ['dr. Yohanes Kristianto', 'dr. Maria Magdalena'],
                    'Poli Penyakit Dalam' => ['dr. Stefanus Hadi Sp.PD'],
                    'Poli Bedah'       => ['dr. Paulus Wijaya Sp.B'],
                    'Poli Anak'        => ['dr. Elisabeth Sari Sp.A'],
                    'Poli Kandungan'   => ['dr. Bernadette Kusuma Sp.OG'],
                    'Poli Gigi'        => ['drg. Theresia Indah'],
                ],
            ],
            [
                'nama' => 'RSUD Kota Madiun',
                'polis' => [
                    'Poli Umum'        => ['dr. Supriyanto', 'dr. Endah Wulandari'],
                    'Poli Penyakit Dalam' => ['dr. Wahyu Hidayat Sp.PD'],
                    'Poli Bedah'       => ['dr. Bambang Irawan Sp.B'],
                    'Poli Anak'        => ['dr. Nurul Hidayah Sp.A'],
                    'Poli Gigi'        => ['drg. Slamet Riyadi'],
                    'Poli Rehabilitasi Medik' => ['dr. Fitri Handayani Sp.RM'],
                ],
            ],
            [
                'nama' => 'RS Islam Siti Aisyah Madiun',
                'polis' => [
                    'Poli Umum'        => ['dr. Ahmad Fauzi', 'dr. Khoirul Anam'],
                    'Poli Penyakit Dalam' => ['dr. Zainul Arifin Sp.PD'],
                    'Poli Bedah'       => ['dr. Miftahul Huda Sp.B'],
                    'Poli Kandungan'   => ['dr. Siti Fatimah Sp.OG'],
                    'Poli Anak'        => ['dr. Abdurrahman Sp.A'],
                    'Poli Gigi'        => ['drg. Nur Aini'],
                ],
            ],
            [
                'nama' => 'RS Griya Husada Madiun',
                'polis' => [
                    'Poli Umum'        => ['dr. Christanto Wibowo', 'dr. Melinda Sari'],
                    'Poli Mata'        => ['dr. Gunawan Setiawan Sp.M'],
                    'Poli Penyakit Dalam' => ['dr. Retno Handayani Sp.PD'],
                    'Poli Digestif'    => ['dr. Surya Dermawan Sp.PD-KGEH'],
                    'Poli Gigi'        => ['drg. Hendra Wijaya'],
                ],
            ],
            [
                'nama' => 'RS Paru Manguharjo Madiun',
                'polis' => [
                    'Poli Paru'        => ['dr. Purwanto Sp.P', 'dr. Lilis Suryani Sp.P'],
                    'Poli Umum'        => ['dr. Hariyanto', 'dr. Sinta Dewi'],
                    'Poli Anak'        => ['dr. Nugroho Sp.A'],
                    'Poli Saraf'       => ['dr. Kartini Sp.S'],
                    'Poli Gigi'        => ['drg. Wahyu Setiabudi'],
                ],
            ],

            // ── KABUPATEN MADIUN ─────────────────────────────────────────
            [
                'nama' => 'RSUD Caruban Kab. Madiun',
                'polis' => [
                    'Poli Umum'        => ['dr. Tri Wibowo', 'dr. Ayu Permatasari'],
                    'Poli Penyakit Dalam' => ['dr. Sumarno Sp.PD'],
                    'Poli Bedah'       => ['dr. Wawan Kurniawan Sp.B'],
                    'Poli Anak'        => ['dr. Lestari Sp.A'],
                    'Poli Kandungan'   => ['dr. Ratna Dewi Sp.OG'],
                    'Poli Gigi'        => ['drg. Eko Prasetyo'],
                ],
            ],
            [
                'nama' => 'RSUD Dungus Kab. Madiun',
                'polis' => [
                    'Poli Umum'        => ['dr. Joko Susilo', 'dr. Yanti Rahayu'],
                    'Poli Penyakit Dalam' => ['dr. Haryono Sp.PD'],
                    'Poli Anak'        => ['dr. Indah Kumala Sp.A'],
                    'Poli Gigi'        => ['drg. Desi Wulandari'],
                ],
            ],

            // ── MAGETAN ──────────────────────────────────────────────────
            [
                'nama' => 'RSUD dr. Sayidiman Magetan',
                'polis' => [
                    'Poli Umum'        => ['dr. Widodo Prasetyo', 'dr. Sari Kusumawati'],
                    'Poli Penyakit Dalam' => ['dr. Hendri Santoso Sp.PD'],
                    'Poli Bedah'       => ['dr. Fendi Kurniawan Sp.B'],
                    'Poli Anak'        => ['dr. Ariani Sp.A'],
                    'Poli Kandungan'   => ['dr. Novi Rahmawati Sp.OG'],
                    'Poli Saraf'       => ['dr. Baskoro Sp.S'],
                    'Poli Gigi'        => ['drg. Listya Ningsih'],
                ],
            ],

            // ── NGAWI ────────────────────────────────────────────────────
            [
                'nama' => 'RSUD dr. Soeroto Ngawi',
                'polis' => [
                    'Poli Umum'        => ['dr. Slamet Budi', 'dr. Rina Oktaviani'],
                    'Poli Penyakit Dalam' => ['dr. Kuncoro Sp.PD'],
                    'Poli Bedah'       => ['dr. Subagyo Sp.B'],
                    'Poli Anak'        => ['dr. Dini Pratiwi Sp.A'],
                    'Poli Kandungan'   => ['dr. Sri Wahyuni Sp.OG'],
                    'Poli Gigi'        => ['drg. Heri Santoso'],
                    'Poli Mata'        => ['dr. Yudhistira Sp.M'],
                ],
            ],

            // ── PONOROGO ─────────────────────────────────────────────────
            [
                'nama' => 'RSUD dr. Harjono Ponorogo',
                'polis' => [
                    'Poli Umum'        => ['dr. Agung Nugroho', 'dr. Harum Sari'],
                    'Poli Penyakit Dalam' => ['dr. Rudy Hartono Sp.PD', 'dr. Yeni Kartika Sp.PD'],
                    'Poli Bedah'       => ['dr. Taufik Hidayat Sp.B'],
                    'Poli Anak'        => ['dr. Cahya Ningrum Sp.A'],
                    'Poli Kandungan'   => ['dr. Puji Lestari Sp.OG'],
                    'Poli Jantung'     => ['dr. Handoko Sp.JP'],
                    'Poli Saraf'       => ['dr. Rahmat Hidayat Sp.S'],
                    'Poli Gigi'        => ['drg. Elok Fitriani', 'drg. Dedy Prasetyo'],
                    'Poli Jiwa'        => ['dr. Anwar Sanusi Sp.KJ'],
                ],
            ],
            [
                'nama' => 'RS Aisyiyah Ponorogo',
                'polis' => [
                    'Poli Umum'        => ['dr. Hasan Bisri', 'dr. Umi Kulsum'],
                    'Poli Penyakit Dalam' => ['dr. Muzakki Sp.PD'],
                    'Poli Anak'        => ['dr. Zulaikha Sp.A'],
                    'Poli Kandungan'   => ['dr. Fatimah Az-Zahra Sp.OG'],
                    'Poli Gigi'        => ['drg. Rohmad Fauzi'],
                ],
            ],

            // ── PACITAN ──────────────────────────────────────────────────
            [
                'nama' => 'RSUD dr. Darsono Pacitan',
                'polis' => [
                    'Poli Umum'        => ['dr. Suroto Wicaksono', 'dr. Dwi Rahayu'],
                    'Poli Penyakit Dalam' => ['dr. Prasetyo Sp.PD'],
                    'Poli Bedah'       => ['dr. Guntur Wibisono Sp.B'],
                    'Poli Anak'        => ['dr. Layla Fitriani Sp.A'],
                    'Poli Kandungan'   => ['dr. Endang Sp.OG'],
                    'Poli Gigi'        => ['drg. Wahyu Hidayat'],
                ],
            ],

            // ── TRENGGALEK ───────────────────────────────────────────────
            [
                'nama' => 'RSUD dr. Soedomo Trenggalek',
                'polis' => [
                    'Poli Umum'        => ['dr. Hari Wibowo', 'dr. Retno Sari'],
                    'Poli Penyakit Dalam' => ['dr. Suharto Sp.PD'],
                    'Poli Bedah'       => ['dr. Priyo Utomo Sp.B'],
                    'Poli Anak'        => ['dr. Wulandari Sp.A'],
                    'Poli Kandungan'   => ['dr. Suci Ramadhani Sp.OG'],
                    'Poli Saraf'       => ['dr. Ardiansyah Sp.S'],
                    'Poli Gigi'        => ['drg. Yeni Setiawati'],
                ],
            ],
        ];

        foreach ($data as $rsData) {
            $klinik = Klinik::firstOrCreate(['nama' => $rsData['nama']]);

            foreach ($rsData['polis'] as $namaPoliKey => $dokters) {
                $poli = Poli::firstOrCreate([
                    'klinik_id' => $klinik->id,
                    'nama'      => $namaPoliKey,
                ]);

                foreach ($dokters as $namaDokter) {
                    Dokter::firstOrCreate([
                        'poli_id' => $poli->id,
                        'nama'    => $namaDokter,
                    ]);
                }
            }
        }

        $this->command->info('Seeder Karesidenan Madiun selesai: ' . count($data) . ' RS, ' . Poli::count() . ' poli, ' . Dokter::count() . ' dokter.');
    }
}
