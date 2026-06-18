<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class PendaftaranProsesController extends Controller
{
    public function simpanUmum(Request $request)
    {
        $pasien = Auth::guard('pasien')->user();

        Pendaftaran::create([
            'pasien_id'         => $pasien->id,
            'jenis_pendaftaran' => 'umum', // <--- TAMBAHKAN INI
            'klinik'            => $request->klinik,
            'poli'              => $request->poli,
            'dokter'            => $request->dokter,
            'tanggal'           => $request->tanggal,
            'keluhan'           => $request->keluhan,
            'status'            => 'menunggu',
        ]);
        
        return redirect('/dashboard')->with('success', 'Pendaftaran Berhasil!');
    }
}