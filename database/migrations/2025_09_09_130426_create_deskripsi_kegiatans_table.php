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
        Schema::create('deskripsi_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatans')
                  ->onDelete('cascade');
            $table->string('penempatan', 1000);
            $table->string('kriteria', 1000);
            $table->string('deskripsi', 1000);
            $table->string('cpl', 1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deskripsi_kegiatans');
    }
};
