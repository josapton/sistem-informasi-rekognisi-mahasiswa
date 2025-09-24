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

        return redirect()->route('konversiMatkul')->with('success', 'Pengajuan konversi berhasil dikirim.');
    }
    public function show(Konversi2 $konversi)
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = array(
            'title' => 'Detail Konversi Mata Kuliah & Mikrokredensial',
            'menuAdminKonversi' => 'active',
            'menuAdminKonversiDetail' => 'active',
            'menuAdminKonversiCollapse' => request('menuAdminKonversiDetail', 'active') ? 'show' : 'hide',
            'detail' => Konversi2::whereIn('status', ['divalidasi', 'ditolak'])->with('mahasiswa')->latest('updated_at')->get(),
        );
        return view('admin.konversi.sks.show', $data);
        } elseif ($user->role == 'Kaprodi') {
            $data = array(
            'title' => 'Detail Konversi Mata Kuliah & Mikrokredensial',
            'menuKaprodiKonversi' => 'active',
            'menuKaprodiKonversiDetail' => 'active',
            'menuKaprodiKonversiCollapse' => request('menuKaprodiKonversiDetail', 'active') ? 'show' : 'hide',
            'detail' => Konversi2::whereIn('status', ['divalidasi', 'ditolak'])->with('mahasiswa')->latest('updated_at')->get(),
        );
        return view('kaprodi.konversi.sks.show', $data);
        } else {
            $data = array(
            'title' => 'Detail Konversi Mata Kuliah & Mikrokredensial',
            'menuMahasiswaKonversi' => 'active',
            'menuMahasiswaKonversiDetail' => 'active',
            'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiDetail', 'active') ? 'show' : 'hide',
            'detail' => Konversi2::where('username', Auth::user()->username)->with('details')->latest()->get(),
        );
        return view('mahasiswa.konversi.sks.show', $data);
    }
    }
    public function edit(Konversi2 $konversi)
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = array(
            'title' => 'Edit Pengajuan Konversi Mata Kuliah & Mikrokredensial',
            'menuAdminKonversi' => 'active',
            'menuAdminKonversiMatkul' => 'active',
            'menuAdminKonversiCollapse' => request('menuAdminKonversiMatkul', 'active') ? 'show' : 'hide',
            'konversi' => $konversi->load('mahasiswa', 'details'),
        );
        return view('admin.konversi.sks.edit', $data);
        } else {
            $data = array(
            'title' => 'Edit Pengajuan Konversi Mata Kuliah & Mikrokredensial',
            'menuKaprodiKonversi' => 'active',
            'menuKaprodiKonversiMatkul' => 'active',
            'menuKaprodiKonversiCollapse' => request('menuKaprodiKonversiMatkul', 'active') ? 'show' : 'hide',
            'konversi' => $konversi->load('mahasiswa', 'details'),
        );
        return view('kaprodi.konversi.sks.edit', $data);
        }
    }
    public function update(Request $request, Konversi2 $konversi)
    {
        $request->validate([
            'status' => 'required|in:divalidasi,ditolak,dikembalikan',
            'catatan_kaprodi' => 'nullable|string',
            // Validasi untuk item jika kaprodi bisa mengubahnya
            'nama_item.*' => 'required|string|max:255',
            'jenis.*' => 'required|in:matakuliah,mikrokredensial',
            'sks.*' => 'required|integer|min:1',
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

        return redirect()->route('konversiMatkul')->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}