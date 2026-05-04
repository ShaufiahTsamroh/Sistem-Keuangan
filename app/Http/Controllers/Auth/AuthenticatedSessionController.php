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

    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = Auth::user();

    if ($user->role_id == 1) {
        return redirect('/admin/dashboard'); // ubah dari /admin ke /admin/dashboard
    } elseif ($user->role_id == 2) {
        return redirect('/bendahara/dashboard');
    } else {
        return redirect('/anggota/dashboard');
    }
}

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}