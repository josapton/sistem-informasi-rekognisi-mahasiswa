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
        Schema::create('konversi2_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konversi2_id')->constrained('konversi2s')->onDelete('cascade');
            $table->string('nama_item');
            $table->enum('jenis', ['matakuliah', 'mikrokredensial']);
            $table->float('sks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konversi2_details');
    }
};
