<?php

namespace Database\Seeders;

use App\Models\User;
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
            'nama' => 'Admin Rekognisi',
            'email' => 'admin@test.com',
            'role' => 'Admin',
            'password' => Hash::make('admin0123'),
        ]);
        User::create([
            'username' => 'dosen',
            'nama' => 'Dosen Rekognisi',
            'email' => 'dosen@test.com',
            'role' => 'Dosen',
            'password' => Hash::make('dosen0123'),
        ]);
        User::create([
            'username' => 'mahasiswa',
            'nama' => 'Mahasiswa Rekognisi',
            'email' => 'mahasiswa@test.com',
            'role' => 'Mahasiswa',
            'password' => Hash::make('mahasiswa0123'),
        ]);
    }
}
