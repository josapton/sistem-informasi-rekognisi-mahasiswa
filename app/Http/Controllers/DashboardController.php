<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Konversi;
use App\Models\Konversi2;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Dashboard',
            'menuDashboard' => 'active',
            'jumlahUser' => User::count(),
            'jumlahMahasiswa' => User::where('role', 'Mahasiswa')->count(),
            'jumlahKegiatan' => Kegiatan::count(),
            'kegiatanDiajukan' => DB::table('kegiatan_mahasiswa')->where('status', 'menunggu')->count(),
            'konversiKegiatan' => Konversi::with('mahasiswa', 'kegiatan')->where('status', 'diajukan')->count(),
            'konversiSKS' => Konversi2::with('mahasiswa', 'details')->where('status', 'diajukan')->count(),
        );
        return view('dashboard', $data);
    }
}
