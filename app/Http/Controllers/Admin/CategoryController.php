<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar semua kategori
    public function index()
    {
        $categories = Category::all();
        return view('admin.kategori', compact('categories'));
    }

    // Menyimpan kategori baru yang ditambahkan Admin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:masuk,keluar',
        ]);

        Category::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Mengupdate kategori yang sudah ada
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:masuk,keluar',
        ]);

        $category->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil diubah');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}