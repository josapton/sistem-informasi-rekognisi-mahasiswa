<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth;

class MatakuliahController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:Admin,Kaprodi');
    }
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = [
            'title' => 'Data Mata Kuliah',
            'menuAdminCpl' => 'active',
            'menuAdminMatakuliah' => 'active',
            'menuAdminCplCollapse' => request('menuAdminMatakuliah', 'active') ? 'show' : 'hide',
            'matakuliah' => Matakuliah::get(),
        ];
        return view('admin.matakuliah.index', $data);
        } else {
            $data = [
            'title' => 'Data Mata Kuliah',
            'menuKaprodiCpl' => 'active',
            'menuKaprodiMatakuliah' => 'active',
            'menuKaprodiCplCollapse' => request('menuKaprodiMatakuliah', 'active') ? 'show' : 'hide',
            'matakuliah' => Matakuliah::get(),
        ];
        return view('kaprodi.matakuliah.index', $data);
        }
        
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role = 'Admin') {
            $data = [
            'title' => 'Tambah Mata Kuliah',
            'menuAdminCpl' => 'active',
            'menuAdminMatakuliah' => 'active',
            'menuAdminCplCollapse' => request('menuAdminMatakuliah', 'active') ? 'show' : 'hide',
        ];
        return view('admin.matakuliah.create', $data);
        } else {
            $data = [
            'title' => 'Tambah Mata Kuliah',
            'menuKaprodiCpl' => 'active',
            'menuKaprodiMatakuliah' => 'active',
            'menuKaprodiCplCollapse' => request('menuKaprodiMatakuliah', 'active') ? 'show' : 'hide',
        ];
        return view('kaprodi.matakuliah.create', $data);
        }
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:1000',
            'bobot' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ],[
            'nama_matakuliah.required' => 'Nama Mata Kuliah tidak boleh kosong',
            'bobot.required' => 'Bobot tidak boleh kosong',
        ]);

        Matakuliah::create($request->only(['nama_matakuliah','bobot','deskripsi']));

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $m = Matakuliah::findOrFail($id);
        $user = Auth::user();
        if ($user->role = 'Admin') {
            $data = [
            'title' => 'Edit Mata Kuliah',
            'menuAdminCpl' => 'active',
            'menuAdminMatakuliah' => 'active',
            'menuAdminCplCollapse' => request('menuAdminMatakuliah', 'active') ? 'show' : 'hide',
            'matakuliah' => $m,
        ];
        return view('admin.matakuliah.edit', $data);
        } else {
            $data = [
            'title' => 'Edit Mata Kuliah',
            'menuKaprodiCpl' => 'active',
            'menuKaprodiMatakuliah' => 'active',
            'menuKaprodiCplCollapse' => request('menuKaprodiMatakuliah', 'active') ? 'show' : 'hide',
            'matakuliah' => $m,
        ];
        return view('kaprodi.matakuliah.edit', $data);
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:1000',
            'bobot' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ],[
            'nama_matakuliah.required' => 'Nama Mata Kuliah tidak boleh kosong',
            'bobot.required' => 'Bobot tidak boleh kosong',
        ]);

        $m = Matakuliah::findOrFail($id);
        $m->update($request->only(['nama_matakuliah','bobot','deskripsi']));

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $m = Matakuliah::findOrFail($id);
        $m->delete();
        return back()->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
