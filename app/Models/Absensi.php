<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToCabang;

class Absensi extends Model
{
    use HasFactory, BelongsToCabang;

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'status',
        'cabang_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}