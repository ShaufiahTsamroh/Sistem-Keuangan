<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Menampilkan semua transaksi milik Bendahara
    public function index()
    {
        $data = Transaction::all();
        return view('bendahara.transaksi', compact('data'));
    }

    // Menampilkan dashboard Bendahara
    public function dashboard()
    {
        $pemasukan   = Transaction::where('type', 'masuk')->sum('amount');
        $pengeluaran = Transaction::where('type', 'keluar')->sum('amount');
        $saldo       = $pemasukan - $pengeluaran;

        return view('bendahara.dashboard', compact('pemasukan', 'pengeluaran', 'saldo'));
    }

    // Menampilkan data pemasukan
    public function pemasukan()
    {
        $data = Transaction::where('type', 'masuk')->get();
        return view('bendahara.pemasukan', compact('data'));
    }

    // Menampilkan data pengeluaran beserta kategori
    // Juga mengirim daftar kategori untuk form pengajuan
    public function pengeluaran()
    {
        $data       = Transaction::with('category')->where('type', 'keluar')->get();
        $categories = Category::where('type', 'keluar')->get();
        return view('bendahara.pengeluaran', compact('data', 'categories'));
    }

    // Menyimpan pengajuan pengeluaran baru dari Bendahara
    // Status otomatis pending karena harus menunggu persetujuan Admin
    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'amount'      => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'date'        => 'required|date',
            'description' => 'nullable|string',
        ]);

        Transaction::create([
            'user_id'     => Auth::id(),
            'type'        => 'keluar',
            'amount'      => $request->amount,
            'category_id' => $request->category_id,
            'date'        => $request->date,
            'description' => $request->description,
            'status'      => 'pending', // menunggu persetujuan Admin
        ]);

        return redirect('/bendahara/pengeluaran')->with('success', 'Pengajuan pengeluaran berhasil dikirim, menunggu persetujuan Admin');
    }

    // Menampilkan daftar kategori untuk Bendahara (hanya baca)
    public function kategori()
    {
        $data = Category::all();
        return view('bendahara.kategori', compact('data'));
    }
}