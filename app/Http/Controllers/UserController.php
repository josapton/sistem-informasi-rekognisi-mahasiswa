<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use App\Models\Cpl;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;

use App\Exports\UsersExport;
use Illuminate\Support\Facades\Auth;
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
            'admin' => Admin::orderBy('username', 'asc')->get(),
            'user' => User::where('role', 'Admin')->orderBy('username', 'asc')->get(),
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
            'kaprodi' => Kaprodi::orderBy('username', 'asc')->get(),
            'user' => User::where('role', 'Kaprodi')->orderBy('username', 'asc')->get(),
        );
        return view('admin.users.kaprodi', $data);
    }
    public function mahasiswa()
    {
        $user = Auth::user();
        if ($user->role=='Admin') {
                $data = array(
                'title' => 'Data Mahasiswa',
                'menuAdminUsers' => 'active',
                'menuAdminUsersMahasiswa' => 'active',
                'menuAdminUsersCollapse' => request('menuAdminUsersMahasiswa', 'active') ? 'show' : 'hide',
                'mahasiswa' => Mahasiswa::orderBy('username', 'asc')->get(),
                'mahasiswaWithCpl' => Mahasiswa::with('cpls')->get(),
                'user' => User::where('role', 'Mahasiswa')->orderBy('username', 'asc')->get(),
            );
            return view('admin.users.mahasiswa', $data);
        } else {
            $data = array(
                'title' => 'Data Mahasiswa',
                'menuKaprodiUsersMahasiswa' => 'active',
                'mahasiswa' => Mahasiswa::orderBy('username', 'asc')->get(),
                'mahasiswaWithCpl' => Mahasiswa::with('cpls')->get(),
                'user' => User::where('role', 'Mahasiswa')->orderBy('username', 'asc')->get(),
            );
            return view('kaprodi.users.mahasiswa', $data);
        }
    }
    public function create()
    {
        $data = array(
            'title' => 'Tambah Data User',
            'menuAdminUsers' => 'active',
            'menuAdminUsersAll' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersAll', 'active') ? 'show' : 'hide',
        );
        return view('admin.users.create', $data);
    }
    public function store(Request $request){
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'nama' => 'string|max:255|nullable',
            'email' => 'string|email|max:255|nullable',
            'role' => 'required|string|in:Admin,Kaprodi,Mahasiswa',
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

        if ($request->filled('nama')) {
            switch ($request->role) {
            case 'Admin':
                \DB::table('admins')->insert([
                'username' => $user->username,
                'nama' => $request->nama,
                ]);
                break;
            case 'Kaprodi':
                \DB::table('kaprodis')->insert([
                'username' => $user->username,
                'nama' => $request->nama,
                'program_studi' => '-',
                ]);
                break;
            case 'Mahasiswa':
                \DB::table('mahasiswas')->insert([
                'username' => $user->username,
                'nama' => $request->nama,
                'sks' => 0,
                ]);
                break;
            }
        }

        return redirect()->route('users')->with('success', 'Data berhasil ditambahkan.');
    }
    public function update($id)
    {
        $data = array(
            'title' => 'Edit Data User',
            'menuAdminUsers' => 'active',
            'menuAdminUsersAll' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersAll', 'active') ? 'show' : 'hide',
            'user' => User::findOrFail($id),
        );
        return view('admin.users.update', $data);
    }
    public function updateAdmin($username)
    {
        $data = array(
            'title' => 'Edit Data Admin',
            'menuAdminUsers' => 'active',
            'menuAdminUsersAdmin' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersAdmin', 'active') ? 'show' : 'hide',
            'admin' => Admin::findOrFail($username),
        );
        return view('admin.users.updateAdmin', $data);
    }
    public function updateKaprodi($username)
    {
        $data = array(
            'title' => 'Edit Data Kaprodi',
            'menuAdminUsers' => 'active',
            'menuAdminUsersKaprodi' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersKaprodi', 'active') ? 'show' : 'hide',
            'kaprodi' => Kaprodi::findOrFail($username),
        );
        return view('admin.users.updateKaprodi', $data);
    }
    public function updateMahasiswa($username)
    {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $data = array(
            'title' => 'Edit Data Mahasiswa',
            'menuAdminUsers' => 'active',
            'menuAdminUsersMahasiswa' => 'active',
            'menuAdminUsersCollapse' => request('menuAdminUsersMahasiswa', 'active') ? 'show' : 'hide',
            'mahasiswa' => Mahasiswa::findOrFail($username),
            'data_cpl' => Cpl::orderBy('kode_cpl')->get(),
        );
        return view('admin.users.updateMahasiswa', $data);
        } elseif ($user->role == 'Kaprodi') {
            $data = array(
            'title' => 'Edit Data Mahasiswa',
            'menuKaprodiUsersMahasiswa' => 'active',
            'menuKaprodiUsersCollapse' => request('menuKaprodiUsersMahasiswa', 'active') ? 'show' : 'hide',
            'mahasiswa' => Mahasiswa::findOrFail($username),
            'data_cpl' => Cpl::orderBy('kode_cpl')->get(),
        );
        return view('kaprodi.users.updateMahasiswa', $data);
        } else {
            $data = array(
            'title' => 'Edit Data Mahasiswa',
            'mahasiswa' => Mahasiswa::findOrFail($username),
            'data_cpl' => Cpl::orderBy('kode_cpl')->get(),
        );
        return view('mahasiswa.users.updateMahasiswa', $data);
        }
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
    public function updateAdmin2(Request $request, $username){
        $request->validate([
            'nama' => 'string|max:255|nullable',
        ],[
            'nama.string' => 'Nama harus berupa string',
            'nama.max' => 'Nama maksimal 255 karakter',
        ]);

        $admin = Admin::findOrFail($username);
        $admin->nama = $request->nama;
        $admin->save();

        return redirect()->route('usersAdmin')->with('success', 'Data berhasil diubah.');
    }
    public function updateKaprodi2(Request $request, $username){
        $request->validate([
            'nama' => 'string|max:255|nullable',
            'program_studi' => 'string|max:255|nullable',
        ],[
            'nama.string' => 'Nama harus berupa string',
            'nama.max' => 'Nama maksimal 255 karakter',
            'program_studi.string' => 'Program Studi harus berupa string',
            'program_studi.max' => 'Program Studi maksimal 255 karakter',
        ]);

        $kaprodi = Kaprodi::findOrFail($username);
        $kaprodi->nama = $request->nama;
        $kaprodi->program_studi = $request->program_studi;
        $kaprodi->save();

        return redirect()->route('usersKaprodi')->with('success', 'Data berhasil diubah.');
    }
    public function updateMahasiswa2(Request $request, $username){
        $request->validate([
            'nama' => 'string|max:255|nullable',
            'cpl' => 'array',
            'cpl.*' => 'exists:cpls,kode_cpl',
            'sks' => 'required|decimal:0,2',
        ],[
            'nama.string' => 'Nama harus berupa string',
            'nama.max' => 'Nama maksimal 255 karakter',
            'cpl.*.exists' => 'CPL tidak valid',
            'sks' => 'SKS harus berupa angka. Untuk desimal gunakan titik (.)',
            'sks.required' => 'SKS tidak boleh kosong', 
        ]);

        $mahasiswa = Mahasiswa::findOrFail($username);
        $mahasiswa->nama = $request->nama;
        $mahasiswa->cpls()->sync($request->cpl);
        $mahasiswa->sks = $request->sks;
        $mahasiswa->save();

        return redirect()->route('usersMahasiswa')->with('success', 'Data berhasil diubah.');
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
