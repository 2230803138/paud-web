<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use App\Traits\BelongsToCabang;

class Siswa extends Model
{
    use HasFactory, BelongsToCabang;

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'kelas',
        'alamat',
        'nama_orangtua',
        'no_hp',
        'user_id',
        'cabang_id',
    ];

    // Relasi ke tabel users (orang tua)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    // Relasi ke tabel kelas
    public function kelas()
    {
        return $this->hasOne(Kelas::class);
    }
}