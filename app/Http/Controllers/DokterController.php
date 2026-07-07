<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    /**
     * Menampilkan daftar antrean yang statusnya 'dipanggil' 
     * DAN khusus untuk dokter yang sedang login.
     */
    public function index()
    {
        // Ambil nama dokter dari akun staf yang sedang login
        $staff = Auth::guard('staff')->user();
        $namaDokterLogin = $staff->name;
        $hariIni = now()->format('Y-m-d');

        $profilDokter = Dokter::with('poli.klinik')
            ->where('nama', $namaDokterLogin)
            ->first();

        $baseQuery = Antrian::with('pendaftaran.pasien')
            ->where('tanggal_antrian', $hariIni)
            ->whereHas('pendaftaran', function($query) use ($namaDokterLogin) {
                $query->where('dokter', $namaDokterLogin);
            });

        $antrianDipanggil = (clone $baseQuery)
            ->where('status', 'dipanggil')
            ->orderBy('id')
            ->get();

        $antrianMenunggu = (clone $baseQuery)
            ->where('status', 'menunggu')
            ->orderBy('id')
            ->limit(5)
            ->get();

        $ringkasan = [
            'dipanggil' => $antrianDipanggil->count(),
            'menunggu' => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'selesai' => (clone $baseQuery)->where('status', 'selesai')->count(),
            'total_hari_ini' => (clone $baseQuery)->count(),
        ];

        return view('petugas.dashboard-dokter', compact(
            'staff',
            'profilDokter',
            'antrianDipanggil',
            'antrianMenunggu',
            'ringkasan'
        ));
    }

    /**
     * Menampilkan form rekam medis, dengan validasi kepemilikan antrean.
     */
    public function create($antrian_id)
    {
        $namaDokterLogin = Auth::guard('staff')->user()->name;

        // KUNCI: 404 akan muncul jika:
        // 1. Antrean tidak ditemukan
        // 2. Status bukan 'dipanggil'
        // 3. Antrean bukan milik dokter ini
        $antrian = Antrian::with('pendaftaran.pasien')
            ->where('id', $antrian_id)
            ->where('status', 'dipanggil')
            ->whereHas('pendaftaran', function($query) use ($namaDokterLogin) {
                $query->where('dokter', $namaDokterLogin);
            })
            ->firstOrFail();

        return view('petugas.rekam-medis-create', [
            'antrian' => $antrian,
            'pasien'  => $antrian->pendaftaran->pasien
        ]);
    }

    /**
     * Menyimpan data dan otomatis menyelesaikan antrean.
     */
    public function store(Request $request)
    {
        $request->validate([
            'antrian_id' => 'required|exists:antrians,id',
            'subjective' => 'required|string',
            'objective'  => 'required|string',
            'assessment' => 'required|string',
            'plan'       => 'required|string',
        ]);

        $staff = Auth::guard('staff')->user();

        DB::transaction(function () use ($request, $staff) {
            $antrian = Antrian::with('pendaftaran')
                ->where('id', $request->antrian_id)
                ->where('status', 'dipanggil')
                ->whereHas('pendaftaran', function($query) use ($staff) {
                    $query->where('dokter', $staff->name);
                })
                ->lockForUpdate()
                ->firstOrFail();

            MedicalRecord::create([
                'pasien_id'  => $antrian->pendaftaran->pasien_id,
                'staff_id'   => $staff->id,
                'subjective' => $request->subjective,
                'objective'  => $request->objective,
                'assessment' => $request->assessment,
                'plan'       => $request->plan,
            ]);

            $antrian->update(['status' => 'selesai']);
            $antrian->pendaftaran?->update(['status' => 'selesai']);
        });

        return redirect()->route('dokter.dashboard')->with('success', 'Rekam medis tersimpan & antrean selesai!');
    }
}
