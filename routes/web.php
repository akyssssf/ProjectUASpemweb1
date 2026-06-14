<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienAuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PendaftaranProsesController;
use Illuminate\Http\Request;

// --- Route Utama ---
Route::get('/', function () {
    return view('welcome');
});

// --- Route Auth (Login & Register Pasien) ---
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

    // Rute Pendaftaran
    Route::get('/pendaftaran', [PendaftaranController::class, 'pilihJenis']);
    
    // Rute Form Pendaftaran
    Route::get('/pendaftaran/form', function(Request $request) {
        if ($request->jenis == 'umum') {
            return view('pendaftaran.form-umum');
        } elseif ($request->jenis == 'bpjs') {
            return view('pendaftaran.form-bpjs'); // Nanti kita buat file ini
        }
        return redirect('/pendaftaran');
    });

    // Rute Proses Simpan
    Route::post('/pendaftaran/simpan-umum', [PendaftaranProsesController::class, 'simpanUmum']);
    
});

// --- Route Testing ---
Route::get('/test-login', function () {
    return view('auth.login');
});

Route::get('/test-register', function () {
    return view('auth.register');
});

Route::get('/test-dashboard', function () {
    return view('patient.dashboard');
});