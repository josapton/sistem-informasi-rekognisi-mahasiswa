<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cpl;
use Illuminate\Support\Facades\Auth;

class CplController extends Controller
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
            'title' => 'Kelola CPL',
            'menuAdminCpl' => 'active',
            'menuAdminCplList' => 'active',
            'menuAdminCplCollapse' => request('menuAdminCplList', 'active') ? 'show' : 'hide',
            'cpls' => Cpl::orderBy('kode_cpl')->get(),
            'cplCount' => Cpl::count(),
        ];

        return view('admin.cpl.index', $data);
        } else {
            $data = [
            'title' => 'Kelola CPL',
            'menuKaprodiCpl' => 'active',
            'menuKaprodiCplList' => 'active',
            'menuKaprodiCplCollapse' => request('menuKaprodiCplList', 'active') ? 'show' : 'hide',
            'cpls' => Cpl::orderBy('kode_cpl')->get(),
            'cplCount' => Cpl::count(),
        ];

        return view('kaprodi.cpl.index', $data);
        }
        
    }

    public function edit($kode_cpl)
    {
        $cpl = Cpl::findOrFail($kode_cpl);
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = [
            'title' => 'Edit CPL',
            'menuAdminCpl' => 'active',
            'menuAdminCplList' => 'active',
            'menuAdminCplCollapse' => request('menuAdminCplList', 'active') ? 'show' : 'hide',
            'cpl' => $cpl,
        ];
        return view('admin.cpl.edit', $data);
        } else {
            $data = [
            'title' => 'Edit CPL',
            'menuKaprodiCpl' => 'active',
            'menuKaprodiCplList' => 'active',
            'menuKaprodiCplCollapse' => request('menuKparodiCplList', 'active') ? 'show' : 'hide',
            'cpl' => $cpl,
        ];
        return view('kaprodi.cpl.edit', $data);
        }
        
    }

    public function update(Request $request, $kode_cpl)
    {
        $request->validate([
            'deskripsi' => 'nullable|string|max:2000',
        ]);
        // Pastikan jumlah CPL tepat 10 sebelum memperbolehkan update
        $count = Cpl::count();
        if ($count !== 10) {
            return redirect()->route('cpl.index')->with('error', 'Jumlah CPL harus 10. Perbaiki data CPL terlebih dahulu sebelum mengubah deskripsi. Detected: ' . $count);
        }

        $cpl = Cpl::findOrFail($kode_cpl);
        $cpl->deskripsi = $request->deskripsi;
        $cpl->save();

        return redirect()->route('cpl.index')->with('success', 'Deskripsi CPL berhasil diperbarui.');
    }
}
