<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = ['pasien_id', 'staff_id', 'subjective', 'objective', 'assessment', 'plan'];

    public function pasien() {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}