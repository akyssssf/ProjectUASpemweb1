<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [
        'pendaftaran_id', 'klinik', 'nomor_antrian', 'poli', 'tanggal_antrian', 'status',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public static function buatUntuk(Pendaftaran $pendaftaran): self
    {
        $hariIni = now()->format('Y-m-d');
        $klinik  = $pendaftaran->klinik;
        $poli    = $pendaftaran->poli;

        $kodePoli = self::buatKodePoli($poli);

        // Cari nomor terakhir untuk KLINIK + POLI ini, di tanggal ini
        // (klinik ikut jadi filter, supaya poli dengan nama sama di klinik
        // berbeda tidak berbagi urutan nomor yang sama)
        $terakhir = self::where('klinik', $klinik)
            ->where('poli', $poli)
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
            'klinik'          => $klinik,
            'poli'            => $poli,
            'tanggal_antrian' => $hariIni,
            'status'          => 'menunggu',
        ]);
    }

    private static function buatKodePoli(string $poli): string
    {
        $kata = explode(' ', trim($poli));

        if (count($kata) > 1 && strtolower($kata[0]) === 'poli') {
            return strtoupper(substr($kata[1], 0, 1));
        }

        return strtoupper(substr($poli, 0, 1));
    }
}