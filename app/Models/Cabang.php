<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_cabang',
        'alamat',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function gurus()
    {
        return $this->hasMany(Guru::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function absensiGurus()
    {
        return $this->hasMany(AbsensiGuru::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
