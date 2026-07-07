<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    protected $table = 'surveys';

    protected $fillable = [
        'pasien_id', 'klinik_id', 'poli_id', 'pendaftaran_id', 'tipe', 'rating', 'komentar',
    ];

    public function scopeVerifiedVisit($query)
    {
        return $query
            ->where('tipe', 'spesifik')
            ->whereNotNull('pendaftaran_id')
            ->whereHas('pendaftaran.antrian', function ($q) {
                $q->where('status', 'selesai');
            });
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function klinik()
    {
        return $this->belongsTo(Klinik::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
