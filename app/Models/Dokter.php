<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = ['poli_id', 'nama'];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}