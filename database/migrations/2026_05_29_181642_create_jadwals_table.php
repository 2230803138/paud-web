<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('jadwals', function (Blueprint $table) {
        $table->id();
        $table->string('kegiatan');
        $table->date('tanggal');
        $table->time('jam');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}
};
