<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan dashboard Admin
    public function dashboard()
    {
        // Total pemasukan = jumlah semua transaksi bertipe 'masuk'
        $pemasukan   = Transaction::where('type', 'masuk')->sum('amount');

        // Total pengeluaran = jumlah semua transaksi bertipe 'keluar'
        $pengeluaran = Transaction::where('type', 'keluar')->sum('amount');

        // Saldo = pemasukan dikurangi pengeluaran
        $saldo       = $pemasukan - $pengeluaran;

        // Menghitung transaksi yang masih pending
        $pending     = Transaction::where('status', 'pending')->count();

        return view('admin.dashboard', compact('pemasukan', 'pengeluaran', 'saldo', 'pending'));
    }

    // Menampilkan semua log aktivitas pengguna
    public function activityLog()
    {
        $logs = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.activity_log', compact('logs'));
    }
}