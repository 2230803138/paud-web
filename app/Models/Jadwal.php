<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToCabang;

class Jadwal extends Model
{
    use HasFactory, BelongsToCabang;

    protected $fillable = [
        'kelas',
        'kegiatan',
        'tanggal',
        'jam',
        'keterangan',
        'cabang_id',
    ];
}