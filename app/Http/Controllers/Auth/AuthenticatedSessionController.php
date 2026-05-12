<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // Cek apakah user sudah login, kalau sudah redirect ke dashboard sesuai role
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role_id == 1) {
                return redirect('/admin/dashboard');
            } elseif ($user->role_id == 2) {
                return redirect('/bendahara/dashboard');
            } else {
                return redirect('/anggota/dashboard');
            }
        }

        return view('auth.login');
    }

    // Proses login — autentikasi user dan catat aktivitas login
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Catat aktivitas login ke tabel activity_logs
        ActivityLog::create([
            'user_id'  => $user->id,
            'activity' => $user->name . ' login ke sistem',
        ]);

        if ($user->role_id == 1) {
            return redirect('/admin/dashboard');
        } elseif ($user->role_id == 2) {
            return redirect('/bendahara/dashboard');
        } else {
            return redirect('/anggota/dashboard');
        }
    }

    // Proses logout — catat aktivitas logout lalu hapus session
    public function destroy(Request $request): RedirectResponse
    {
        // Catat aktivitas logout sebelum session dihapus
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'activity' => Auth::user()->name . ' logout dari sistem',
        ]);

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}