<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    // Tambahkan baris ini agar Laravel tahu tabel yang dipakai adalah 'surveys'
    protected $table = 'surveys'; 

    protected $fillable = [
        'user_id', 'rating', 'komentar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}