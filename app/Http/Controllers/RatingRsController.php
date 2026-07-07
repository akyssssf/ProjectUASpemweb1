<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use Illuminate\Http\Request;

class RatingRsController extends Controller
{
    public function index(Request $request)
    {
        $kliniks = Klinik::with([
                'polis' => function ($q) {
                    $q->withCount(['ratingSurveis as surveis_count'])
                        ->withAvg(['ratingSurveis as surveis_avg_rating'], 'rating');
                },
                'ratingSurveis' => function ($q) {
                    $q->with('poli')->whereNotNull('komentar')->latest()->limit(5);
                },
            ])
            ->withCount(['ratingSurveis as surveis_count'])
            ->withAvg(['ratingSurveis as surveis_avg_rating'], 'rating')
            ->get();

        if ($request->filled('poli')) {
            $kliniks = $kliniks->filter(function ($klinik) use ($request) {
                return $klinik->polis->contains(function ($poli) use ($request) {
                    return stripos($poli->nama, $request->poli) !== false;
                });
            })->values();
        }

        $kliniks = $kliniks->sortByDesc(function ($k) {
            return $k->surveis_avg_rating ?? -1;
        })->values();

        $semuaPoli = $kliniks->flatMap(function ($k) {
            return $k->polis->pluck('nama');
        })->unique()->sort()->values();

        // Siapkan data JSON di controller, bukan di Blade
        $klinikJson = $kliniks->map(function ($k) {
            $polis = $k->polis->map(function ($p) {
                return [
                    'id'     => $p->id,
                    'nama'   => $p->nama,
                    'rating' => $p->surveis_avg_rating ? round($p->surveis_avg_rating, 1) : null,
                    'count'  => $p->surveis_count,
                ];
            })->sortByDesc('rating')->values();

            $ulasan = $k->ratingSurveis->filter(function ($s) {
                return $s->komentar !== null;
            })->sortByDesc('created_at')->take(5)->map(function ($s) {
                return [
                    'rating'   => $s->rating,
                    'komentar' => $s->komentar,
                    'poli'     => $s->poli ? $s->poli->nama : null,
                    'tipe'     => $s->tipe,
                ];
            })->values();

            return [
                'id'            => $k->id,
                'nama'          => $k->nama,
                'rating'        => $k->surveis_avg_rating ? round($k->surveis_avg_rating, 1) : null,
                'count'         => $k->surveis_count,
                'polis'         => $polis,
                'ulasanTerbaru' => $ulasan,
            ];
        })->values();

        return view('rating.index', compact('kliniks', 'semuaPoli', 'klinikJson'));
    }

    public function show($id)
    {
        $klinik = Klinik::with(['polis' => function ($q) {
                $q->withCount(['ratingSurveis as surveis_count'])
                    ->withAvg(['ratingSurveis as surveis_avg_rating'], 'rating');
            }])
            ->withCount(['ratingSurveis as surveis_count'])
            ->withAvg(['ratingSurveis as surveis_avg_rating'], 'rating')
            ->findOrFail($id);

        $ulasanTerbaru = $klinik->ratingSurveis()
            ->with('poli')
            ->whereNotNull('komentar')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();

        return view('rating.show', compact('klinik', 'ulasanTerbaru'));
    }
}
