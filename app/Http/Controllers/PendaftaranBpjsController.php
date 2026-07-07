<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Antrian;
use App\Models\Klinik;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PendaftaranBpjsController extends Controller
{
    public function simpan(Request $request)
    {
        try {
            // 1. Validasi input
            $request->validate([
                'no_bpjs'       => 'required|string|max:13',
                'faskes_asal'   => 'required|string',
                'klinik'        => 'required|string',
                'poli'          => 'required|string',
                'dokter'        => 'required|string',
                'jenis_rujukan' => 'required|string',
                'tanggal'       => 'required|date|after_or_equal:today',
                'keluhan'       => 'nullable|string',
            ]);

            $pasien = Auth::guard('pasien')->user();
            $this->validasiPilihanLayanan($request->klinik, $request->poli, $request->dokter);

            [$pendaftaran, $antrian] = DB::transaction(function () use ($request, $pasien) {
                $pendaftaran = Pendaftaran::create([
                    'pasien_id'         => $pasien->id,
                    'no_bpjs'           => $request->no_bpjs,
                    'faskes_asal'       => $request->faskes_asal,
                    'jenis_rujukan'     => $request->jenis_rujukan,
                    'klinik'            => $request->klinik,
                    'poli'              => $request->poli,
                    'dokter'            => $request->dokter,
                    'tanggal'           => $request->tanggal,
                    'keluhan'           => $request->keluhan,
                    'jenis_pendaftaran' => 'BPJS',
                    'status'            => 'menunggu',
                ]);

                return [$pendaftaran, Antrian::buatUntuk($pendaftaran)];
            });

            // 4. Kirim Notifikasi Telegram
            $pesan = "<b>🏥 Pendaftaran BPJS Baru</b>\n\n" .
                     "👤 Pasien: " . $pasien->name . "\n" .
                     "🪪 No BPJS: " . $request->no_bpjs . "\n" .
                     "🏥 Klinik: " . $request->klinik . "\n" .
                     "🩺 Poli: " . $request->poli . "\n" .
                     "🔢 No Antrian: " . $antrian->nomor_antrian . "\n" .
                     "📅 Tanggal: " . $request->tanggal;

            TelegramService::kirimPesan($pesan);

            // 5. Redirect ke dashboard dengan pesan sukses
            return redirect('/dashboard')->with('success', 'Pendaftaran BPJS berhasil diajukan! Nomor antrian Anda: ' . $antrian->nomor_antrian);
        } catch (\Throwable $e) {
            if ($e instanceof \Illuminate\Validation\ValidationException) throw $e;
            return response($e->getMessage() . " | File: " . $e->getFile() . " | Line: " . $e->getLine(), 500);
        }
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
