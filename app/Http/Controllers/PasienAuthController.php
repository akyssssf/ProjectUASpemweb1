<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasienAuthController extends Controller
{
    // --- Register ---
    public function showRegister() { return view('auth.register'); }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pasiens',
            'password' => 'required|confirmed|min:6',
            'nik' => 'required|digits:16|unique:pasiens,nik',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        Pasien::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

// --- Login ---
    public function showLogin() { return view('auth.login'); }

    public function login(Request $request) {
        // 1. Validasi input: wajib email, password, dan NIK
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'nik' => 'required|digits:16', 
        ]);

        // 2. Cek apakah ada pasien dengan email, password, dan NIK yang cocok
        // Kita masukkan NIK ke dalam array attempt
        if (Auth::guard('pasien')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'nik' => $request->nik // NIK disertakan dalam pengecekan
        ])) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        // 3. Jika gagal
        return back()->withErrors(['email' => 'Email, Password, atau NIK tidak cocok.']);
    }

    // --- Logout ---
    public function logout(Request $request) {
        Auth::guard('pasien')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}