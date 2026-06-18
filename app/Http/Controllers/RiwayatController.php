<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        // Hanya mengambil data milik user yang sedang login
        $riwayat = Pendaftaran::where('pasien_id', Auth::guard('pasien')->id())
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('pendaftaran.riwayat', compact('riwayat'));
    }
}