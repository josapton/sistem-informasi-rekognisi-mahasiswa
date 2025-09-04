<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cpl extends Model
{
    use HasFactory;

    protected $guarded = ['kode_cpl']; // Atau sesuaikan dengan field Anda

    /**
     * Relasi many-to-many ke model Mahasiswa.
     * CPL dimiliki oleh banyak Mahasiswa.
     */
    public function mahasiswas(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'cpl_mahasiswa');
    }
}
