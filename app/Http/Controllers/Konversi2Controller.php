<?php

namespace App\Http\Controllers;

use App\Models\Konversi2;
use App\Models\Konversi2Detail;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Konversi2Controller extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = array(
                'title' => 'Konversi Mata Kuliah & Mikrokredensial',
                'menuAdminKonversi' => 'active',
                'menuAdminKonversiMatkul' => 'active',
                'menuAdminKonversiCollapse' => request('menuAdminKonversiMatkul', 'active') ? 'show' : 'hide',
                'pengajuan' => Konversi2::with('mahasiswa', 'details')->whereIn('status', ['diajukan', 'dikembalikan'])->latest()->get(),
            );
        return view('admin.konversi.sks.index', $data);
        } elseif ($user->role == 'Kaprodi') {
            $data = array(
                'title' => 'Konversi Mata Kuliah & Mikrokredensial',
                'menuKaprodiKonversi' => 'active',
                'menuKaprodiKonversiMatkul' => 'active',
                'menuKaprodiKonversiCollapse' => request('menuKaprodiKonversiMatkul', 'active') ? 'show' : 'hide',
                'pengajuan' => Konversi2::with('mahasiswa', 'details')->whereIn('status', ['diajukan', 'dikembalikan'])->latest()->get(),
            );
            return view('kaprodi.konversi.sks.index', $data);
        } else {
            $data = array(
                'title' => 'Konversi Mata Kuliah & Mikrokredensial',
                'menuMahasiswaKonversi' => 'active',
                'menuMahasiswaKonversiMatkul' => 'active',
                'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiMatkul', 'active') ? 'show' : 'hide',
                'pengajuan' => Konversi2::where('username', Auth::user()->username)->with('details')->latest()->get(),
                'items' => [
                    ['nama_item' => '', 'jenis' => 'matakuliah', 'sks' => '']
                ],
            );
            return view('mahasiswa.konversi.sks.index', $data);
        }
        
    }
    public function store(Request $request, Konversi2 $konversi2, Konversi2Detail $konversi2Detail)
    {
        $request->validate([
            'nama_item.*' => 'required|string|max:255',
            'jenis.*' => 'required|in:matakuliah,mikrokredensial',
            'sks.*' => 'required|decimal:0,2',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;
        $totalSksDiajukan = array_sum($request->sks);

        if ($mahasiswa->sks < $totalSksDiajukan) {
            return back()->with('error', 'Tabungan SKS Anda tidak mencukupi.')->withInput();
        }

        DB::transaction(function () use ($request, $mahasiswa, $totalSksDiajukan) {
            // 1. Buat data pengajuan utama
            $konversi2 = Konversi2::create([
                'username' => $mahasiswa->username,
                'total_sks' => $totalSksDiajukan,
                'status' => 'diajukan',
            ]);

            // 2. Simpan detail item
            for ($i = 0; $i < count($request->nama_item); $i++) {
                Konversi2Detail::create([
                    'konversi2_id' => $konversi2->id,
                    'nama_item' => $request->nama_item[$i],
                    'jenis' => $request->jenis[$i],
                    'sks' => $request->sks[$i],
                ]);
            }
        });

        return redirect()->route('konversiMatkul')->with('success', 'Pengajuan konversi berhasil dikirim.');
    }

}
