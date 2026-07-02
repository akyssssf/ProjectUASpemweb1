<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\Staff;
use App\Models\Klinik;
use App\Models\Pendaftaran;
use App\Models\Antrian;
use App\Models\MedicalRecord;
use App\Models\Survei;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * DEMO SCENARIO SEEDER
 * --------------------
 * Menyiapkan state sistem yang siap demo semua fitur:
 *
 * PASIEN DEMO:
 *   Email    : demo@pasien.com
 *   NIK      : 3577099999990001
 *   Password : demo1234
 *
 * ADMIN:
 *   Email    : admin@klinik.com
 *   Password : 123456
 *
 * DOKTER DEMO (RSUD dr. Soedono):
 *   Email    : dr-andi-susanto@klinik.com
 *   Password : dokter123
 *
 * SKENARIO YANG DISIAPKAN:
 *   ✅ Pasien sudah punya 2 riwayat kunjungan SELESAI (bisa isi survei)
 *   🔔 Pasien punya 1 antrian DIPANGGIL hari ini (bisa lihat popup)
 *   ⏳ Pasien punya 1 antrian MENUNGGU hari ini (bisa dipanggil oleh petugas)
 *   📋 Ada 3 antrian menunggu di monitoring petugas (siap dipanggil)
 *   👨‍⚕️ Ada 2 antrian DIPANGGIL di dashboard dokter (siap input rekam medis)
 */
class DemoScenarioSeeder extends Seeder
{
    public function run(): void
    {
        $today = Carbon::today()->format('Y-m-d');

        // ── Ambil RS & dokter ──────────────────────────────────────────
        $klinikSoedono = Klinik::where('nama', 'RSUD dr. Soedono Madiun')->first();
        if (!$klinikSoedono) {
            $this->command->error('Jalankan KaresidenanMadiunSeeder dulu!');
            return;
        }

        $poliUmum    = $klinikSoedono->polis()->where('nama', 'Poli Umum')->first();
        $poliJantung = $klinikSoedono->polis()->where('nama', 'Poli Jantung')->first();
        $poliBedah   = $klinikSoedono->polis()->where('nama', 'Poli Bedah')->first();
        $poliAnak    = $klinikSoedono->polis()->where('nama', 'Poli Anak')->first();

        $dokterUmum    = $poliUmum?->dokters()->first();
        $dokterJantung = $poliJantung?->dokters()->first();
        $dokterBedah   = $poliBedah?->dokters()->first();
        $dokterAnak    = $poliAnak?->dokters()->first();

        $dokterUmumStaff    = Staff::where('name', $dokterUmum?->nama)->first();
        $dokterJantungStaff = Staff::where('name', $dokterJantung?->nama)->first();

        // ── 1. PASIEN DEMO ─────────────────────────────────────────────
        $pasienDemo = Pasien::firstOrCreate(
            ['email' => 'demo@pasien.com'],
            [
                'name'     => 'Ahmad Demo Pasien',
                'nik'      => '3577099999990001',
                'no_hp'    => '08123456789',
                'alamat'   => 'Jl. Demo No.1, Madiun',
                'password' => Hash::make('demo1234'),
            ]
        );

        // Pasien tambahan untuk ramaikan antrian
        $pasienLain = [];
        $namaPasienLain = [
            ['name' => 'Slamet Riyadi',    'email' => 'slamet.demo@gmail.com',  'nik' => '3577099999990002'],
            ['name' => 'Endah Wulandari',  'email' => 'endah.demo@gmail.com',   'nik' => '3577099999990003'],
            ['name' => 'Bambang Irawan',   'email' => 'bambang.demo@gmail.com', 'nik' => '3577099999990004'],
            ['name' => 'Rina Oktaviani',   'email' => 'rina.demo@gmail.com',    'nik' => '3577099999990005'],
            ['name' => 'Yusuf Pratama',    'email' => 'yusuf.demo@gmail.com',   'nik' => '3577099999990006'],
        ];
        foreach ($namaPasienLain as $p) {
            $pasienLain[] = Pasien::firstOrCreate(
                ['email' => $p['email']],
                array_merge($p, [
                    'no_hp'    => '0812345678' . rand(10, 99),
                    'alamat'   => 'Jl. Demo, Madiun',
                    'password' => Hash::make('demo1234'),
                ])
            );
        }

        // ── 2. RIWAYAT SELESAI (untuk demo survei di halaman riwayat) ──
        // Kunjungan 1: SELESAI, belum isi survei → muncul tombol "Beri Penilaian"
        $pendaftaran1 = Pendaftaran::create([
            'pasien_id'         => $pasienDemo->id,
            'jenis_pendaftaran' => 'BPJS',
            'no_bpjs'           => '0009999000001',
            'faskes_asal'       => 'Puskesmas Madiun',
            'jenis_rujukan'     => 'puskesmas',
            'klinik'            => $klinikSoedono->nama,
            'poli'              => $poliUmum?->nama ?? 'Poli Umum',
            'dokter'            => $dokterUmum?->nama ?? 'dr. Andi Susanto',
            'tanggal'           => Carbon::now()->subDays(7)->format('Y-m-d'),
            'keluhan'           => 'Sakit kepala dan demam sejak 3 hari, disertai mual',
            'status'            => 'menunggu',
        ]);
        Antrian::create([
            'pendaftaran_id'  => $pendaftaran1->id,
            'nomor_antrian'   => 'U-101',
            'poli'            => $poliUmum?->nama ?? 'Poli Umum',
            'tanggal_antrian' => Carbon::now()->subDays(7)->format('Y-m-d'),
            'status'          => 'selesai',
        ]);
        if ($dokterUmumStaff) {
            MedicalRecord::create([
                'pasien_id'  => $pasienDemo->id,
                'staff_id'   => $dokterUmumStaff->id,
                'subjective' => 'Pasien mengeluh sakit kepala berdenyut sejak 3 hari, disertai demam dan mual.',
                'objective'  => 'TD: 120/80 mmHg, Nadi: 88x/mnt, Suhu: 38.2°C, SpO2: 98%, faring hiperemis',
                'assessment' => 'Faringitis akut + febris (J02.9)',
                'plan'       => 'Amoxicillin 500mg 3x1, Paracetamol 500mg 3x1, banyak minum air, kontrol 5 hari.',
            ]);
        }
        // Sengaja TIDAK buat survei → tombol "Beri Penilaian" muncul di riwayat

        // Kunjungan 2: SELESAI, sudah isi survei → tampil bintang di riwayat
        $pendaftaran2 = Pendaftaran::create([
            'pasien_id'         => $pasienDemo->id,
            'jenis_pendaftaran' => 'Umum',
            'klinik'            => $klinikSoedono->nama,
            'poli'              => $poliJantung?->nama ?? 'Poli Jantung',
            'dokter'            => $dokterJantung?->nama ?? 'dr. Hendra Kusuma Sp.JP',
            'tanggal'           => Carbon::now()->subDays(30)->format('Y-m-d'),
            'keluhan'           => 'Kontrol tekanan darah dan jantung rutin',
            'status'            => 'menunggu',
        ]);
        Antrian::create([
            'pendaftaran_id'  => $pendaftaran2->id,
            'nomor_antrian'   => 'J-055',
            'poli'            => $poliJantung?->nama ?? 'Poli Jantung',
            'tanggal_antrian' => Carbon::now()->subDays(30)->format('Y-m-d'),
            'status'          => 'selesai',
        ]);
        Survei::create([
            'pasien_id'      => $pasienDemo->id,
            'klinik_id'      => $klinikSoedono->id,
            'poli_id'        => $poliJantung?->id,
            'pendaftaran_id' => $pendaftaran2->id,
            'tipe'           => 'spesifik',
            'rating'         => 5,
            'komentar'       => 'Dokternya sangat teliti dan sabar menjelaskan. Fasilitas lengkap.',
        ]);

        // ── 3. ANTRIAN HARI INI — DIPANGGIL (demo popup antrean pasien) ─
        $pendaftaran3 = Pendaftaran::create([
            'pasien_id'         => $pasienDemo->id,
            'jenis_pendaftaran' => 'BPJS',
            'no_bpjs'           => '0009999000002',
            'faskes_asal'       => 'Puskesmas Taman',
            'jenis_rujukan'     => 'puskesmas',
            'klinik'            => $klinikSoedono->nama,
            'poli'              => $poliUmum?->nama ?? 'Poli Umum',
            'dokter'            => $dokterUmum?->nama ?? 'dr. Andi Susanto',
            'tanggal'           => $today,
            'keluhan'           => 'Batuk dan pilek sudah 1 minggu tidak sembuh',
            'status'            => 'menunggu',
        ]);
        Antrian::create([
            'pendaftaran_id'  => $pendaftaran3->id,
            'nomor_antrian'   => 'U-003',
            'poli'            => $poliUmum?->nama ?? 'Poli Umum',
            'tanggal_antrian' => $today,
            'status'          => 'dipanggil', // langsung dipanggil → demo popup suara
        ]);

        // ── 4. ANTRIAN HARI INI — MENUNGGU (bisa dipanggil petugas) ────
        // Pasien lain yang menunggu di monitoring, agar petugas bisa demo panggil
        $antrianMenunggu = [
            ['pasien' => $pasienLain[0], 'poli' => $poliUmum,    'dokter' => $dokterUmum,    'nomor' => 'U-004', 'keluhan' => 'Nyeri tenggorokan dan demam'],
            ['pasien' => $pasienLain[1], 'poli' => $poliBedah,   'dokter' => $dokterBedah,   'nomor' => 'B-001', 'keluhan' => 'Kontrol luka pasca operasi'],
            ['pasien' => $pasienLain[2], 'poli' => $poliJantung, 'dokter' => $dokterJantung, 'nomor' => 'J-002', 'keluhan' => 'Sesak napas dan nyeri dada'],
            ['pasien' => $pasienLain[3], 'poli' => $poliUmum,    'dokter' => $dokterUmum,    'nomor' => 'U-005', 'keluhan' => 'Pusing berputar sejak pagi'],
            ['pasien' => $pasienLain[4], 'poli' => $poliAnak,    'dokter' => $dokterAnak,    'nomor' => 'A-001', 'keluhan' => 'Anak demam dan batuk pilek'],
        ];

        foreach ($antrianMenunggu as $item) {
            if (!$item['poli'] || !$item['dokter']) continue;
            $pend = Pendaftaran::create([
                'pasien_id'         => $item['pasien']->id,
                'jenis_pendaftaran' => 'Umum',
                'klinik'            => $klinikSoedono->nama,
                'poli'              => $item['poli']->nama,
                'dokter'            => $item['dokter']->nama,
                'tanggal'           => $today,
                'keluhan'           => $item['keluhan'],
                'status'            => 'menunggu',
            ]);
            Antrian::create([
                'pendaftaran_id'  => $pend->id,
                'nomor_antrian'   => $item['nomor'],
                'poli'            => $item['poli']->nama,
                'tanggal_antrian' => $today,
                'status'          => 'menunggu',
            ]);
        }

        // ── 5. ANTRIAN DIPANGGIL untuk dokter (siap input rekam medis) ─
        $antrianDipanggil = [
            ['pasien' => $pasienLain[0], 'poli' => $poliUmum,    'dokter' => $dokterUmum,    'staff' => $dokterUmumStaff,    'nomor' => 'U-001'],
            ['pasien' => $pasienLain[1], 'poli' => $poliJantung, 'dokter' => $dokterJantung, 'staff' => $dokterJantungStaff, 'nomor' => 'J-001'],
        ];

        foreach ($antrianDipanggil as $item) {
            if (!$item['poli'] || !$item['dokter']) continue;
            $pend = Pendaftaran::create([
                'pasien_id'         => $item['pasien']->id,
                'jenis_pendaftaran' => 'Umum',
                'klinik'            => $klinikSoedono->nama,
                'poli'              => $item['poli']->nama,
                'dokter'            => $item['dokter']->nama,
                'tanggal'           => $today,
                'keluhan'           => 'Pemeriksaan rutin',
                'status'            => 'menunggu',
            ]);
            Antrian::create([
                'pendaftaran_id'  => $pend->id,
                'nomor_antrian'   => $item['nomor'],
                'poli'            => $item['poli']->nama,
                'tanggal_antrian' => $today,
                'status'          => 'dipanggil', // langsung muncul di dashboard dokter
            ]);
        }

        // ── Output ringkasan ───────────────────────────────────────────
        $this->command->info('');
        $this->command->info('🎯 ═══════════════════════════════════════════');
        $this->command->info('🎯  DEMO SCENARIO SIAP — PANDUAN DEMO');
        $this->command->info('🎯 ═══════════════════════════════════════════');
        $this->command->info('');
        $this->command->info('👤 AKUN PASIEN DEMO:');
        $this->command->info('   Email    : demo@pasien.com');
        $this->command->info('   NIK      : 3577099999990001');
        $this->command->info('   Password : demo1234');
        $this->command->info('');
        $this->command->info('👑 AKUN ADMIN:');
        $this->command->info('   Email    : admin@klinik.com');
        $this->command->info('   Password : 123456');
        $this->command->info('');
        $this->command->info('👨‍⚕️ AKUN DOKTER DEMO (Poli Umum RSUD Soedono):');
        $this->command->info('   Email    : ' . (str()->slug($dokterUmum?->nama ?? 'dr-andi-susanto') . '@klinik.com'));
        $this->command->info('   Password : dokter123');
        $this->command->info('');
        $this->command->info('📋 URUTAN DEMO:');
        $this->command->info('   1. [PUBLIK]   Buka /rating → lihat semua RS Madiun dengan rating');
        $this->command->info('   2. [PUBLIK]   Klik RS → beri survei umum tanpa login');
        $this->command->info('   3. [PASIEN]   Login demo@pasien.com → lihat dashboard');
        $this->command->info('   4. [PASIEN]   Cek Antrean → ada popup DIPANGGIL (U-003)');
        $this->command->info('   5. [PASIEN]   Lihat Riwayat → ada tombol Beri Penilaian');
        $this->command->info('   6. [PASIEN]   Isi survei spesifik dari riwayat');
        $this->command->info('   7. [PASIEN]   Daftar pendaftaran baru (BPJS/Umum)');
        $this->command->info('   8. [PETUGAS]  Login admin → /petugas/monitoring');
        $this->command->info('   9. [PETUGAS]  Panggil antrian U-004, B-001, dst');
        $this->command->info('  10. [PETUGAS]  Klik Selesai setelah dipanggil');
        $this->command->info('  11. [DOKTER]   Login dokter → dashboard dokter');
        $this->command->info('  12. [DOKTER]   Klik Periksa → input rekam medis SOAP');
        $this->command->info('  13. [ADMIN]    Login admin → kelola staff & hapus pasien');
        $this->command->info('');
        $this->command->info('🎯 ═══════════════════════════════════════════');
    }
}
