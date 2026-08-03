<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
   $table->id();
$table->string('nama_anak');
$table->string('jenis_kelamin');
$table->string('nama_ortu');
$table->text('alamat');
$table->string('no_hp');
$table->date('tgl_lahir');
$table->string('status')->default('menunggu');
$table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
