<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        $hariIni = now()->format('Y-m-d');

        // Antrean aktif (menunggu & dipanggil), beserta data pasien lewat relasi pendaftaran
        $antrianAktif = Antrian::with('pendaftaran.pasien')
            ->where('tanggal_antrian', $hariIni)
            ->where('status', '!=', 'selesai')
            ->orderBy('id', 'asc')
            ->get();

        // Riwayat selesai hari ini
        $riwayatSelesai = Antrian::with('pendaftaran.pasien')
            ->where('tanggal_antrian', $hariIni)
            ->where('status', 'selesai')
            ->orderByDesc('updated_at')
            ->get();

        return view('petugas.monitoring', compact('antrianAktif', 'riwayatSelesai'));
    }

    public function panggil($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->update(['status' => 'dipanggil']);

        return redirect('/petugas/monitoring');
    }

    public function selesai($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->update(['status' => 'selesai']);

        return redirect('/petugas/monitoring');
    }
}