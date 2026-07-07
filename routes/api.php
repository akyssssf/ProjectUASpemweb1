<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveiController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\PasienController;

// Route untuk bikin akun (Register)
Route::post('/register', function (Request $request) {
    $user = User::create([
        'name' => 'Pasien Test',
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);
    return response()->json(['message' => 'Akun berhasil dibuat'], 201);
});

// Route Autentikasi Khusus API
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Kredensial salah'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ], 200);
});

// Route yang diproteksi Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('surveys', SurveiController::class);

    // Endpoint filtering Staff & Pasien
    Route::get('/staff', [StaffController::class, 'index']);
    Route::get('/pasien', [PasienController::class, 'index']);
});