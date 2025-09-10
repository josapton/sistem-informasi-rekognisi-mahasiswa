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
        Schema::create('kegiatan_mahasiswa', function (Blueprint $table) {
            $table->string('username');
            $table->foreign('username')->references('username')->on('mahasiswas')->onDelete('cascade');
            $table->foreignId('kegiatan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])
                  ->default('menunggu');
            $table->primary(['username', 'kegiatan_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_mahasiswa');
    }
};
