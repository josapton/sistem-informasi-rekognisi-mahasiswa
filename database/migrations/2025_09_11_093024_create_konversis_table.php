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
        Schema::create('konversis', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreign('username')->references('username')->on('mahasiswas')->onDelete('cascade');
            $table->foreignId('kegiatan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['diajukan', 'divalidasi', 'ditolak'])->default('diajukan');
            $table->text('catatan_validator')->nullable();
            $table->unique(['username', 'kegiatan_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konversis');
    }
};
