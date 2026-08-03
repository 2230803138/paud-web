<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToCabang;

class Guru extends Model
{
    use HasFactory, BelongsToCabang;

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'jenis_kelamin',
        'jabatan',
        'no_hp',
        'alamat',
        'cabang_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function absensi()
{
    return $this->hasMany(AbsensiGuru::class);
}
}
