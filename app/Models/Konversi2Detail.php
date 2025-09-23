<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konversi2Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'konversi2_id',
        'nama_item',
        'jenis',
        'sks',
    ];

    // Relasi ke pengajuan konversi utama
    public function konversi()
    {
        return $this->belongsTo(Konversi2::class);
    }
}
