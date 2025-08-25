<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('welcome');
    }
    public function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Username/NIM/NPM tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
        ]);

        $data = array(
            'username' => $request->username,
            'password' => $request->password,
        );
        
        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->with('error', 'Username/NIM/NPM atau password salah.');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
