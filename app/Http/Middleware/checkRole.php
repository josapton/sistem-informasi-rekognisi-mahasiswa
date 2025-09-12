<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles  // Menerima satu atau lebih role sebagai argumen
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum, arahkan ke halaman login
            return redirect()->route('login');
        }

        // 2. Dapatkan data pengguna yang sedang login
        $user = Auth::user();

        // 3. Loop melalui role yang diizinkan yang dikirim dari route
        foreach ($roles as $role) {
            // Jika role pengguna cocok dengan salah satu role yang diizinkan, lanjutkan request
            if ($user->role == $role) {
                return $next($request);
            }
        }
        
        // 4. Jika role tidak cocok, kembalikan ke halaman sebelumnya dengan pesan error
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
        
        // Alternatif: Tampilkan halaman 403 Forbidden
        // abort(403, 'UNAUTHORIZED ACTION.');
    }
}
