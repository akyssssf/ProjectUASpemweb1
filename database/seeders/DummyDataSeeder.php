<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Antrian;
use App\Models\MedicalRecord;
use App\Models\Survei;
use App\Models\Klinik;
use App\Models\Poli;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. PASIEN ────────────────────────────────────────────────────
        $pasienData = [
            ['name' => 'Budi Santoso',       'email' => 'budi@gmail.com',     'nik' => '3577010101900001', 'no_hp' => '081234567801', 'alamat' => 'Jl. Mayjend Panjaitan No.5, Madiun'],
            ['name' => 'Siti Rahayu',         'email' => 'siti@gmail.com',     'nik' => '3577010202910002', 'no_hp' => '081234567802', 'alamat' => 'Jl. Ahmad Yani No.12, Madiun'],
            ['name' => 'Agus Priyono',        'email' => 'agus@gmail.com',     'nik' => '3577010303850003', 'no_hp' => '081234567803', 'alamat' => 'Jl. Diponegoro No.7, Madiun'],
            ['name' => 'Dewi Lestari',        'email' => 'dewi@gmail.com',     'nik' => '3577014404920004', 'no_hp' => '081234567804', 'alamat' => 'Perum Griya Asri Blok C2, Caruban'],
            ['name' => 'Eko Wahyudi',         'email' => 'eko@gmail.com',      'nik' => '3577010505880005', 'no_hp' => '081234567805', 'alamat' => 'Jl. Raya Ngawi KM 3, Ngawi'],
            ['name' => 'Fitri Handayani',     'email' => 'fitri@gmail.com',    'nik' => '3577016606930006', 'no_hp' => '081234567806', 'alamat' => 'Jl. Pahlawan No.15, Magetan'],
            ['name' => 'Gunawan Setiawan',    'email' => 'gunawan@gmail.com',  'nik' => '3577010707800007', 'no_hp' => '081234567807', 'alamat' => 'Jl. Alun-alun Utara No.3, Ponorogo'],
            ['name' => 'Heni Puspita',        'email' => 'heni@gmail.com',     'nik' => '3577018808950008', 'no_hp' => '081234567808', 'alamat' => 'Jl. Raya Pacitan No.22, Pacitan'],
            ['name' => 'Irwan Saputra',       'email' => 'irwan@gmail.com',    'nik' => '3577010909870009', 'no_hp' => '081234567809', 'alamat' => 'Desa Nglongsor, Trenggalek'],
            ['name' => 'Joko Widodo Susanto', 'email' => 'joko@gmail.com',     'nik' => '3577011010830010', 'no_hp' => '081234567810', 'alamat' => 'Jl. Sudirman No.45, Madiun'],
            ['name' => 'Kartini Wulandari',   'email' => 'kartini@gmail.com',  'nik' => '3577011111960011', 'no_hp' => '081234567811', 'alamat' => 'Jl. Ki Hajar Dewantara No.8, Madiun'],
            ['name' => 'Lukman Hakim',        'email' => 'lukman@gmail.com',   'nik' => '3577011212820012', 'no_hp' => '081234567812', 'alamat' => 'Jl. Imam Bonjol No.11, Madiun'],
            ['name' => 'Maya Sari Dewi',      'email' => 'maya@gmail.com',     'nik' => '3577011313900013', 'no_hp' => '081234567813', 'alamat' => 'Perum Taman Madiun Blok A5'],
            ['name' => 'Nurul Hidayah',       'email' => 'nurul@gmail.com',    'nik' => '3577011414940014', 'no_hp' => '081234567814', 'alamat' => 'Jl. Merpati No.3, Ngawi'],
            ['name' => 'Oki Permana',         'email' => 'oki@gmail.com',      'nik' => '3577011515910015', 'no_hp' => '081234567815', 'alamat' => 'Jl. Garuda No.9, Magetan'],
            ['name' => 'Putri Amalia',        'email' => 'putri@gmail.com',    'nik' => '3577011616980016', 'no_hp' => '081234567816', 'alamat' => 'Jl. Arjuna No.17, Ponorogo'],
            ['name' => 'Rudi Hartono',        'email' => 'rudi@gmail.com',     'nik' => '3577011717860017', 'no_hp' => '081234567817', 'alamat' => 'Desa Karangtengah, Ponorogo'],
            ['name' => 'Sri Wahyuni',         'email' => 'sri@gmail.com',      'nik' => '3577011818930018', 'no_hp' => '081234567818', 'alamat' => 'Jl. Raya Madiun-Solo KM 5, Madiun'],
            ['name' => 'Teguh Prasetyo',      'email' => 'teguh@gmail.com',    'nik' => '3577011919840019', 'no_hp' => '081234567819', 'alamat' => 'Jl. Cokroaminoto No.33, Madiun'],
            ['name' => 'Uswatun Khasanah',    'email' => 'uswatun@gmail.com',  'nik' => '3577012020970020', 'no_hp' => '081234567820', 'alamat' => 'Jl. Letjend Suprapto No.6, Madiun'],
        ];

        $pasiens = [];
        foreach ($pasienData as $p) {
            $pasiens[] = Pasien::firstOrCreate(
                ['email' => $p['email']],
                array_merge($p, ['password' => Hash::make('password123')])
            );
        }
        $this->command->info('✅ ' . count($pasiens) . ' pasien dibuat (password: password123)');

        // ── 2. DATA PENDUKUNG ────────────────────────────────────────────
        $kliniks = Klinik::with(['polis.dokters'])->get();
        if ($kliniks->isEmpty()) {
            $this->command->warn('⚠️  Tidak ada klinik! Jalankan KaresidenanMadiunSeeder dulu.');
            return;
        }

        $keluhanList = [
            'Sakit kepala dan pusing sejak 3 hari',
            'Demam tinggi disertai batuk',
            'Nyeri perut bagian bawah',
            'Sesak napas saat aktivitas ringan',
            'Nyeri sendi dan otot',
            'Batuk berdahak lebih dari 2 minggu',
            'Mual dan muntah berulang',
            'Gatal-gatal di kulit',
            'Penglihatan kabur',
            'Sakit gigi dan gusi bengkak',
            'Kontrol tekanan darah rutin',
            'Kontrol gula darah',
            'Nyeri punggung bawah kronik',
            'Susah tidur dan gelisah',
            'Kontrol pasca operasi',
        ];

        $soapData = [
            ['s' => 'Pasien mengeluh sakit kepala berdenyut sejak 3 hari, disertai mual.',
             'o' => 'TD: 130/85 mmHg, Nadi: 88x/mnt, Suhu: 36.8°C, SpO2: 98%',
             'a' => 'Migrain tanpa aura (G43.0)',
             'p' => 'Paracetamol 500mg 3x1, Ibuprofen 400mg 2x1, istirahat cukup, kontrol 3 hari.'],
            ['s' => 'Pasien demam sejak 2 hari, suhu 38.5°C, disertai batuk kering dan lemas.',
             'o' => 'TD: 120/80 mmHg, Nadi: 92x/mnt, Suhu: 38.5°C, SpO2: 97%, faring hiperemis',
             'a' => 'Faringitis akut + demam (J02.9)',
             'p' => 'Amoxicillin 500mg 3x1, Paracetamol 500mg 3x1, banyak minum, kontrol 5 hari.'],
            ['s' => 'Pasien nyeri perut kanan bawah sejak kemarin, mual, tidak nafsu makan.',
             'o' => 'TD: 110/70 mmHg, Suhu: 37.2°C, nyeri tekan McBurney (+), Rovsing sign (+)',
             'a' => 'Appendisitis akut (K37)',
             'p' => 'Rujuk bedah untuk evaluasi appendektomi, puasa, IVFD RL 20 tpm.'],
            ['s' => 'Pasien sesak napas saat naik tangga, tidak ada nyeri dada, batuk produktif.',
             'o' => 'TD: 140/90 mmHg, Nadi: 96x/mnt, RR: 24x/mnt, Suhu: 36.5°C, ronkhi basah halus (+)',
             'a' => 'Asma bronkial dengan eksaserbasi ringan (J45.9)',
             'p' => 'Salbutamol inhaler 2 puff k/p, Budesonide inhaler 2x2 puff, kontrol 1 minggu.'],
            ['s' => 'Pasien nyeri sendi lutut bilateral, kaku pagi hari lebih dari 30 menit.',
             'o' => 'TD: 125/80 mmHg, edema sendi lutut bilateral (+), krepitasi (+), ROM terbatas',
             'a' => 'Osteoartritis genu bilateral (M17.1)',
             'p' => 'Meloxicam 7.5mg 1x1 malam, fisioterapi 3x seminggu, kurangi aktivitas berat.'],
        ];

        $komentarList = [
            'Pelayanan sangat baik dan ramah, dokternya sangat sabar menjelaskan kondisi saya.',
            'Antrean cepat dan fasilitas bersih. Dokter sangat profesional dan teliti.',
            'Cukup puas dengan pelayanannya, proses administrasi juga mudah.',
            'Dokternya teliti dan penjelasannya mudah dipahami oleh awam.',
            'Perawat ramah dan ruang tunggu nyaman. Sangat direkomendasikan.',
            'Pelayanan baik, tidak perlu menunggu terlalu lama.',
            'Sangat membantu dan responsif terhadap keluhan pasien.',
            'Proses pendaftaran mudah, sistem digital sangat membantu.',
            'Fasilitas lengkap dan bersih. Dokter spesialisnya berpengalaman.',
            'Dokter menjelaskan dengan detail dan tidak terburu-buru.',
            'Pelayanan memuaskan, akan kembali jika butuh periksa lagi.',
            'Rumah sakit bersih dan nyaman, staf sangat helpful.',
            null, null,
        ];

        // ── 3. PENDAFTARAN + ANTRIAN + REKAM MEDIS ───────────────────────
        $noAntrian = 1;
        $pendaftaranCount = 0;

        foreach ($pasiens as $idx => $pasien) {
            $jumlah = rand(2, 4);
            for ($i = 0; $i < $jumlah; $i++) {
                $klinik = $kliniks->random();
                $poli   = $klinik->polis->isNotEmpty() ? $klinik->polis->random() : null;
                $dokter = ($poli && $poli->dokters->isNotEmpty()) ? $poli->dokters->random() : null;
                if (!$poli || !$dokter) continue;

                $tanggal = Carbon::now()->subDays(rand(1, 120))->format('Y-m-d');
                $jenis   = rand(0, 1) ? 'BPJS' : 'Umum';
                $rand    = rand(1, 10);
                $statusAntrian = $rand <= 7 ? 'selesai' : ($rand <= 9 ? 'dipanggil' : 'menunggu');
                $prefix  = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $poli->nama), 0, 1));

                $pendaftaran = Pendaftaran::create([
                    'pasien_id'         => $pasien->id,
                    'jenis_pendaftaran' => $jenis,
                    'no_bpjs'           => $jenis === 'BPJS' ? '000' . str_pad($pasien->id * 10 + $i, 10, '0', STR_PAD_LEFT) : null,
                    'faskes_asal'       => $jenis === 'BPJS' ? 'Puskesmas ' . ['Madiun', 'Caruban', 'Ngawi', 'Ponorogo', 'Magetan'][rand(0, 4)] : null,
                    'jenis_rujukan'     => $jenis === 'BPJS' ? ['mandiri', 'puskesmas', 'rs_lain'][rand(0, 2)] : null,
                    'klinik'            => $klinik->nama,
                    'poli'              => $poli->nama,
                    'dokter'            => $dokter->nama,
                    'tanggal'           => $tanggal,
                    'keluhan'           => $keluhanList[array_rand($keluhanList)],
                    'status'            => $statusAntrian === 'selesai' ? 'selesai' : 'menunggu',
                ]);

                Antrian::create([
                    'pendaftaran_id'  => $pendaftaran->id,
                    'klinik'          => $klinik->nama,
                    'nomor_antrian'   => $prefix . '-' . $noAntrian++,
                    'poli'            => $poli->nama,
                    'tanggal_antrian' => $tanggal,
                    'status'          => $statusAntrian,
                ]);

                if ($statusAntrian === 'selesai') {
                    $dokterStaff = Staff::where('name', $dokter->nama)->first();
                    if ($dokterStaff) {
                        $soap = $soapData[array_rand($soapData)];
                        MedicalRecord::create([
                            'pasien_id'  => $pasien->id,
                            'staff_id'   => $dokterStaff->id,
                            'subjective' => $soap['s'],
                            'objective'  => $soap['o'],
                            'assessment' => $soap['a'],
                            'plan'       => $soap['p'],
                        ]);
                    }

                    // Survei spesifik per kunjungan
                    if (rand(1, 10) <= 8) {
                        Survei::create([
                            'pasien_id'      => $pasien->id,
                            'klinik_id'      => $klinik->id,
                            'poli_id'        => $poli->id,
                            'pendaftaran_id' => $pendaftaran->id,
                            'tipe'           => 'spesifik',
                            'rating'         => rand(3, 5),
                            'komentar'       => $komentarList[array_rand($komentarList)],
                        ]);
                    }
                }

                $pendaftaranCount++;
            }
        }

        // ── 4. PASTIKAN SEMUA KLINIK PUNYA RATING ────────────────────────
        // Ini yang bikin tidak ada RS kosong rating-nya
        $pasienPool = collect($pasiens);

        foreach ($kliniks as $klinik) {
            $sudahAdaSurvei = Survei::where('klinik_id', $klinik->id)->count();

            // Minimal 5 survei per klinik (campuran umum dan per poli)
            $kurang = max(0, 5 - $sudahAdaSurvei);

            for ($i = 0; $i < $kurang + rand(3, 8); $i++) {
                $pasien = $pasienPool->random();
                $poli   = $klinik->polis->isNotEmpty() ? $klinik->polis->random() : null;

                Survei::create([
                    'pasien_id'      => $pasien->id,
                    'klinik_id'      => $klinik->id,
                    'poli_id'        => $poli?->id,
                    'pendaftaran_id' => null,
                    'tipe'           => 'umum',
                    'rating'         => rand(3, 5),
                    'komentar'       => $komentarList[array_rand($komentarList)],
                ]);
            }

            // Pastikan setiap POLI juga punya minimal 2 survei
            foreach ($klinik->polis as $poli) {
                $sudahAdaPoli = Survei::where('poli_id', $poli->id)->count();
                $kurangPoli   = max(0, 2 - $sudahAdaPoli);

                for ($j = 0; $j < $kurangPoli; $j++) {
                    $pasien = $pasienPool->random();
                    Survei::create([
                        'pasien_id'      => $pasien->id,
                        'klinik_id'      => $klinik->id,
                        'poli_id'        => $poli->id,
                        'pendaftaran_id' => null,
                        'tipe'           => 'umum',
                        'rating'         => rand(3, 5),
                        'komentar'       => $komentarList[array_rand($komentarList)],
                    ]);
                }
            }
        }

        $this->command->info("✅ $pendaftaranCount pendaftaran + antrian dibuat");
        $this->command->info('✅ ' . MedicalRecord::count() . ' rekam medis dibuat');
        $this->command->info('✅ ' . Survei::count() . ' survei dibuat (semua RS punya rating)');
        $this->command->info('');
        $this->command->info('📋 Akun pasien demo (password: password123):');
        $this->command->info('   budi@gmail.com | NIK: 3577010101900001');
        $this->command->info('   siti@gmail.com | NIK: 3577010202910002');
    }
}
