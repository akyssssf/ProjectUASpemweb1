<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Klinik;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        $hariIni = now()->format('Y-m-d');

        $klinikDipilih = $request->query('klinik');
        $poliDipilih   = $request->query('poli');

        $queryAktif = Antrian::with('pendaftaran.pasien')
            ->where('tanggal_antrian', $hariIni)
            ->where('status', '!=', 'selesai');

        $queryRiwayat = Antrian::with('pendaftaran.pasien')
            ->where('tanggal_antrian', $hariIni)
            ->where('status', 'selesai');

        if ($klinikDipilih) {
            $queryAktif->where('klinik', $klinikDipilih);
            $queryRiwayat->where('klinik', $klinikDipilih);
        }

        if ($poliDipilih) {
            $queryAktif->where('poli', $poliDipilih);
            $queryRiwayat->where('poli', $poliDipilih);
        }

        $antrianAktif   = $queryAktif->orderBy('id', 'asc')->get();
        $riwayatSelesai = $queryRiwayat->orderByDesc('updated_at')->get();

        // Nomor yang harus dipanggil berikutnya (buat testing)
        // Prioritas: kalau ada yang statusnya "dipanggil" (sedang dipanggil), tampilkan itu.
        // Kalau tidak ada, ambil yang paling awal berstatus "menunggu".
        $antrianBerikutnya = $antrianAktif->firstWhere('status', 'dipanggil')
            ?? $antrianAktif->firstWhere('status', 'menunggu');

        // Ringkasan semua antrian aktif hari ini, dikelompokkan per klinik+poli
        // (hanya ditampilkan kalau petugas belum memilih filter klinik tertentu)
        $ringkasanAktif = collect();

        if (!$klinikDipilih) {
            $semuaAktifHariIni = Antrian::with('pendaftaran.pasien')
                ->where('tanggal_antrian', $hariIni)
                ->where('status', '!=', 'selesai')
                ->orderBy('id', 'asc')
                ->get();

            $ringkasanAktif = $semuaAktifHariIni
                ->groupBy(fn($row) => $row->klinik . '|' . $row->poli)
                ->map(function ($group) {
                    $berikutnya = $group->firstWhere('status', 'dipanggil')
                        ?? $group->firstWhere('status', 'menunggu');

                    return [
                        'klinik'          => $group->first()->klinik,
                        'poli'            => $group->first()->poli,
                        'jumlah'          => $group->count(),
                        'nomor_dipanggil' => $berikutnya->nomor_antrian ?? '-',
                        'status'          => $berikutnya->status ?? 'menunggu',
                    ];
                })
                ->values();
        }

        // Data klinik + poli untuk dropdown filter (dari tabel referensi asli)
        $kliniks = Klinik::with('polis')->get();

        return view('petugas.monitoring', compact(
            'antrianAktif',
            'riwayatSelesai',
            'kliniks',
            'klinikDipilih',
            'poliDipilih',
            'antrianBerikutnya',
            'ringkasanAktif'
        ));
    }

    public function panggil($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->update(['status' => 'dipanggil']);

        return back();
    }

    public function selesai($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->update(['status' => 'selesai']);

        return back();
    }
}