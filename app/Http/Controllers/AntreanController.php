<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Support\Facades\Auth;

class AntreanController extends Controller
{
    const MENIT_PER_PASIEN = 5;

    // Halaman cek antrean pasien
    public function index()
    {
        $pasien = Auth::guard('pasien')->user();
        $hariIni = now()->format('Y-m-d');

        $antrian = Antrian::whereHas('pendaftaran', function ($q) use ($pasien) {
                $q->where('pasien_id', $pasien->id);
            })
            ->where('tanggal_antrian', $hariIni)
            ->orderByDesc('id')
            ->first();

        $sedangDipanggil = null;
        $estimasiMenit = null;

        if ($antrian) {
            // Nomor yang sedang dipanggil di poli yang sama, hari ini
            $sedangDipanggilModel = Antrian::where('poli', $antrian->poli)
                ->where('tanggal_antrian', $hariIni)
                ->where('status', 'dipanggil')
                ->orderByDesc('id')
                ->first();

            $sedangDipanggil = $sedangDipanggilModel ? $sedangDipanggilModel->nomor_antrian : null;

            // Estimasi waktu tunggu, hanya relevan jika status masih menunggu
            if ($antrian->status === 'menunggu') {
                $estimasiMenit = $this->hitungEstimasi($antrian, $hariIni);
            }
        }

        return view('patient.antrean', compact('antrian', 'sedangDipanggil', 'estimasiMenit'));
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

        if (!$antrian) {
            return response()->json(['ada_antrian' => false]);
        }

        $sedangDipanggilModel = Antrian::where('poli', $antrian->poli)
            ->where('tanggal_antrian', $hariIni)
            ->where('status', 'dipanggil')
            ->orderByDesc('id')
            ->first();

        $estimasiMenit = $antrian->status === 'menunggu'
            ? $this->hitungEstimasi($antrian, $hariIni)
            : null;

        return response()->json([
            'ada_antrian'       => true,
            'nomor_antrian'     => $antrian->nomor_antrian,
            'poli'              => $antrian->poli,
            'status'            => $antrian->status,
            'sedang_dipanggil'  => $sedangDipanggilModel ? $sedangDipanggilModel->nomor_antrian : null,
            'estimasi_menit'    => $estimasiMenit,
        ]);
    }

    /**
     * Estimasi waktu tunggu = jumlah pasien yang masih di depan (poli sama,
     * status belum selesai, nomor urut lebih kecil) dikali estimasi waktu
     * per pasien.
     */
    private function hitungEstimasi(Antrian $antrian, string $hariIni): int
    {
        $urutanSaya = $this->ambilUrutan($antrian->nomor_antrian);

        $jumlahDiDepan = Antrian::where('poli', $antrian->poli)
            ->where('tanggal_antrian', $hariIni)
            ->where('status', '!=', 'selesai')
            ->where('id', '<', $antrian->id)
            ->count();

        return $jumlahDiDepan * self::MENIT_PER_PASIEN;
    }

    private function ambilUrutan(string $nomorAntrian): int
    {
        $parts = explode('-', $nomorAntrian);
        return (int) end($parts);
    }
}