<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('cabangs')->insert([
            ['nama_cabang' => 'Ebony Sukabangun', 'alamat' => 'Sukabangun, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony Sako', 'alamat' => 'Sako, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony Bukit Siguntang', 'alamat' => 'Bukit Siguntang, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony Lemabang', 'alamat' => 'Lemabang, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony Talang Jambe', 'alamat' => 'Talang Jambe, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebonyblk_', 'alamat' => 'BLK, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony PTC', 'alamat' => 'PTC, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony km 12', 'alamat' => 'KM 12, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony Kebun Bunga', 'alamat' => 'Kebun Bunga, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony CGC', 'alamat' => 'CGC, Palembang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Ebony Opi Raya', 'alamat' => 'OPI Raya, Palembang', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('cabangs')->whereIn('nama_cabang', [
            'Ebony Sukabangun',
            'Ebony Sako',
            'Ebony Bukit Siguntang',
            'Ebony Lemabang',
            'Ebony Talang Jambe',
            'Ebonyblk_',
            'Ebony PTC',
            'Ebony km 12',
            'Ebony Kebun Bunga',
            'Ebony CGC',
            'Ebony Opi Raya'
        ])->delete();
    }
};
