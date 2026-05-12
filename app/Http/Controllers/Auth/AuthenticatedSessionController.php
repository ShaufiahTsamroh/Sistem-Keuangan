<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View|RedirectResponse
{
    if (Auth::check()) { //utk cek sudh pernh login atau tdk
        $user = Auth::user(); //Ambil data user yang sedang login sekarang (nama, email, role_id, dll).
        
        if ($user->role_id == 1) { //Cek role_id-nya. Kalau 1 = Admin, langsung arahkan ke dashboard admin.
            return redirect('/admin/dashboard'); // utk pindahkan browser ke halaman /admin/dashboard
        } elseif ($user->role_id == 2) { // kalo rolenya = 2 brrti dia bendahara, arahin ke dashboard bndahra
            return redirect('/bendahara/dashboard');
        } else {
            return redirect('/anggota/dashboard');//selain role 1,2 brrti dia anggota
        }
    }

    return view('auth.login'); //klo user blm login,tmpilin hlman login
}

    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = Auth::user(); //ambil data user yang baru saja berhasil login.

    if ($user->role_id == 1) {
        return redirect('/admin/dashboard'); // ke admin/dashboard
    } elseif ($user->role_id == 2) {
        return redirect('/bendahara/dashboard');
    } else {
        return redirect('/anggota/dashboard');
    }
}

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); //Perintah logout — hapus data sesi login user dari sistem. 'web' adalah nama guard default Laravel.

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}