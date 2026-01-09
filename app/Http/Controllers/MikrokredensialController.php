<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mikrokredensial;
use Illuminate\Support\Facades\Auth;

class MikrokredensialController extends Controller
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
            'title' => 'Data Mikrokredensial',
            'menuAdminCpl' => 'active',
            'menuAdminMikrokredensial' => 'active',
            'menuAdminCplCollapse' => request('menuAdminMikrokredensial', 'active') ? 'show' : 'hide',
            'mikrokredensials' => Mikrokredensial::get(),
        ];
        return view('admin.mikrokredensial.index', $data);
        } else {
            $data = [
            'title' => 'Data Mikrokredensial',
            'menuKaprodiCpl' => 'active',
            'menuKaprodiMikrokredensial' => 'active',
            'menuKaprodiCplCollapse' => request('menuKaprodiMikrokredensial', 'active') ? 'show' : 'hide',
            'mikrokredensials' => Mikrokredensial::get(),
        ];
        return view('kaprodi.mikrokredensial.index', $data);
        }
        
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = [
            'title' => 'Tambah Mikrokredensial',
            'menuAdminCpl' => 'active',
            'menuAdminMikrokredensial' => 'active',
            'menuAdminCplCollapse' => request('menuAdminMikrokredensial', 'active') ? 'show' : 'hide',
        ];
        return view('admin.mikrokredensial.create', $data);
        } else {
            $data = [
            'title' => 'Tambah Mikrokredensial',
            'menuKaprodiCpl' => 'active',
            'menuKaprodiMikrokredensial' => 'active',
            'menuKaprodiCplCollapse' => request('menuKaprodiMikrokredensial', 'active') ? 'show' : 'hide',
        ];
        return view('kaprodi.mikrokredensial.create', $data);
        }
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mikrokredensial' => 'required|string|max:1000',
            'bobot' => 'required|numeric|min:0|max:1',
            'deskripsi' => 'nullable|string',
        ],[
            'nama_mikrokredensial.required' => 'Nama Mikrokredensial tidak boleh kosong',
            'bobot.reequired' => 'Bobot tidak boleh kosong',
        ]);

        Mikrokredensial::create($request->only(['nama_mikrokredensial','bobot','deskripsi']));

        return redirect()->route('mikrokredensial.index')->with('success', 'Mikrokredensial berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $m = Mikrokredensial::findOrFail($id);
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = [
            'title' => 'Edit Mikrokredensial',
            'menuAdminCpl' => 'active',
            'menuAdminMikrokredensial' => 'active',
            'menuAdminCplCollapse' => request('menuAdminMikrokredensial', 'active') ? 'show' : 'hide',
            'mikrokredensial' => $m,
        ];
        return view('admin.mikrokredensial.edit', $data);
        } else {
            $data = [
            'title' => 'Edit Mikrokredensial',
            'menuKaprodiCpl' => 'active',
            'menuKaprodiMikrokredensial' => 'active',
            'menuKaprodiCplCollapse' => request('menuKaprodiMikrokredensial', 'active') ? 'show' : 'hide',
            'mikrokredensial' => $m,
        ];
        return view('kaprodi.mikrokredensial.edit', $data);
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mikrokredensial' => 'required|string|max:1000',
            'bobot' => 'required|numeric|min:0|max:1',
            'deskripsi' => 'nullable|string',
        ],[
            'nama_mikrokredensial.required' => 'Nama Mikrokredensial tidak boleh kosong',
            'bobot.reequired' => 'Bobot tidak boleh kosong',
        ]);

        $m = Mikrokredensial::findOrFail($id);
        $m->update($request->only(['nama_mikrokredensial','bobot','deskripsi']));

        return redirect()->route('mikrokredensial.index')->with('success', 'Mikrokredensial berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $m = Mikrokredensial::findOrFail($id);
        $m->delete();
        return back()->with('success', 'Mikrokredensial berhasil dihapus.');
    }
}
