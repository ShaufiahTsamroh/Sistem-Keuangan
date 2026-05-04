<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
{
    $data = \App\Models\Transaction::all();
    return view('bendahara.transaksi', compact('data'));
}
public function dashboard()
{
    $pemasukan = \App\Models\Transaction::where('type', 'masuk')->sum('amount');
    $pengeluaran = \App\Models\Transaction::where('type', 'keluar')->sum('amount');
    $saldo = $pemasukan - $pengeluaran;

    return view('bendahara.dashboard', compact('pemasukan', 'pengeluaran', 'saldo'));
}
public function pemasukan()
{
    $data = \App\Models\Transaction::where('type', 'masuk')->get();
    return view('bendahara.pemasukan', compact('data'));
}

public function pengeluaran()
{
    $data = \App\Models\Transaction::where('type', 'keluar')->get();
    return view('bendahara.pengeluaran', compact('data'));
}

public function kategori()
{
    $data = \App\Models\Category::all();
    return view('bendahara.kategori', compact('data'));
}
}
