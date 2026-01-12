<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mikrokredensial extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mikrokredensial',
        'bobot',
        'deskripsi',
    ];
}
