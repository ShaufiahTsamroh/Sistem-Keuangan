<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar semua user
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    // Simpan user baru
    public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:100',
        'email'   => 'required|email|unique:users',
        'role_id' => 'required|exists:roles,id',
    ]);

    // Password default otomatis, Admin tidak perlu input
    User::create([
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make('orgfinance123'),
        'role_id'   => $request->role_id,
        'is_active' => true,
    ]);

    return redirect('/admin/users')->with('success', 'User berhasil ditambahkan. Password default: orgfinance123');
}

    // Ubah role user
    public function ubahRole(Request $request, User $user)
    {
        $user->update(['role_id' => $request->role_id]);
        return redirect('/admin/users')->with('success', 'Role berhasil diubah');
    }

    // Nonaktifkan atau aktifkan user
    public function toggleAktif(User $user)
    {
        // Kalau aktif jadi nonaktif, kalau nonaktif jadi aktif
        $user->update(['is_active' => !$user->is_active]);
        return redirect('/admin/users')->with('success', 'Status user berhasil diubah');
    }
}