<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache; 

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data User',
            'menuAdminUsers' => 'active',
            'menuAdminUsersAll' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersAll', 'active') ? 'show' : 'hide',
            'user' => User::orderBy('role', 'asc')->get(),
        );
        return view('admin.users.index', $data);
    }
    public function admin()
    {
        $data = array(
            'title' => 'Data Admin',
            'menuAdminUsers' => 'active',
            'menuAdminUsersAdmin' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersAdmin', 'active') ? 'show' : 'hide',
            'user' => User::orderBy('role', 'asc')->get(),
        );
        return view('admin.users.admin', $data);
    }
    public function kaprodi()
    {
        $data = array(
            'title' => 'Data Kaprodi',
            'menuAdminUsers' => 'active',
            'menuAdminUsersKaprodi' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersKaprodi', 'active') ? 'show' : 'hide',
            'user' => User::orderBy('role', 'asc')->get(),
        );
        return view('admin.users.kaprodi', $data);
    }
    public function mahasiswa()
    {
        $data = array(
            'title' => 'Data Mahasiswa',
            'menuAdminUsers' => 'active',
            'menuAdminUsersMahasiswa' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersMahasiswa', 'active') ? 'show' : 'hide',
            'user' => User::orderBy('role', 'asc')->get(),
        );
        return view('admin.users.mahasiswa', $data);
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
            'email' => 'string|email|max:255|',
            'role' => 'required|string|in:Admin,Dosen,Mahasiswa',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah ada',
            'email.email' => 'Format email tidak valid',
            'role.required' => 'Role harus dipilih',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter',
            'password.confirmed' => 'Password konfirmasi tidak cocok',
        ]);

        $user = new User;
        $user->username = $request->username;
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
            'email' => 'string|email|max:255|',
            'role' => 'required|string|in:Admin,Dosen,Mahasiswa',
            'password' => 'nullable|string|min:8|confirmed',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah ada',
            'email.email' => 'Format email tidak valid',
            'role.required' => 'Role harus dipilih',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter',
            'password.confirmed' => 'Password konfirmasi tidak cocok',
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users')->with('success', 'Data berhasil diubah.');
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'Data berhasil dihapus.');
    }
    public function excel(){
        $filename = now()->format('Y-m-d_His') . '_DataUsers.xlsx';
        return Excel::download(new UsersExport, $filename);
    }
    public function pdf(){
        $filename = now()->format('Y-m-d_His') . '_DataUsers.pdf';
        $data = array(
            'title' => 'Laporan Data Users',
            'users' => User::get(),
            'date' => now()->format('Y-m-d'),
            'jam' => now()->format('H:i:s'),
        );
        $pdf = Pdf::loadView('admin.users.pdf', $data);
        return $pdf->setPaper('a4', 'portrait')->stream($filename);
    }
}
