<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// --- Route Utama ---
Route::get('/', function () {
    return view('welcome');
});

// --- Route Auth (Login & Register) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('patient.dashboard');
})->middleware('auth');

// --- Route Sementara (Testing UI) ---
Route::get('/test-login', function () {
    return view('auth.login');
});

Route::get('/test-register', function () {
    return view('auth.register');
});

Route::get('/test-dashboard', function () {
    return view('patient.dashboard');
});