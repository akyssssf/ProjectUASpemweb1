<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    /**
     * Menampilkan daftar antrean yang statusnya 'dipanggil' 
     * DAN khusus untuk dokter yang sedang login.
     */
    public function index()
    {
        // Ambil nama dokter dari akun staf yang sedang login
        $namaDokterLogin = Auth::guard('staff')->user()->name;

        $antrianDipanggil = Antrian::with('pendaftaran.pasien')
            ->where('status', 'dipanggil')
            ->where('tanggal_antrian', now()->format('Y-m-d'))
            // Filter: Hanya tampilkan antrean untuk dokter ini
            ->whereHas('pendaftaran', function($query) use ($namaDokterLogin) {
                $query->where('dokter', $namaDokterLogin);
            })
            ->get();

        return view('petugas.dashboard-dokter', compact('antrianDipanggil'));
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
            'antrian_id' => 'required',
            'pasien_id'  => 'required',
            'subjective' => 'required',
            'objective'  => 'required',
            'assessment' => 'required',
            'plan'       => 'required',
        ]);

        MedicalRecord::create([
            'pasien_id'  => $request->pasien_id,
            'staff_id'   => Auth::guard('staff')->user()->id,
            'subjective' => $request->subjective,
            'objective'  => $request->objective,
            'assessment' => $request->assessment,
            'plan'       => $request->plan,
        ]);

        // Tandai antrean sebagai 'selesai' agar otomatis hilang dari dashboard
        Antrian::find($request->antrian_id)->update(['status' => 'selesai']);

        return redirect()->route('dokter.dashboard')->with('success', 'Rekam medis tersimpan & antrean selesai!');
    }
}