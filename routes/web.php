<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route sementara untuk testing UI
Route::get('/test-login', function () {
    return view('auth.login');
});

Route::get('/test-register', function () {
    return view('auth.register');
});

Route::get('/test-dashboard', function () {
    return view('patient.dashboard');
});
