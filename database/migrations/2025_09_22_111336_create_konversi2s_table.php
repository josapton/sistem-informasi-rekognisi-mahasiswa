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
        Schema::create('konversi2s', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreign('username')->references('username')->on('mahasiswas')->onDelete('cascade');
            $table->integer('total_sks');
            $table->enum('status', ['diajukan', 'divalidasi', 'ditolak', 'dikembalikan'])->default('diajukan');
            $table->text('catatan_kaprodi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konversi2s');
    }
};
