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
            $table->foreignId('mahasiswa_username')->constrained()->cascadeOnDelete();

            $table->foreignId('cpl_ti_kode_cpl')->constrained()->cascadeOnDelete();

            $table->primary(['mahasiswa_username', 'cpl_ti_kode_cpl']);
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
