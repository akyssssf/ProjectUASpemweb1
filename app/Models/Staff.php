<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $table = 'staffs';

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', // Kita tambahkan ini agar Laravel mengizinkan pengisian field role
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];
}