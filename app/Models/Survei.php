<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    protected $fillable = [
        'user_id', 'rating', 'komentar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}