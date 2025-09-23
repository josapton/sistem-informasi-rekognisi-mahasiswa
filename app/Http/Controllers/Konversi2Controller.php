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
            // Logika untuk "Tambah Baris" tanpa JavaScript
            $items = [];
            if ($request->old('nama_item')) {
                for ($i = 0; $i < count($request->old('nama_item')); $i++) {
                    $items[] = [
                        'nama_item' => $request->old('nama_item')[$i],
                        'jenis' => $request->old('jenis')[$i],
                        'sks' => $request->old('sks')[$i],
                    ];
                }
            }

            // Jika tombol "Tambah Baris" ditekan, tambahkan satu baris kosong
            if ($request->query('action') === 'add_item') {
                $items[] = ['nama_item' => '', 'jenis' => 'matakuliah', 'sks' => ''];
            }

            // Jika form pertama kali dibuka, buat satu baris default
            if (empty($items)) {
                $items[] = ['nama_item' => '', 'jenis' => 'matakuliah', 'sks' => ''];
            }
            $data = array(
                'title' => 'Konversi Mata Kuliah & Mikrokredensial',
                'menuMahasiswaKonversi' => 'active',
                'menuMahasiswaKonversiMatkul' => 'active',
                'menuMahasiswaKonversiCollapse' => request('menuMahasiswaKonversiMatkul', 'active') ? 'show' : 'hide',
                'pengajuan' => Konversi2::where('username', Auth::id())->with('details')->latest()->get(),
                'items' => $items,
            );
            return view('mahasiswa.konversi.sks.index', $data);
        }
        
    }
    public function store(Request $request)
    {
        // Handle jika user menekan tombol "Tambah Baris"
        if ($request->has('add_item_action')) {
            // Redirect kembali ke halaman create dengan input lama dan query string
            return Redirect::route('konversiMatkul', ['action' => 'add_item'])->withInput();
        }

        $request->validate([
            'nama_item.*' => 'required|string|max:255',
            'jenis.*' => 'required|in:matakuliah,mikrokredensial',
            'sks.*' => 'required|integer|min:1',
        ]);

        $mahasiswa = Auth::user();
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
