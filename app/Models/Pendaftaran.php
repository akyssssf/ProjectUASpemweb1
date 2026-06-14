<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    // Ini adalah kunci agar Laravel bisa menyimpan data ke tabel pendaftarans
    protected $fillable = [
        'pasien_id', 'klinik', 'poli', 'dokter', 'tanggal', 'keluhan', 'status'
    ];
}