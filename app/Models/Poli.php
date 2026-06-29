<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = ['klinik_id', 'nama'];

    public function klinik()
    {
        return $this->belongsTo(Klinik::class);
    }

    public function dokters()
    {
        return $this->hasMany(Dokter::class);
    }
}