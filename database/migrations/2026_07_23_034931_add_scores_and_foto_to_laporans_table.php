<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('kognitif')->nullable();
            $table->string('motorik')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('sosial_emosional')->nullable();
            $table->string('agama_moral')->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['kognitif', 'motorik', 'bahasa', 'sosial_emosional', 'agama_moral', 'foto']);
        });
    }
};
