<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id', 'poli', 'dokter', 'tanggal', 'keluhan', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function antrian()
    {
        return $this->hasOne(Antrian::class);
    }
}