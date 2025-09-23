<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konversi2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'total_sks',
        'status',
        'catatan_kaprodi',
    ];

    // Relasi ke detail item
    public function details()
    {
        return $this->hasMany(Konversi2Detail::class);
    }

    // Relasi ke user (mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'username');
    }
}
