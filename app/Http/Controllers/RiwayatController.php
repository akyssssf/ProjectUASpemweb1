<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        // Tambahkan with('antrian') untuk mengambil status terbaru
        $riwayat = Pendaftaran::where('pasien_id', Auth::guard('pasien')->id())
                     ->with('antrian') 
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('pendaftaran.riwayat', compact('riwayat'));
    }
}