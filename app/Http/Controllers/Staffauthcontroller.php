<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::guard('staff')->attempt($credentials)) {
            $request->session()->regenerate();

            $staff = Auth::guard('staff')->user();

            // Redirect berbeda tergantung role staff yang login
            if ($staff->role === 'admin') {
                return redirect('/petugas/dashboard');
            }

            if ($staff->role === 'dokter') {
                return redirect('/petugas/dashboard-dokter');
            }

            // Role lain (loket, nakes, dst) masuk ke monitoring antrian
            return redirect('/petugas/monitoring');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
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