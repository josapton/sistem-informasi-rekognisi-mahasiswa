<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Konversi;
use App\Models\Konversi2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'title' => 'Dashboard',
            'menuDashboard' => 'active',
        ];

        // JIKA ROLE ADALAH ADMIN ATAU KAPRODI, TAMPILKAN SEMUA DATA
        if ($user->role === 'Admin' || $user->role === 'Kaprodi') {
            $data += [
                'jumlahUser' => User::count(),
                'jumlahMahasiswa' => User::where('role', 'Mahasiswa')->count(),
                'jumlahKegiatan' => Kegiatan::count(),
                'kegiatanDiajukan' => DB::table('kegiatan_mahasiswa')->where('status', 'menunggu')->count(),
                'konversiKegiatan' => Konversi::where('status', 'diajukan')->count(),
                'konversiSKS' => Konversi2::where('status', 'diajukan')->count(),
            ];
        } 
        // JIKA ROLE ADALAH MAHASISWA, TAMPILKAN DATA PRIBADI
        elseif ($user->role === 'Mahasiswa') {
            $data += [
                // Jumlah total kegiatan yang diikuti (diterima) oleh mahasiswa ini
                'jumlahKegiatan' => Kegiatan::count(),
                
                // Jumlah pendaftaran kegiatan yang statusnya masih 'menunggu'
                'kegiatanDiajukan' => $user->kegiatans()->wherePivot('status', 'menunggu')->count(),

                // Jumlah pengajuan konversi kegiatan (MBKM) yang statusnya 'diajukan'
                'konversiKegiatan' => Konversi::where('username', $user->username)
                                              ->where('status', 'diajukan')
                                              ->count(),
                
                // Jumlah pengajuan konversi SKS (matakuliah/mikro) yang statusnya 'diajukan'
                'konversiSKS' => Konversi2::where('username', $user->username)
                                          ->where('status', 'diajukan')
                                          ->count(),

                'kegiatanDiterima' => $user->kegiatans()->wherePivot('status', 'diterima')->count(),

                'konversiKegiatan1' => Konversi::where('username', $user->username)
                                              ->where('status', 'divalidasi')
                                              ->count(),
                
                'konversiSKS1' => Konversi2::where('username', $user->username)
                                          ->where('status', 'divalidasi')
                                          ->count(),

                'kegiatanDitolak' => $user->kegiatans()->wherePivot('status', 'ditolak')->count(),

                'konversiKegiatan0' => Konversi::where('username', $user->username)
                                              ->where('status', 'ditolak')
                                              ->count(),
                
                'konversiSKS0' => Konversi2::where('username', $user->username)
                                          ->where('status', 'ditolak')
                                          ->count(),

                'konversiSKS2' => Konversi2::where('username', $user->username)
                                          ->where('status', 'dikembalikan')
                                          ->count(),
            ];
        }

        return view('dashboard', $data);
    }
}
