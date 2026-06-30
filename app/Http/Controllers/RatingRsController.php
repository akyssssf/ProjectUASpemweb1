<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use Illuminate\Http\Request;

class RatingRsController extends Controller
{
    /**
     * Halaman publik: daftar klinik/RS diurutkan dari rating tertinggi.
     * Menggabungkan survei 'umum' (rating keseluruhan RS) dan 'spesifik'
     * (rating per kunjungan) jadi satu rata-rata per klinik, plus rata-rata
     * per poli supaya pengguna bisa lihat poli mana yang paling bagus di
     * RS tersebut.
     */
    public function index(Request $request)
    {
        $kliniks = Klinik::with(['polis' => function ($q) {
                $q->withCount('surveis')
                  ->withAvg('surveis', 'rating');
            }])
            ->withCount('surveis')
            ->withAvg('surveis', 'rating')
            ->get();

        // Filter opsional: hanya tampilkan klinik yang punya poli tertentu
        if ($request->filled('poli')) {
            $kliniks = $kliniks->filter(function ($klinik) use ($request) {
                return $klinik->polis->contains(function ($poli) use ($request) {
                    return stripos($poli->nama, $request->poli) !== false;
                });
            })->values();
        }

        // Urutkan dari rating tertinggi (yang belum ada survei taruh di bawah)
        $kliniks = $kliniks->sortByDesc(function ($klinik) {
            return $klinik->surveis_avg_rating ?? -1;
        })->values();

        // Daftar nama poli unik, untuk dropdown filter di view
        $semuaPoli = $kliniks->flatMap(fn ($k) => $k->polis->pluck('nama'))
            ->unique()
            ->sort()
            ->values();

        return view('rating.index', compact('kliniks', 'semuaPoli'));
    }

    /**
     * Detail satu klinik/RS: rata-rata rating, breakdown per poli, dan
     * daftar komentar terbaru (dari kedua jenis survei).
     */
    public function show($id)
    {
        $klinik = Klinik::with(['polis' => function ($q) {
                $q->withCount('surveis')->withAvg('surveis', 'rating');
            }])
            ->withCount('surveis')
            ->withAvg('surveis', 'rating')
            ->findOrFail($id);

        $ulasanTerbaru = $klinik->surveis()
            ->with('poli')
            ->whereNotNull('komentar')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();

        return view('rating.show', compact('klinik', 'ulasanTerbaru'));
    }
}
