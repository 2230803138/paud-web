<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\BelongsToCabang;

class AbsensiGuru extends Model
{
    use HasFactory, BelongsToCabang;

    protected $fillable = [
        'guru_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'keterangan',
        'cabang_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}