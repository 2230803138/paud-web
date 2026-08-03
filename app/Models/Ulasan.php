<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToCabang;

class Ulasan extends Model
{
    use HasFactory, BelongsToCabang;

    protected $fillable = [
        'user_id',
        'guru_id',
        'cabang_id',
        'ulasan',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
