<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToCabang;

class Pembayaran extends Model
{
    use HasFactory, BelongsToCabang;

    protected $fillable = [
        'siswa_id',
        'bulan',
        'tahun',
        'nominal',
        'status',
        'tanggal_bayar',
        'cabang_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}