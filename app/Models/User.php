<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Get the student profile associated with the user.
     */
    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'username', 'username');
    }

    /**
     * Get the lecturer profile associated with the user.
     */
    public function kaprodi(): HasOne
    {
        return $this->hasOne(Kaprodi::class, 'username', 'username');
    }

    /**
     * Get the admin profile associated with the user.
     */
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'username', 'username');
    }
}
