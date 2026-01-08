<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'diselesaikan' to enum values for existing column
        // Use raw statement because altering ENUM requires full definition
        DB::statement("ALTER TABLE `kegiatan_mahasiswa` MODIFY COLUMN `status` ENUM('menunggu','diterima','ditolak','diselesaikan') NOT NULL DEFAULT 'menunggu'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to previous enum without 'diselesaikan'
        DB::statement("ALTER TABLE `kegiatan_mahasiswa` MODIFY COLUMN `status` ENUM('menunggu','diterima','ditolak') NOT NULL DEFAULT 'menunggu'");
    }
};
