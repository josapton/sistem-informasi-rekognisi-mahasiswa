<?php

namespace Database\Seeders;

use App\Models\Cpl;
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

        Cpl::create([
            'kode_cpl' => 'CPL01',
            'deskripsi' => 'Bertakwa kepada Tuhan Yang Maha Esa, taat hukum, dan disiplin dalam kehidupan bermasyarakat dan bernegara. (S)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL02',
            'deskripsi' => 'Menunjukkan sikap profesional dalam bentuk kepatuhan pada etika profesi, kemampuan bekerjasama dalam tim multidisiplin, pemahaman tentang pembelajaran sepanjang hayat, Menginternalisasi semangat kewirausahaan, dan respon terhadap isu sosial dan perkembangan teknologi. (S)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL03',
            'deskripsi' => 'Memiliki pengetahuan yang memadai terkait cara kerja sistem komputer dan mampu menerapkan/menggunakan berbagai algoritma/metode untuk memecahkan masalah pada suatu organisasi. (P)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL04',
            'deskripsi' => 'Menguasai konsep teoritis bidang pengetahuan Ilmu Komputer/Informatika dalam mendesain dan mensimulasikan aplikasi teknologi multi-platform yang relevan dengan kebutuhan industri dan masyarakat. (P)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL05',
            'deskripsi' => 'Memiliki kemampuan (pengelolaan) manajerial tim dan kerja sama (team work), manajemen diri, mampu berkomunikasi baik lisan maupun tertulis dengan baik dan mampu melakukan presentasi. (KU)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL06',
            'deskripsi' => 'Menyusun deskripsi saintifik hasil kajian implikasi pengembangan atau implementasi ilmu pengetahuan teknologi dalam bentuk skripsi atau laporan tugas akhir atau artikel ilmiah. (KU)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL07',
            'deskripsi' => 'Kemampuan mengimplementasi kebutuhan computing dengan mempertimbangkan berbagai metode/algoritma yang sesuai. (KK)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL08',
            'deskripsi' => 'Memiliki kompetensi untuk menganalisis persoalan computing yang kompleks untuk mengidentifikasi solusi pengelolaan proyek teknologi bidang informatika/ilmu komputer dengan mempertimbangkan wawasan perkembangan ilmu transdisiplin (KK)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL09',
            'deskripsi' => 'Kemampuan menganalisis, merancang, membuat dan mengevaluasi user interface dan aplikasi interaktif dengan mempertimbangkan kebutuhan pengguna dan perkembangan ilmu transdisiplin. (KK)',
        ]);

        Cpl::create([
            'kode_cpl' => 'CPL10',
            'deskripsi' => 'Memiliki keahlian dibidang pengembangan perangkat lunak, sekaligus mampu menganalisa cara kerja dan sistem keamanan dari perangkat lunak tersebut. (KK)',
        ]);

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
