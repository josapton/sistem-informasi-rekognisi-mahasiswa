<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kegiatan extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'nama_kegiatan',
        'tipe_konversi',
        'bobot',
    ];

    /**
     * Relasi one-to-one ke DeskripsiKegiatan.
     * Satu Kegiatan HANYA PUNYA SATU DeskripsiKegiatan.
     */
    public function deskripsiKegiatan()
    {
        // Asumsi Model DeskripsiKegiatan ada dan punya foreign key 'kegiatan_id'
        return $this->hasOne(DeskripsiKegiatan::class);
    }
    public function mahasiswas(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'kegiatan_mahasiswa', 'kegiatan_id', 'username')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
