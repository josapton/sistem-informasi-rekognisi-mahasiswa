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
        } else {
            $mahasiswa = Mahasiswa::where('username', $user->username)->first();
            $data = array(
                'title' => 'Konversi Kegiatan',
                'menuMahasiswaKonversi' => 'active',
                'menuMahasiswaKonversiKegiatan' => 'active',
                'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiKegiatan', 'active') ? 'show' : 'hide',
                'pengajuan' => $mahasiswa
                    ? Kegiatan::whereHas('mahasiswas', function($q) use ($mahasiswa) {
                        $q->where('mahasiswas.username', $mahasiswa->username);
                    })->with(['mahasiswas' => function($q) use ($mahasiswa) {
                        $q->where('mahasiswas.username', $mahasiswa->username);
                    }])->get()
                    : collect(),
            );
            return view('mahasiswa.konversi.kegiatan.index', $data);
        }
    }
    public function store(Kegiatan $kegiatan)
    {
        $mahasiswa = Auth::user();

        // Cek sekali lagi untuk mencegah data ganda
        $exists = Konversi::where('username', $mahasiswa->username)
                          ->where('kegiatan_id', $kegiatan->id)
                          ->exists();

        if ($exists) {
            return back()->with('error', 'Konversi untuk kegiatan ini sudah pernah diajukan.');
        }

        Konversi::create([
            'username' => $mahasiswa->username,
            'kegiatan_id' => $kegiatan->id,
            'status' => 'diajukan',
        ]);

        return back()->with('success', 'Konversi Kegiatan berhasil diajukan.');
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
    public function history()
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
            $mahasiswa = Mahasiswa::where('username', $user->username)->first();
            $data = array(
            'title' => 'Riwayat Konversi Kegiatan',
            'menuMahasiswaKonversi' => 'active',
            'menuMahasiswaKonversiKegiatan2' => 'active',
            'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiKegiatan2', 'active') ? 'show' : 'hide',
            'riwayat' => $mahasiswa
                ? Konversi::whereHas('mahasiswa', function($q) use ($mahasiswa) {
                    $q->where('username', $mahasiswa->username);
                })->with(['mahasiswa' => function($q) use ($mahasiswa) {
                    $q->where('username', $mahasiswa->username);
                }])->whereIn('status', ['divalidasi', 'ditolak'])->latest()->get()
                : collect(),
            );
            return view('mahasiswa.konversi.kegiatan.history', $data);
        }
    }
}