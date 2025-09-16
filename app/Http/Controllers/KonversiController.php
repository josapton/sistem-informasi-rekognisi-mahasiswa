<?php

namespace App\Http\Controllers;

use App\Models\Konversi;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use App\Models\Cpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KonversiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = array(
            'title' => 'Konversi Kegiatan',
            'menuAdminKonversi' => 'active',
            'menuAdminKonversiKegiatan' => 'active',
            'menuAdminKonversiCollapse' => request('menuAdminKonversiKegiatan', 'active') ? 'show' : 'hide',
            'pengajuan' => Konversi::with('mahasiswa', 'kegiatan')->where('status', 'diajukan')->get(),
            'mahasiswa' => Mahasiswa::with('cpls')->get(),
            'kegiatan' => Kegiatan::whereHas('mahasiswas')->with('mahasiswas')->get(),
            'cpls' => Cpl::all(),
        );
        return view('admin.konversi.kegiatan.index', $data);
        } elseif ($user->role == 'Kaprodi') {
            $data = array(
            'title' => 'Konversi Kegiatan',
            'menuKaprodiKonversi' => 'active',
            'menuKaprodiKonversiKegiatan' => 'active',
            'menuKaprodiKonversiCollapse' => request('menuKaprodiKonversiKegiatan', 'active') ? 'show' : 'hide',
            'pengajuan' => Konversi::with('mahasiswa', 'kegiatan')->where('status', 'diajukan')->get(),
            'mahasiswa' => Mahasiswa::with('cpls')->get(),
            'kegiatan' => Kegiatan::whereHas('mahasiswas')->with('mahasiswas')->get(),
            'cpls' => Cpl::all(),
        );
        return view('kaprodi.konversi.kegiatan.index', $data);
        } elseif ($user->role == 'Mahasiswa') {
            $data = array(
            'title' => 'Konversi Kegiatan',
            'menuMahasiswaKonversi' => 'active',
            'menuMahasiswaKonversiKegiatan' => 'active',
            'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiKegiatan', 'active') ? 'show' : 'hide',
            'pengajajuan' => Kegiatan::whereHas('mahasiswas')->with('mahasiswas')->where('status', 'diterima')->get(),
        );
        return view('mahasiswa.konversi.kegiatan.index', $data);
        }
        
    }
    public function validasiPengajuan(Request $request, Konversi $konversi)
    {
        $request->validate([
            'status' => 'required|in:divalidasi,ditolak',
            'catatan_validator' => 'nullable|string',
        ]);

        // Gunakan Transaction untuk memastikan integritas data.
        // Jika penambahan SKS gagal, status konversi tidak akan berubah.
        DB::transaction(function () use ($request, $konversi) {

            // Jika disetujui, tambahkan SKS mahasiswa
            if ($request->status == 'divalidasi') {
                $mahasiswa = $konversi->mahasiswa;
                $kegiatan = $konversi->kegiatan;

                $mahasiswa->sks += $kegiatan->bobot;
                $mahasiswa->save();
            }

            // Update status pengajuan konversi
            $konversi->status = $request->status;
            $konversi->catatan_validator = $request->catatan_validator;
            $konversi->save();

        });

        return back()->with('success', 'Status konversi berhasil diperbarui.');
    }
    public function historyAdmin()
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = array(
            'title' => 'Riwayat Konversi Kegiatan',
            'menuAdminKonversi' => 'active',
            'menuAdminKonversiKegiatan2' => 'active',
            'menuAdminKonversiCollapse' => request('menuAdminKonversiKegiatan2', 'active') ? 'show' : 'hide',
            'pengajuan' => Konversi::with('mahasiswa', 'kegiatan')->where('status', 'diajukan')->get(),
            'mahasiswa' => Mahasiswa::with('cpls')->get(),
            'kegiatan' => Kegiatan::whereHas('mahasiswas')->with('mahasiswas')->get(),
            'cpls' => Cpl::all(),
            'riwayat' => Konversi::with(['mahasiswa', 'kegiatan'])
                               ->whereIn('status', ['divalidasi', 'ditolak']) 
                               ->latest() // Urutkan dari yang terbaru
                               ->get(),
        );
        return view('admin.konversi.kegiatan.history', $data);
        } elseif ($user->role == 'Kaprodi') {
            $data = array(
            'title' => 'Riwayat Konversi Kegiatan',
            'menuKaprodiKonversi' => 'active',
            'menuKaprodiKonversiKegiatan2' => 'active',
            'menuKaprodiKonversiCollapse' => request('menuKaprodiKonversiKegiatan2', 'active') ? 'show' : 'hide',
            'pengajuan' => Konversi::with('mahasiswa', 'kegiatan')->where('status', 'diajukan')->get(),
            'mahasiswa' => Mahasiswa::with('cpls')->get(),
            'kegiatan' => Kegiatan::whereHas('mahasiswas')->with('mahasiswas')->get(),
            'cpls' => Cpl::all(),
            'riwayat' => Konversi::with(['mahasiswa', 'kegiatan'])
                               ->whereIn('status', ['divalidasi', 'ditolak']) 
                               ->latest() // Urutkan dari yang terbaru
                               ->get(),
        );
        return view('kaprodi.konversi.kegiatan.history', $data);
        } else {
            # code...
        }
        
    }
}
