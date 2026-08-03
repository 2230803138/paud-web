<?php

namespace App\Traits;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToCabang
{
    public static function bootBelongsToCabang()
    {
        // Otomatis isi cabang_id saat menyimpan record baru jika admin/guru sedang login
        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->cabang_id && !$model->cabang_id) {
                $model->cabang_id = auth()->user()->cabang_id;
            }
        });

        // Batasi query agar hanya mengambil data cabang yang sama dengan user yang login
        static::addGlobalScope('cabang', function (Builder $builder) {
            if (auth()->check() && auth()->user()->role !== 'yayasan') {
                if (auth()->user()->cabang_id) {
                    $builder->where(function ($query) {
                        $query->where('cabang_id', auth()->user()->cabang_id)
                              ->orWhereNull('cabang_id');
                    });
                }
            }
        });
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
