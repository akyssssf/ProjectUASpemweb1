<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pasien extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'no_hp', 'alamat'
    ];

    protected $hidden = [
        'password'
    ];
}