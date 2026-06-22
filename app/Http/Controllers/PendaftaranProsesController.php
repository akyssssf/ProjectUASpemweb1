<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Antrian;
use Illuminate\Support\Facades\Auth;

class PendaftaranProsesController extends Controller
{
    public function simpanUmum(Request $request)
    {
        $pasien = Auth::guard('pasien')->user();

        $pendaftaran = Pendaftaran::create([
            'pasien_id'         => $pasien->id,
            'jenis_pendaftaran' => 'umum',
            'klinik'            => $request->klinik,
            'poli'              => $request->poli,
            'dokter'            => $request->dokter,
            'tanggal'           => $request->tanggal,
            'keluhan'           => $request->keluhan,
            'status'            => 'menunggu',
        ]);

        $antrian = Antrian::buatUntuk($pendaftaran);

        return redirect('/dashboard')->with('success', 'Pendaftaran Berhasil! Nomor antrian Anda: ' . $antrian->nomor_antrian);
    }
}