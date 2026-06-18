<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; 
use Illuminate\Support\Facades\Auth;

class PendaftaranBpjsController extends Controller
{
    public function simpan(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'no_bpjs'       => 'required|string|max:13',
            'faskes_asal'   => 'required|string',
            'klinik'        => 'required|string',
            'poli'          => 'required|string',
            'dokter'        => 'required|string',
            'jenis_rujukan' => 'required|string',
            'tanggal'       => 'required|date',
            'keluhan'       => 'nullable|string',
        ]);

        // 2. Simpan ke database
        Pendaftaran::create([
            'pasien_id'         => Auth::guard('pasien')->id(),
            'no_bpjs'           => $request->no_bpjs,
            'faskes_asal'       => $request->faskes_asal,
            'jenis_rujukan'     => $request->jenis_rujukan,
            'klinik'            => $request->klinik,
            'poli'              => $request->poli,
            'dokter'            => $request->dokter,
            'tanggal'           => $request->tanggal,
            'keluhan'           => $request->keluhan,
            'jenis_pendaftaran' => 'BPJS', 
            'status'            => 'menunggu', 
        ]);

        // 3. Redirect ke dashboard dengan pesan sukses
        return redirect('/dashboard')->with('success', 'Pendaftaran BPJS berhasil diajukan! Silakan menunggu verifikasi.');
    }
}