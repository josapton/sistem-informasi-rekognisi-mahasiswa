<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data User',
            'menuAdminUsers' => 'active',
            'user' => User::orderBy('role', 'asc')->get(),
        );
        return view('admin.users.index', $data);
    }
    public function create()
    {
        $data = array(
            'title' => 'Tambah Data User',
            'menuAdminUsers' => 'active',
        );
        return view('admin.users.create', $data);
    }
    public function store(Request $request){
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'nama' => 'required|string|max:255',
            'email' => 'string|email|max:255|',
            'role' => 'required|string|in:Admin,Dosen,Mahasiswa',
            'password' => 'required|string|confirmed',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah ada',
            'nama.required' => 'Nama tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'role.required' => 'Role harus dipilih',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Password konfirmasi tidak cocok',
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users')->with('success', 'Data berhasil ditambahkan.');
    }
    public function update($id)
    {
        $data = array(
            'title' => 'Edit Data User',
            'menuAdminUsers' => 'active',
            'user' => User::findOrFail($id),
        );
        return view('admin.users.update', $data);
    }
    public function update2(Request $request, $id){
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'nama' => 'required|string|max:255',
            'email' => 'string|email|max:255|',
            'role' => 'required|string|in:Admin,Dosen,Mahasiswa',
            'password' => 'nullable|string|confirmed',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah ada',
            'nama.required' => 'Nama tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'role.required' => 'Role harus dipilih',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Password konfirmasi tidak cocok',
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users')->with('success', 'Data berhasil diubah.');
    }
}
