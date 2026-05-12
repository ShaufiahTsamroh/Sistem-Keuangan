<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\AnggotaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // ============================================================
    // PROFILE
    // ============================================================
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // ============================================================
    // BENDAHARA
    // ============================================================
    Route::get('/bendahara',             [TransactionController::class, 'dashboard']);
    Route::get('/bendahara/dashboard',   [TransactionController::class, 'dashboard']);
    Route::get('/bendahara/transaksi',   [TransactionController::class, 'index']);
    Route::get('/bendahara/pemasukan',   [TransactionController::class, 'pemasukan']);
    Route::get('/bendahara/pengeluaran', [TransactionController::class, 'pengeluaran']);
    Route::get('/bendahara/kategori',    [TransactionController::class, 'kategori']);
    Route::get('/bendahara/reimburse',   [ReimbursementController::class, 'review']);
    Route::get('/reimburse',             [ReimbursementController::class, 'index']);
    Route::get('/reimburse/create',      [ReimbursementController::class, 'create']);
    Route::post('/reimburse',            [ReimbursementController::class, 'store']);
    Route::get('/approve/{id}',          [ReimbursementController::class, 'approve']);
    Route::get('/reject/{id}',           [ReimbursementController::class, 'reject']);
    
    Route::post('/bendahara/pengeluaran', [TransactionController::class, 'storePengeluaran']); // POST /bendahara/pengeluaran → Bendahara ajukan pengeluaran baru (status pending)
    // ============================================================
    // ANGGOTA
    // ============================================================
    // Redirect /anggota ke /anggota/dashboard
    // GET /anggota/dashboard   → halaman utama anggota
    // GET /anggota/transaksi   → daftar transaksi (hanya baca)
    // GET /anggota/pemasukan   → daftar pemasukan (hanya baca)
    // GET /anggota/pengeluaran → daftar pengeluaran (hanya baca)
    Route::prefix('anggota')->group(function () {
        Route::get('/',            fn() => redirect('/anggota/dashboard'));
        Route::get('/dashboard',   [AnggotaController::class, 'dashboard']);
        Route::get('/transaksi',   [AnggotaController::class, 'transaksi']);
        Route::get('/pemasukan',   [AnggotaController::class, 'pemasukan']);
        Route::get('/pengeluaran', [AnggotaController::class, 'pengeluaran']);
    });

    // ============================================================
    // ADMIN
    // ============================================================
    Route::prefix('admin')->group(function () {

        // Redirect /admin ke /admin/dashboard
        Route::get('/', fn() => redirect('/admin/dashboard'));

        // GET /admin/dashboard → halaman utama admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Route manajemen user Admin
        // GET    /admin/users               → tampilkan daftar user
        // POST   /admin/users               → tambah user baru
        // PATCH  /admin/users/{user}/role   → ubah role user
        // PATCH  /admin/users/{user}/toggle → nonaktifkan/aktifkan user
        Route::get('/users',                 [UserController::class, 'index']);
        Route::post('/users',                [UserController::class, 'store']);
        Route::patch('/users/{user}/role',   [UserController::class, 'ubahRole']);
        Route::patch('/users/{user}/toggle', [UserController::class, 'toggleAktif']);

        // Route kategori Admin
        // GET    /admin/kategori            → tampilkan daftar kategori
        // POST   /admin/kategori            → simpan kategori baru
        // PATCH  /admin/kategori/{category} → update kategori
        // DELETE /admin/kategori/{category} → hapus kategori
        Route::get('/kategori',               [CategoryController::class, 'index']);
        Route::post('/kategori',              [CategoryController::class, 'store']);
        Route::patch('/kategori/{category}',  [CategoryController::class, 'update']);
        Route::delete('/kategori/{category}', [CategoryController::class, 'destroy']);

        // Route transaksi Admin
        // GET    /admin/transaksi                       → tampilkan semua transaksi
        // POST   /admin/transaksi                       → tambah transaksi baru
        // PATCH  /admin/transaksi/{transaction}/approve → setujui transaksi pending
        // PATCH  /admin/transaksi/{transaction}/reject  → tolak transaksi pending
        // DELETE /admin/transaksi/{transaction}         → hapus transaksi
        Route::get('/transaksi',                             [AdminTransactionController::class, 'index']);
        Route::post('/transaksi',                            [AdminTransactionController::class, 'store']);
        Route::patch('/transaksi/{transaction}/approve',     [AdminTransactionController::class, 'approve']);
        Route::patch('/transaksi/{transaction}/reject',      [AdminTransactionController::class, 'reject']);
        Route::delete('/transaksi/{transaction}',            [AdminTransactionController::class, 'destroy']);

        // Route pemasukan Admin
        // GET /admin/pemasukan → tampilkan semua data pemasukan
        Route::get('/pemasukan',  [AdminTransactionController::class, 'pemasukan']);

        // Route pengeluaran Admin
        // GET /admin/pengeluaran → tampilkan semua data pengeluaran
        Route::get('/pengeluaran', [AdminTransactionController::class, 'pengeluaran']);

        // Route activity log Admin
// GET /admin/activity-log → tampilkan semua log aktivitas
Route::get('/activity-log', [AdminController::class, 'activityLog']);

    });

});

require __DIR__.'/auth.php';