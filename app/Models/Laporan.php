<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'tanggal',
        'perkembangan',
        'catatan',
        'kognitif',
        'motorik',
        'bahasa',
        'sosial_emosional',
        'agama_moral',
        'foto'
    ];

    // Relasi ke tabel siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi ke tabel guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}