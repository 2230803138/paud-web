<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

        protected $fillable = [
            'name',
            'email',
            'no_hp',
            'password',
            'role',
            'cabang_id',
        ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ==========================
    // RELASI
    // ==========================
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }
    // ==========================
    // CEK ROLE
    // ==========================
            public function isAdmin()
        {
            return $this->role === 'admin';
        }

        public function isOrangTua()
        {
            return $this->role === 'orangtua';
        }

        public function isGuru()
        {
            return $this->role === 'guru';
        }

        public function isYayasan()
        {
            return $this->role === 'yayasan';
        }
}