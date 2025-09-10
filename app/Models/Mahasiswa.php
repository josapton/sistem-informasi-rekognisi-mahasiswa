<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    use HasFactory;
    /**
     * Relasi many-to-many ke model Cpl.
     * Mahasiswa memiliki banyak CPL.
     */
    public function cpls(): BelongsToMany
    {
        return $this->belongsToMany(Cpl::class, 'cpl_mahasiswa', 'username', 'kode_cpl');
    }
    public function kegiatans(): BelongsToMany
    {
        return $this->belongsToMany(Kegiatan::class, 'kegiatan_mahasiswa', 'username', 'kegiatan_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
