<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pasien extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'no_hp', 
        'alamat', 
        'nik',
    ];

    public function medicalRecords()
{
    return $this->hasMany(MedicalRecord::class, 'pasien_id');
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
}