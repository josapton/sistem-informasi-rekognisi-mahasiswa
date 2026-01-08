<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_matakuliah',
        'bobot',
        'deskripsi',
    ];
}
