<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienAuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PendaftaranProsesController;
use App\Http\Controllers\PendaftaranBpjsController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- Route Utama ---
Route::get('/', function () {
    return view('welcome');
});

// --- Route Auth ---
Route::get('/login', [PasienAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [PasienAuthController::class, 'login']);
Route::get('/register', [PasienAuthController::class, 'showRegister']);
Route::post('/register', [PasienAuthController::class, 'register']);
Route::post('/logout', [PasienAuthController::class, 'logout']);

// --- Route Dashboard & Layanan Pasien ---
Route::middleware(['auth:pasien'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('patient.dashboard');
    });

    Route::get('/pendaftaran', [PendaftaranController::class, 'pilihJenis']);
    Route::get('/pendaftaran/riwayat', [RiwayatController::class, 'index'])->name('pendaftaran.riwayat');
    
    // Rute Form Pendaftaran dengan Data Klinik
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

        if ($request->jenis == 'umum') {
            return view('pendaftaran.form-umum', compact('pasien', 'dataKlinik'));
        } elseif ($request->jenis == 'bpjs') {
            return view('pendaftaran.form-bpjs', compact('pasien', 'dataKlinik'));
        }
        return redirect('/pendaftaran');
    });

    // Rute Proses Simpan
    Route::post('/pendaftaran/simpan-umum', [PendaftaranProsesController::class, 'simpanUmum']);
    Route::post('/pendaftaran/simpan-bpjs', [PendaftaranBpjsController::class, 'simpan']);
});