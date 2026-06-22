<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Support\Facades\Auth;

class AntreanController extends Controller
{
    // Halaman cek antrean pasien
    public function index()
    {
        $pasien = Auth::guard('pasien')->user();
        $hariIni = now()->format('Y-m-d');

        // Ambil antrian milik pasien ini untuk hari ini (yang belum selesai, kalau ada)
        $antrian = Antrian::whereHas('pendaftaran', function ($q) use ($pasien) {
                $q->where('pasien_id', $pasien->id);
            })
            ->where('tanggal_antrian', $hariIni)
            ->orderByDesc('id')
            ->first();

        return view('patient.antrean', compact('antrian'));
    }

    // Endpoint JSON, dipanggil via fetch() polling dari antrean.blade.php
    public function statusSekarang()
    {
        $pasien = Auth::guard('pasien')->user();
        $hariIni = now()->format('Y-m-d');

        $antrian = Antrian::whereHas('pendaftaran', function ($q) use ($pasien) {
                $q->where('pasien_id', $pasien->id);
            })
            ->where('tanggal_antrian', $hariIni)
            ->orderByDesc('id')
            ->first();

        if ($antrian) {
            return response()->json([
                'ada_antrian'   => true,
                'nomor_antrian' => $antrian->nomor_antrian,
                'poli'          => $antrian->poli,
                'status'        => $antrian->status,
            ]);
        }

        return response()->json([
            'ada_antrian' => false,
        ]);
    }
}