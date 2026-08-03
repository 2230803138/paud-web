<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToCabang;

class Pendaftaran extends Model
{
    use HasFactory, BelongsToCabang;

    protected $fillable = [
        'nama_anak',
        'jenis_kelamin',
        'nama_ortu',
        'alamat',
        'no_hp',
        'tgl_lahir',
        'kelas',
        'status',
        'cabang_id',
    ];
}