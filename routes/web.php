<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienAuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PendaftaranProsesController;
use App\Http\Controllers\PendaftaranBpjsController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\AntreanController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\SurveiPasienController;
use App\Http\Controllers\RatingRsController;
use App\Http\Controllers\FetchBpsController;
use App\Models\Klinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- Route Utama ---
Route::get('/fix-db', function () {
    try {
        if (!Illuminate\Support\Facades\Schema::hasColumn('antrians', 'klinik')) {
            Illuminate\Support\Facades\DB::statement('ALTER TABLE antrians ADD COLUMN klinik VARCHAR(255) AFTER id');
        }
        if (!Illuminate\Support\Facades\Schema::hasColumn('pendaftarans', 'jenis_pendaftaran')) {
            Illuminate\Support\Facades\DB::statement('ALTER TABLE pendaftarans ADD COLUMN jenis_pendaftaran VARCHAR(255) AFTER pasien_id');
        }
        return "Database berhasil diperbaiki! Silakan kembali ke form pendaftaran.";
    } catch (\Throwable $e) {
        return "Gagal: " . $e->getMessage();
    }
});

Route::get('/', function () {
    return view('welcome');
});

// --- Route Publik: Proxy API BPS (statistik fasilitas kesehatan) ---
Route::get('/api/bps', [FetchBpsController::class, 'fetch'])->name('bps.fetch');

// --- Route Publik: Cari RS berdasarkan rating ---
Route::get('/rating', [RatingRsController::class, 'index'])->name('rating.index');
Route::get('/rating/{id}', [RatingRsController::class, 'show'])->name('rating.show');
Route::post('/rating/survei-umum', [SurveiPasienController::class, 'simpanUmum'])->name('survei.umum');

// API endpoint: ambil dokter berdasarkan klinik & poli (untuk dropdown dinamis di halaman rating)
Route::get('/api/dokter-by-poli', function(\Illuminate\Http\Request $request) {
    $klinikId = $request->get('klinik_id');
    $poliNama = $request->get('poli');
    $dokters = \App\Models\Dokter::whereHas('poli', function($q) use ($klinikId, $poliNama) {
        $q->where('klinik_id', $klinikId)->where('nama', $poliNama);
    })->get(['nama']);
    return response()->json($dokters);
});

// --- Route Auth Pasien ---
Route::get('/login', [PasienAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [PasienAuthController::class, 'login']);
Route::get('/register', [PasienAuthController::class, 'showRegister']);
Route::post('/register', [PasienAuthController::class, 'register']);
Route::post('/logout', [PasienAuthController::class, 'logout']);

// --- Route Auth Staff ---
Route::get('/petugas/login', [StaffAuthController::class, 'showLogin'])->name('petugas.login');
Route::post('/petugas/login', [StaffAuthController::class, 'login']);
Route::post('/petugas/logout', [StaffAuthController::class, 'logout'])->name('petugas.logout');

// --- Route Dashboard & Layanan Pasien ---
Route::middleware(['auth:pasien'])->group(function () {
    Route::get('/dashboard', function () { return view('patient.dashboard'); });
    Route::get('/pendaftaran', [PendaftaranController::class, 'pilihJenis']);
    Route::get('/pendaftaran/riwayat', [RiwayatController::class, 'index'])->name('pendaftaran.riwayat');
    Route::get('/antrean', [AntreanController::class, 'index']);
    Route::get('/antrean/status', [AntreanController::class, 'statusSekarang']);

    Route::get('/pendaftaran/form', function (Request $request) {

        // Ambil semua klinik beserta poli & dokternya dari database
        $kliniks = Klinik::with('polis.dokters')->get();

        // Bentuk ulang jadi array bersarang, supaya view (form-umum/form-bpjs)
        // tidak perlu diubah sama sekali — strukturnya tetap sama seperti sebelumnya:
        // ['Klinik Red Grave' => ['Poli Bedah' => ['Dr. Dante', 'Dr. Vergil'], ...], ...]
        $dataKlinik = [];
        foreach ($kliniks as $klinik) {
            foreach ($klinik->polis as $poli) {
                $dataKlinik[$klinik->nama][$poli->nama] = $poli->dokters->pluck('nama')->toArray();
            }
        }

        $pasien = Auth::guard('pasien')->user();

        if ($request->jenis == 'umum') {
            return view('pendaftaran.form-umum', compact('pasien', 'dataKlinik'));
        }
        if ($request->jenis == 'bpjs') {
            return view('pendaftaran.form-bpjs', compact('pasien', 'dataKlinik'));
        }
        return redirect('/pendaftaran');
    });

    Route::post('/pendaftaran/simpan-umum', [PendaftaranProsesController::class, 'simpanUmum']);
    Route::post('/pendaftaran/simpan-bpjs', [PendaftaranBpjsController::class, 'simpan']);

    Route::post('/survei/spesifik', [SurveiPasienController::class, 'simpanSpesifik'])->name('survei.spesifik');
});

// --- Route Khusus Petugas ---
Route::middleware(['auth:staff'])->prefix('petugas')->group(function () {
    // Monitoring bisa diakses semua staf
    Route::get('/monitoring', [MonitoringController::class, 'index']);
    Route::post('/monitoring/panggil/{id}', [MonitoringController::class, 'panggil'])->name('monitoring.panggil');
    Route::post('/monitoring/selesai/{id}', [MonitoringController::class, 'selesai'])->name('monitoring.selesai');

    // --- Rute Khusus Dokter ---
    Route::middleware(['role:dokter'])->group(function () {
        Route::get('/dashboard-dokter', [DokterController::class, 'index'])->name('dokter.dashboard');
        Route::get('/rekam-medis/create/{antrian_id}', [DokterController::class, 'create'])->name('rekam_medis.create');
        Route::post('/rekam-medis/store', [DokterController::class, 'store'])->name('rekam_medis.store');
    });

    // --- Rute Khusus Admin ---
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/staff-register', [StaffController::class, 'create'])->name('staff.register');
        Route::post('/staff-register', [StaffController::class, 'store']);
        Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
        Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

        Route::get('/pasien/{id}/edit', [AdminDashboardController::class, 'editPasien'])->name('pasien.edit');
        Route::put('/pasien/{id}', [AdminDashboardController::class, 'updatePasien'])->name('pasien.update');
        Route::delete('/pasien/{id}', [AdminDashboardController::class, 'destroyPasien'])->name('pasien.destroy');
    });
});
