<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Survei;
use App\Models\Klinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveiPasienController extends Controller
{
    /**
     * Simpan survei SPESIFIK: terikat ke satu kunjungan (pendaftaran) yang
     * statusnya sudah 'selesai'. Hanya pasien pemilik kunjungan yang boleh
     * mengisi, dan hanya boleh sekali per kunjungan.
     */
    public function simpanSpesifik(Request $request)
    {
        $pasien = Auth::guard('pasien')->user();

        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'rating'         => 'required|integer|min:1|max:5',
            'komentar'       => 'nullable|string|max:1000',
        ]);

        $pendaftaran = Pendaftaran::with('antrian')
            ->where('id', $request->pendaftaran_id)
            ->where('pasien_id', $pasien->id)
            ->firstOrFail();

        // Hanya kunjungan yang sudah selesai yang boleh disurvei
        if (!$pendaftaran->antrian || $pendaftaran->antrian->status !== 'selesai') {
            return back()->with('error', 'Survei hanya bisa diisi setelah kunjungan selesai.');
        }

        // Satu kunjungan hanya boleh disurvei sekali
        if ($pendaftaran->survei) {
            return back()->with('error', 'Kunjungan ini sudah pernah Anda beri penilaian.');
        }

        // Cari klinik_id & poli_id dari nama string yang tersimpan di pendaftaran
        $klinik = Klinik::where('nama', $pendaftaran->klinik)->first();
        $poli = $klinik?->polis()->where('nama', $pendaftaran->poli)->first();

        if (!$klinik) {
            return back()->with('error', 'Data klinik untuk kunjungan ini tidak ditemukan.');
        }

        Survei::create([
            'pasien_id'      => $pasien->id,
            'klinik_id'      => $klinik->id,
            'poli_id'        => $poli?->id,
            'pendaftaran_id' => $pendaftaran->id,
            'tipe'           => 'spesifik',
            'rating'         => $request->rating,
            'komentar'       => $request->komentar,
        ]);

        return back()->with('success', 'Terima kasih atas penilaian Anda!');
    }

    public function simpanUmum(Request $request)
    {
        return back()->with('error', 'Rating hanya bisa diberikan dari riwayat kunjungan yang sudah selesai.');
    }
}
