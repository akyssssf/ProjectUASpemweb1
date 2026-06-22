<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [
        'pendaftaran_id', 'nomor_antrian', 'poli', 'tanggal_antrian', 'status',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    /**
     * Buat antrian baru otomatis berdasarkan poli, nomor reset tiap hari.
     * Dipanggil setelah Pendaftaran::create() berhasil.
     */
    public static function buatUntuk(Pendaftaran $pendaftaran): self
    {
        $hariIni = now()->format('Y-m-d');
        $poli = $pendaftaran->poli;

        // Kode poli = huruf pertama, kapital (sama seperti logic lama: U, G, A, dst)
        $kodePoli = strtoupper(substr($poli, 0, 1));

        // Cari nomor terakhir untuk poli ini, di tanggal ini
        $terakhir = self::where('poli', $poli)
            ->where('tanggal_antrian', $hariIni)
            ->orderByDesc('id')
            ->first();

        $urutanBaru = 1;
        if ($terakhir) {
            $parts = explode('-', $terakhir->nomor_antrian);
            $urutanBaru = (int) end($parts) + 1;
        }

        return self::create([
            'pendaftaran_id'  => $pendaftaran->id,
            'nomor_antrian'   => $kodePoli . '-' . $urutanBaru,
            'poli'            => $poli,
            'tanggal_antrian' => $hariIni,
            'status'          => 'menunggu',
        ]);
    }
}