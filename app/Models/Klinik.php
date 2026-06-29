<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klinik extends Model
{
    protected $fillable = ['nama'];

    public function polis()
    {
        return $this->hasMany(Poli::class);
    }
}