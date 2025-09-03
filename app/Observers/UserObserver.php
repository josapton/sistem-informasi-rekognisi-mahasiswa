<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->role === 'Mahasiswa') {
            $user->mahasiswa()->create([
                // Provide default or passed-in data
                'cpl' => 'CPL01', // You'll need to get this data from the request
                'sks' => '0',
            ]);
        } elseif ($user->role === 'Kaprodi') {
            $user->kaprodi()->create([
                'program_studi' => 'Teknik Informatika',
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
