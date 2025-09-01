<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    protected $primaryKey = 'username'; // Set the primary key
    public $incrementing = false; // The primary key is not an integer
    protected $keyType = 'string'; // The primary key is a string

    protected $fillable = [
        'username', 'nama', 'cpl', 'sks',
    ];

    /**
     * Get the user that owns the student profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
