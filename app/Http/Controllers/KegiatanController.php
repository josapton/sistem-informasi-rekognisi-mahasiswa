<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\deskripsiKegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Kegiatan',
            'menuAdminKegiatan' => 'active',
            'kegiatan' => Kegiatan::get()
        );
        return view('admin.kegiatan.index', $data);
    }
    public function create()
    {
        $data = array(
            'title' => 'Tambah Data Kegiatan',
            'menuAdminKegiatan' => 'active',
        );
        return view('admin.kegiatan.create', $data);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
        'nama_kegiatan' => 'required|string|max:1000',
        'tipe_konversi' => 'required|string|in:SKS,Mikrokredensial',
        'bobot' => 'required|numeric|min:0',
        'penempatan' => 'required|string|max:1000',
        'kriteria' => 'required|string|max:1000',
        'deskripsi' => 'required|string|max:1000',
        'cpl' => 'required|string|max:1000',
    ],[
        // ... (semua pesan kustom Anda di sini) ...
        'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong',
        'tipe_konversi.required' => 'Tipe konversi harus dipilih',
        'bobot.required' => 'Bobot tidak boleh kosong',
        'bobot.numeric' => 'Bobot harus berupa angka',
        'bobot.min' => 'Bobot tidak boleh kurang dari 0',
        'penempatan.required' => 'Penempatan tidak boleh kosong',
        'kriteria.required' => 'Kriteria tidak boleh kosong',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong',
        'cpl.required' => 'CPL tidak boleh kosong',
    ]);

    $kegiatan = Kegiatan::create([
        'nama_kegiatan' => $validatedData['nama_kegiatan'],
        'tipe_konversi' => $validatedData['tipe_konversi'],
        'bobot' => $validatedData['bobot'],
    ]);

    $kegiatan->deskripsiKegiatan()->create([
        'penempatan' => $validatedData['penempatan'],
        'kriteria' => $validatedData['kriteria'],
        'deskripsi' => $validatedData['deskripsi'],
        'cpl' => $validatedData['cpl'],
    ]);

    // 4. Redirect
    return redirect()->route('kegiatan')->with('success', 'Data berhasil ditambahkan.');
    }
    public function detail($id)
    {
        $data = array(
            'title' => 'Detail Kegiatan',
            'menuAdminKegiatan' => 'active',
            'kegiatan' => Kegiatan::findOrFail($id)
        );
        return view('admin.kegiatan.detail', $data);
    }
    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Data Kegiatan',
            'menuAdminKegiatan' => 'active',
            'kegiatan' => Kegiatan::findOrFail($id)
        );

        return view('admin.kegiatan.update', $data);
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
        'nama_kegiatan' => 'required|string|max:1000',
        'tipe_konversi' => 'required|string|in:SKS,Mikrokredensial',
        'bobot' => 'required|numeric|min:0',
        'penempatan' => 'required|string|max:1000',
        'kriteria' => 'required|string|max:1000',
        'deskripsi' => 'required|string|max:1000',
        'cpl' => 'required|string|max:1000',
    ],[
        'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong',
        'tipe_konversi.required' => 'Tipe konversi harus dipilih',
        'bobot.required' => 'Bobot tidak boleh kosong',
        'bobot.numeric' => 'Bobot harus berupa angka',
        'bobot.min' => 'Bobot tidak boleh kurang dari 0',
        'penempatan.required' => 'Penempatan tidak boleh kosong',
        'kriteria.required' => 'Kriteria tidak boleh kosong',
        'deskripsi.required' => 'Deskripsi tidak boleh kosong',
        'cpl.required' => 'CPL tidak boleh kosong',
    ]);

    $kegiatan = Kegiatan::findOrFail($id);
    $kegiatan->update([
        'nama_kegiatan' => $validatedData['nama_kegiatan'],
        'tipe_konversi' => $validatedData['tipe_konversi'],
        'bobot' => $validatedData['bobot'],
    ]);

    $kegiatan->deskripsiKegiatan()->update([
        'penempatan' => $validatedData['penempatan'],
        'kriteria' => $validatedData['kriteria'],
        'deskripsi' => $validatedData['deskripsi'],
        'cpl' => $validatedData['cpl'],
    ]);

    return redirect()->route('kegiatan')->with('success', 'Data berhasil diupdate.');
    }
    public function destroy($id){
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('kegiatan')->with('success', 'Data berhasil dihapus.');
    }
}