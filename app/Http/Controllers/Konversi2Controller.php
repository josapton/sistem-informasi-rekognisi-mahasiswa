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
                'title' => 'Konversi SKS',
                'menuAdminKonversi' => 'active',
                'menuAdminKonversiSKS' => 'active',
                'menuAdminKonversiCollapse' => request('menuAdminKonversiSKS', 'active') ? 'show' : 'hide',
                'pengajuan' => Konversi2::with('mahasiswa', 'details')->whereIn('status', ['diajukan', 'dikembalikan'])->latest()->get(),
            );
        return view('admin.konversi.sks.index', $data);
        } elseif ($user->role == 'Kaprodi') {
            $data = array(
                'title' => 'Konversi SKS',
                'menuKaprodiKonversi' => 'active',
                'menuKaprodiKonversiSKS' => 'active',
                'menuKaprodiKonversiCollapse' => request('menuKaprodiKonversiSKS', 'active') ? 'show' : 'hide',
                'pengajuan' => Konversi2::with('mahasiswa', 'details')->whereIn('status', ['diajukan', 'dikembalikan'])->latest()->get(),
            );
            return view('kaprodi.konversi.sks.index', $data);
        } else {
            $data = array(
                'title' => 'Konversi SKS',
                'menuMahasiswaKonversi' => 'active',
                'menuMahasiswaKonversiSKS' => 'active',
                'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiSKS', 'active') ? 'show' : 'hide',
                'pengajuan' => Konversi2::where('username', Auth::user()->username)->with('details')->latest()->get(),
                'items' => [
                    ['nama_item' => '', 'jenis' => 'matakuliah', 'sks' => '']
                ],
            );
            return view('mahasiswa.konversi.sks.index', $data);
        }
        
    }
    public function store(Request $request)
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
            $konversi = Konversi2::create([
                'username' => $mahasiswa->username,
                'total_sks' => $totalSksDiajukan,
                'status' => 'diajukan',
            ]);

            // 2. Simpan detail item
            for ($i = 0; $i < count($request->nama_item); $i++) {
                Konversi2Detail::create([
                    'konversi2_id' => $konversi->id,
                    'nama_item' => $request->nama_item[$i],
                    'jenis' => $request->jenis[$i],
                    'sks' => $request->sks[$i],
                ]);
            }
        });

        return redirect()->route('konversiSKS')->with('success', 'Pengajuan konversi berhasil dikirim.');
    }
    public function history(Konversi2 $konversi)
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = array(
            'title' => 'Riwayat Konversi SKS',
            'menuAdminKonversi' => 'active',
            'menuAdminKonversiSKS2' => 'active',
            'menuAdminKonversiCollapse' => request('menuAdminKonversiSKS2', 'active') ? 'show' : 'hide',
            'history' => Konversi2::whereIn('status', ['divalidasi', 'ditolak'])->with('mahasiswa')->latest('updated_at')->get(),
        );
        return view('admin.konversi.sks.history', $data);
        } elseif ($user->role == 'Kaprodi') {
            $data = array(
            'title' => 'Riwayat Konversi SKS',
            'menuKaprodiKonversi' => 'active',
            'menuKaprodiKonversiSKS2' => 'active',
            'menuKaprodiKonversiCollapse' => request('menuKaprodiKonversiDetail', 'active') ? 'show' : 'hide',
            'history' => Konversi2::whereIn('status', ['divalidasi', 'ditolak'])->with('mahasiswa')->latest('updated_at')->get(),
        );
        return view('kaprodi.konversi.sks.history', $data);
        } else {
            $data = array(
            'title' => 'Riwayat Konversi SKS',
            'menuMahasiswaKonversi' => 'active',
            'menuMahasiswaKonversiSKS2' => 'active',
            'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiSKS2', 'active') ? 'show' : 'hide',
            'history' => Konversi2::where('username', Auth::user()->username)->with('details')->latest()->get(),
        );
        return view('mahasiswa.konversi.sks.history', $data);
    }
    }
    public function edit(Konversi2 $konversi)
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = array(
            'title' => 'Periksa Pengajuan Konversi SKS',
            'menuAdminKonversi' => 'active',
            'menuAdminKonversiSKS' => 'active',
            'menuAdminKonversiCollapse' => request('menuAdminKonversiSKS', 'active') ? 'show' : 'hide',
            'konversi' => $konversi->load('mahasiswa', 'details'),
        );
        return view('admin.konversi.sks.edit', $data);
        } elseif ($user->role == 'Kaprodi') {
            $data = array(
            'title' => 'Periksa Pengajuan Konversi SKS',
            'menuKaprodiKonversi' => 'active',
            'menuKaprodiKonversiSKS' => 'active',
            'menuKaprodiKonversiCollapse' => request('menuKaprodiKonversiSKS', 'active') ? 'show' : 'hide',
            'konversi' => $konversi->load('mahasiswa', 'details'),
        );
        return view('kaprodi.konversi.sks.edit', $data);
        } else {
            // --- Pengecekan Keamanan ---
            // 1. Pastikan pengajuan ini milik user yang sedang login
            if ($konversi->username !== Auth::user()->username) {
                abort(403, 'AKSES DITOLAK'); // Mencegah user mengedit pengajuan orang lain
            }

            // 2. Pastikan statusnya adalah 'dikembalikan'
            if ($konversi->status !== 'dikembalikan') {
                return redirect()->route('riwayatKonversiSKS')
                                 ->with('error', 'Pengajuan ini tidak dapat diedit.');
            }

            // Load detail item untuk ditampilkan di form
            $konversi->load('details');
            $data = array(
            'title' => 'Periksa Pengajuan Konversi SKS',
            'menuMahasiswaKonversi' => 'active',
            'menuMahasiswaKonversiSKS2' => 'active',
            'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiSKS2', 'active') ? 'show' : 'hide',
            'konversi' => $konversi,
        );
        return view('mahasiswa.konversi.sks.edit', $data);
        }
    }
    public function update(Request $request, Konversi2 $konversi)
    {
        $user = Auth::user();
        if ($user->role == 'Mahasiswa') {
            // --- Pengecekan Keamanan (lagi, sebagai lapisan kedua) ---
            if ($konversi->username !== Auth::user()->username || $konversi->status !== 'dikembalikan') {
                abort(403, 'AKSES DITOLAK');
            }

            // Validasi input sama seperti saat membuat baru
            $request->validate([
                'nama_item.*' => 'required|string|max:255',
                'jenis.*' => 'required|in:matakuliah,mikrokredensial',
                'sks.*' => 'required|decimal:0,2',
            ]);

            $mahasiswa = Auth::user()->mahasiswa;
            $totalSksBaru = array_sum($request->sks);

            // Cek kecukupan SKS
            if ($mahasiswa->sks < $totalSksBaru) {
                return back()->with('error', 'Tabungan SKS Anda tidak mencukupi.')->withInput();
            }

            // Gunakan transaction untuk memastikan semua query berhasil
            DB::transaction(function () use ($request, $konversi, $totalSksBaru) {
                // 1. Hapus detail item yang lama
                $konversi->details()->delete();

                // 2. Buat ulang detail item dengan data yang baru
                for ($i = 0; $i < count($request->nama_item); $i++) {
                    Konversi2Detail::create([
                        'konversi2_id' => $konversi->id,
                        'nama_item' => $request->nama_item[$i],
                        'jenis' => $request->jenis[$i],
                        'sks' => $request->sks[$i],
                    ]);
                }

                // 3. Update pengajuan utama
                $konversi->update([
                    'total_sks' => $totalSksBaru,
                    'status' => 'diajukan', // Status kembali menjadi 'diajukan'
                    'catatan_kaprodi' => null, // Hapus catatan lama (opsional)
                ]);
            });

            return redirect()->route('riwayatKonversiSKS')
                             ->with('success', 'Pengajuan berhasil diperbarui dan dikirim kembali.');
        } else {
            $request->validate([
                'status' => 'required|in:divalidasi,ditolak,dikembalikan',
                'catatan_kaprodi' => 'nullable|string',
                // Validasi untuk item jika kaprodi bisa mengubahnya
                'nama_item.*' => 'required|string|max:255',
                'jenis.*' => 'required|in:matakuliah,mikrokredensial',
                'sks.*' => 'required|decimal:0,2',
            ]);

            DB::transaction(function () use ($request, $konversi) {
                // Hapus detail lama dan buat yang baru (jika kaprodi memodifikasi)
                $konversi->details()->delete();

                $totalSksBaru = 0;
                for ($i = 0; $i < count($request->nama_item); $i++) {
                    Konversi2Detail::create([
                        'konversi2_id' => $konversi->id,
                        'nama_item' => $request->nama_item[$i],
                        'jenis' => $request->jenis[$i],
                        'sks' => $request->sks[$i],
                    ]);
                    $totalSksBaru += $request->sks[$i];
                }

                // Jika statusnya divalidasi, kurangi tabungan SKS mahasiswa
                if ($request->status == 'divalidasi') {
                    $mahasiswa = $konversi->mahasiswa;
                    if ($mahasiswa->sks < $totalSksBaru) {
                        // Batalkan transaksi dan kirim error
                        // Ini adalah fallback, idealnya ada validasi di frontend juga
                        throw new \Exception('Tabungan SKS mahasiswa tidak mencukupi untuk validasi.');
                    }
                    // Kurangi SKS
                    $mahasiswa->decrement('sks', $totalSksBaru);
                }

                // Update pengajuan utama
                $konversi->update([
                    'status' => $request->status,
                    'total_sks' => $totalSksBaru,
                    'catatan_kaprodi' => $request->catatan_kaprodi,
                ]);
            });

            return redirect()->route('konversiSKS')->with('success', 'Status pengajuan berhasil diperbarui.');
        }
    }
}