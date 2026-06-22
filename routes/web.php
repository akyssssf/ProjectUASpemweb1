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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- Route Utama ---
Route::get('/', function () {
    return view('welcome');
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

    Route::get('/pendaftaran/form', function(Request $request) {
        $dataKlinik = [
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
            ]
        ];

        $pasien = Auth::guard('pasien')->user();
        if ($request->jenis == 'umum') return view('pendaftaran.form-umum', compact('pasien', 'dataKlinik'));
        if ($request->jenis == 'bpjs') return view('pendaftaran.form-bpjs', compact('pasien', 'dataKlinik'));
        return redirect('/pendaftaran');
    });

    Route::post('/pendaftaran/simpan-umum', [PendaftaranProsesController::class, 'simpanUmum']);
    Route::post('/pendaftaran/simpan-bpjs', [PendaftaranBpjsController::class, 'simpan']);
});

// --- Route Khusus Petugas ---
Route::middleware(['auth:staff'])->prefix('petugas')->group(function () {
    // Monitoring bisa diakses semua staf
    Route::get('/monitoring', [MonitoringController::class, 'index']);
    Route::get('/monitoring/panggil/{id}', [MonitoringController::class, 'panggil']);
    Route::get('/monitoring/selesai/{id}', [MonitoringController::class, 'selesai']);

    // Rute Khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Rute CRUD Staff Lengkap
        Route::get('/staff-register', [StaffController::class, 'create'])->name('staff.register');
        Route::post('/staff-register', [StaffController::class, 'store']);
        Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
        Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
    });
});