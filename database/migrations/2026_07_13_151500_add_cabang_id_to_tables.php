<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan kolom cabang_id ke seluruh tabel utama
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });
        Schema::table('gurus', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });
        Schema::table('absensis', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });
        Schema::table('absensi_gurus', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('set null');
        });

        // 2. Seeding awal cabang default (Cabang Pusat & Cabang Pakjo)
        DB::table('cabangs')->insert([
            [
                'id' => 1,
                'nama_cabang' => 'Ebony Pusat',
                'alamat' => 'Jl. Jenderal Sudirman No. 12, Palembang',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nama_cabang' => 'Ebony Pakjo',
                'alamat' => 'Jl. Inspektur Marzuki No. 45, Palembang',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // 3. Hubungkan seluruh data existing ke Ebony Pusat (ID: 1)
        // Kecuali user dengan role yayasan (cabang_id tetap NULL)
        DB::table('users')->where('role', '!=', 'yayasan')->update(['cabang_id' => 1]);
        DB::table('siswas')->update(['cabang_id' => 1]);
        DB::table('gurus')->update(['cabang_id' => 1]);
        DB::table('pendaftarans')->update(['cabang_id' => 1]);
        DB::table('pembayarans')->update(['cabang_id' => 1]);
        DB::table('absensis')->update(['cabang_id' => 1]);
        DB::table('absensi_gurus')->update(['cabang_id' => 1]);
        DB::table('jadwals')->update(['cabang_id' => 1]);
        DB::table('kelas')->update(['cabang_id' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
        Schema::table('jadwals', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
        Schema::table('absensi_gurus', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
        Schema::table('absensis', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
        Schema::table('pembayarans', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
        Schema::table('pendaftarans', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
        Schema::table('gurus', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
        Schema::table('siswas', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
        Schema::table('users', function (Blueprint $table) { $table->dropForeign(['cabang_id']); $table->dropColumn('cabang_id'); });
    }
};
