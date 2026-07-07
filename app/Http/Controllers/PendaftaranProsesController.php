<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Antrian;
use App\Models\Klinik;
use App\Services\TelegramService; // 1. Tambahkan ini
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PendaftaranProsesController extends Controller
{
    public function simpanUmum(Request $request)
    {
        $request->validate([
            'klinik'  => 'required|string',
            'poli'    => 'required|string',
            'dokter'  => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'keluhan' => 'nullable|string',
        ]);

        $pasien = Auth::guard('pasien')->user();
        $this->validasiPilihanLayanan($request->klinik, $request->poli, $request->dokter);

        [$pendaftaran, $antrian] = DB::transaction(function () use ($request, $pasien) {
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

            return [$pendaftaran, Antrian::buatUntuk($pendaftaran)];
        });

        // 2. Kirim Notifikasi Telegram
        $pesan = "<b>🏥 Pendaftaran Baru</b>\n\n" .
                 "👤 Pasien: " . $pasien->name . "\n" .
                 "🏥 Klinik: " . $request->klinik . "\n" .
                 "🩺 Poli: " . $request->poli . "\n" .
                 "🔢 No Antrian: " . $antrian->nomor_antrian . "\n" .
                 "📅 Tanggal: " . $request->tanggal;

        // TelegramService::kirimPesan($pesan);

        return redirect('/dashboard')->with('success', 'Pendaftaran Berhasil! Nomor antrian Anda: ' . $antrian->nomor_antrian);
    }

    private function validasiPilihanLayanan(string $namaKlinik, string $namaPoli, string $namaDokter): void
    {
        $klinik = Klinik::with('polis.dokters')
            ->where('nama', $namaKlinik)
            ->first();

        $poli = $klinik ? $klinik->polis->firstWhere('nama', $namaPoli) : null;
        $dokter = $poli ? $poli->dokters->firstWhere('nama', $namaDokter) : null;

        if (!$klinik || !$poli || !$dokter) {
            throw ValidationException::withMessages([
                'dokter' => 'Pilihan klinik, poli, dan dokter tidak valid.',
            ]);
        }
    }
}
