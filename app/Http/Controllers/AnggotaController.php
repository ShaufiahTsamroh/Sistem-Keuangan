<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    // Menampilkan dashboard ringkasan keuangan untuk Anggota
    public function dashboard()
    {
        // Anggota hanya lihat ringkasan — total pemasukan dan pengeluaran
        $pemasukan   = Transaction::where('type', 'masuk')->where('status', 'selesai')->sum('amount');
        $pengeluaran = Transaction::where('type', 'keluar')->where('status', 'selesai')->sum('amount');
        $saldo       = $pemasukan - $pengeluaran;

        return view('anggota.dashboard', compact('pemasukan', 'pengeluaran', 'saldo'));
    }

    // Menampilkan daftar semua transaksi — hanya baca, tidak bisa tambah atau ubah
    public function transaksi()
    {
        $transactions = Transaction::with(['category'])
            ->where('status', 'selesai')
            ->orderBy('date', 'desc')
            ->get();

        return view('anggota.transaksi', compact('transactions'));
    }

    // Menampilkan daftar pemasukan — hanya baca
    public function pemasukan()
    {
        $transactions = Transaction::with(['category'])
            ->where('type', 'masuk')
            ->where('status', 'selesai')
            ->orderBy('date', 'desc')
            ->get();

        return view('anggota.pemasukan', compact('transactions'));
    }

    // Menampilkan daftar pengeluaran — hanya baca
    public function pengeluaran()
    {
        $transactions = Transaction::with(['category'])
            ->where('type', 'keluar')
            ->where('status', 'selesai')
            ->orderBy('date', 'desc')
            ->get();

        return view('anggota.pengeluaran', compact('transactions'));
    }
}