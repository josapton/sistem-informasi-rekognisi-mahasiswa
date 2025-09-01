<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'username' => 'admin',
            'email' => 'admin@test.com',
            'role' => 'Admin',
            'password' => Hash::make('admin0123'),
        ])->each(function ($user) {
            if ($user->role === 'Admin') {
            Admin::create([
                'username' => $user->username,
                'nama' => 'Admin ',
            ]);
        }
        });
        User::create([
            'username' => 'kaprodi',
            'email' => 'kaprodi@test.com',
            'role' => 'Kaprodi',
            'password' => Hash::make('kaprodi0123'),
        ])->each(function ($user) {
            if ($user->role === 'Kaprodi') {
            Kaprodi::create([
                'username' => $user->username,
                'nama' => 'Kaprodi',
                'program_studi' => 'Teknik Informatika',
            ]);
        }
        });
        User::create([
            'username' => 'mahasiswa',
            'email' => 'mahasiswa@test.com',
            'role' => 'Mahasiswa',
            'password' => Hash::make('mahasiswa0123'),
        ])->each(function ($user) {
            if ($user->role === 'Mahasiswa') {
            Mahasiswa::create([
                'username' => $user->username,
                'nama' => 'Mahasiswa',
                'cpl' => 'CPL01',
                'sks' => 20,
            ]);
        }
        });
    }
}
