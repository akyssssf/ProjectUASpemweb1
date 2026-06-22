<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StaffAuthController extends Controller
{
    // Tampilkan form login staff
    public function showLogin()
    {
        return view('auth.staff-login'); 
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('staff')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $staff = Auth::guard('staff')->user();

            // LOGIKA PEMBAGIAN HALAMAN BERDASARKAN ROLE
            if ($staff->role === 'admin') {
                return redirect()->intended('/petugas/dashboard');
            } 
            elseif ($staff->role === 'dokter') {
                // Arahkan ke route dokter yang sudah kita buat
                return redirect()->intended('/petugas/dashboard-dokter');
            }
            
            // Jika bukan admin atau dokter, arahkan ke monitoring (petugas antrian)
            return redirect()->intended('/petugas/monitoring');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/petugas/login');
    }
}