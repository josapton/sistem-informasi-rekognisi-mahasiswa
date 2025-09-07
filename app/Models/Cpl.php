<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cpl extends Model
{
    use HasFactory;
    /** 1. Tentukan PK Anda (asumsi: 'kode_cpl') */
    protected $primaryKey = 'kode_cpl';

    /** 2. PK ini BUKAN auto-incrementing */
    public $incrementing = false;

    /** 3. Tipe PK ini adalah string */
    protected $keyType = 'string';
    protected $fillable = ['kode_cpl', 'deskripsi'];
    /**
     * Relasi many-to-many ke model Mahasiswa.
     * CPL dimiliki oleh banyak Mahasiswa.
     */
    public function mahasiswas(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'cpl_mahasiswa', 'kode_cpl', 'username');
    }
}
