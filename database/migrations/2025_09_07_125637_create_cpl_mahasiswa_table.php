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
        Schema::create('cpl_mahasiswa', function (Blueprint $table) {
            $table->string('username');

            $table->foreign('username')->references('username')->on('mahasiswas')->onDelete('cascade');

            $table->string('kode_cpl');

            $table->foreign('kode_cpl')->references('kode_cpl')->on('cpls')->onDelete('cascade');

            $table->primary(['username', 'kode_cpl']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpl_mahasiswa');
    }
};
