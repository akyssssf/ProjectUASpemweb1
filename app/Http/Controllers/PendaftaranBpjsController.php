<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Antrian;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;

class PendaftaranBpjsController extends Controller
{
    public function simpan(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'no_bpjs'       => 'required|string|max:13',
            'faskes_asal'   => 'required|string',
            'klinik'        => 'required|string',
            'poli'          => 'required|string',
            'dokter'        => 'required|string',
            'jenis_rujukan' => 'required|string',
            'tanggal'       => 'required|date',
            'keluhan'       => 'nullable|string',
        ]);

        $pasien = Auth::guard('pasien')->user();

        // 2. Simpan ke database
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

        // 3. Generate nomor antrian otomatis berdasarkan poli (reset tiap hari)
        $antrian = Antrian::buatUntuk($pendaftaran);

        // 4. Kirim Notifikasi Telegram
        $pesan = "<b>🏥 Pendaftaran BPJS Baru</b>\n\n" .
                 "👤 Pasien: " . $pasien->nama . "\n" .
                 "🪪 No BPJS: " . $request->no_bpjs . "\n" .
                 "🏥 Klinik: " . $request->klinik . "\n" .
                 "🩺 Poli: " . $request->poli . "\n" .
                 "🔢 No Antrian: " . $antrian->nomor_antrian . "\n" .
                 "📅 Tanggal: " . $request->tanggal;

        TelegramService::kirimPesan($pesan);

        // 5. Redirect ke dashboard dengan pesan sukses
        return redirect('/dashboard')->with('success', 'Pendaftaran BPJS berhasil diajukan! Nomor antrian Anda: ' . $antrian->nomor_antrian);
    }
}