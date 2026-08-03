<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('siswa_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('bulan');

            $table->integer('tahun');

            $table->integer('nominal');

            $table->date('tanggal_bayar')->nullable();

            $table->enum('status',[
                'Lunas',
                'Belum Lunas'
            ])->default('Belum Lunas');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};