<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; // <-- WAJIB ADA INI
use Illuminate\Support\Facades\Auth;

class PendaftaranProsesController extends Controller
{
    public function simpanUmum(Request $request)
    {
        $pasien = Auth::guard('pasien')->user();

        // Simpan data
        Pendaftaran::create([
            'pasien_id' => $pasien->id,
            'klinik'    => $request->klinik,
            'poli'      => $request->poli,
            'dokter'    => $request->dokter,
            'tanggal'   => $request->tanggal,
            'keluhan'   => $request->keluhan,
            'status'    => 'menunggu',
        ]);
        
        return redirect('/dashboard')->with('success', 'Pendaftaran Berhasil!');
    }
}