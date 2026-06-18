<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'pasien_id', 'jenis_pendaftaran', 'klinik', 'poli', 'dokter', 'tanggal', 'keluhan', 'status'
    ];
}