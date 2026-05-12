<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Menampilkan semua transaksi dari seluruh user
    public function index()
    {
        $transactions = Transaction::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::all();
        $users      = User::all();

        return view('admin.transaksi', compact('transactions', 'categories', 'users'));
    }

    // Menyimpan transaksi baru — Admin tambah langsung selesai
    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'type'        => 'required|in:masuk,keluar',
            'amount'      => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'date'        => 'required|date',
        ]);

        Transaction::create([
            'user_id'     => $request->user_id,
            'type'        => $request->type,
            'amount'      => $request->amount,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'date'        => $request->date,
            'status'      => 'selesai',
        ]);

        // Catat aktivitas
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'activity' => 'Admin menambah transaksi baru senilai Rp ' . number_format($request->amount, 0, ',', '.'),
        ]);

        return redirect('/admin/transaksi')->with('success', 'Transaksi berhasil ditambahkan');
    }

    // Admin menyetujui transaksi yang masih pending
    public function approve(Transaction $transaction)
    {
        $transaction->update(['status' => 'selesai']);

        // Catat aktivitas
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'activity' => 'Admin menyetujui transaksi ID ' . $transaction->id . ' senilai Rp ' . number_format($transaction->amount, 0, ',', '.'),
        ]);

        return redirect('/admin/transaksi')->with('success', 'Transaksi berhasil disetujui');
    }

    // Admin menolak transaksi yang masih pending
    public function reject(Transaction $transaction)
    {
        $transaction->update(['status' => 'ditolak']);

        // Catat aktivitas
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'activity' => 'Admin menolak transaksi ID ' . $transaction->id,
        ]);

        return redirect('/admin/transaksi')->with('success', 'Transaksi berhasil ditolak');
    }

    // Admin menghapus transaksi
    public function destroy(Transaction $transaction)
    {
        // Catat aktivitas sebelum dihapus
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'activity' => 'Admin menghapus transaksi ID ' . $transaction->id . ' senilai Rp ' . number_format($transaction->amount, 0, ',', '.'),
        ]);

        $transaction->delete();
        return redirect('/admin/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }

    // Menampilkan semua transaksi bertipe masuk (pemasukan)
    public function pemasukan()
    {
        $transactions = Transaction::with(['user', 'category'])
            ->where('type', 'masuk')
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::where('type', 'masuk')->get();
        $users      = User::all();

        return view('admin.pemasukan', compact('transactions', 'categories', 'users'));
    }

    // Menampilkan semua transaksi bertipe keluar (pengeluaran)
    public function pengeluaran()
    {
        $transactions = Transaction::with(['user', 'category'])
            ->where('type', 'keluar')
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::where('type', 'keluar')->get();
        $users      = User::all();

        return view('admin.pengeluaran', compact('transactions', 'categories', 'users'));
    }
}