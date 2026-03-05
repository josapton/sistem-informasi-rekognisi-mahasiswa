<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class deskripsiKegiatan extends Model
{
    use HasFactory;

    // Pastikan nama tabel benar (jika tidak 'deskripsi_kegiatans')
    // protected $table = 'deskripsi_kegiatan'; 

    /**
     * Kolom yang boleh diisi secara massal.
     * Kita juga perlu 'kegiatan_id' agar relasi bekerja, 
     * tapi Eloquent akan mengisinya otomatis saat kita gunakan method relasi.
     */
    protected $fillable = [
        'penempatan',
        'kriteria',
        'deskripsi',
        'cpl',
        'kegiatan_id', // Opsional, tapi bagus untuk kejelasan
    ];

    /**
     * Relasi kebalikannya: Deskripsi ini MILIK satu Kegiatan.
     */
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
