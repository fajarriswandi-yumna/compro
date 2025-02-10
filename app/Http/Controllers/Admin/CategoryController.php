<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all(); // Ambil semua data kategori dari database
        return view('admin.categories.index', compact('categories')); // Kirim data categories ke view 'admin.categories.index'
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create'); // Tampilkan view 'admin.categories.create' untuk form create
    }

    /**
     * Menyimpan kategori yang baru dibuat ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input form create
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories,name|max:255', // Field 'name' wajib diisi, string, unik di tabel 'categories', maks 255 karakter
        ]);

        Category::create($validatedData); // Buat data kategori baru menggunakan mass assignment dari data validasi

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kategori tertentu.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category')); // Tampilkan view 'admin.categories.show' dengan data kategori
    }

    /**
     * Menampilkan form untuk mengedit kategori tertentu.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category')); // Tampilkan view 'admin.categories.edit' dengan data kategori untuk diedit
    }

    /**
     * Mengupdate data kategori tertentu di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input form edit
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('categories', 'name')->ignore($category->id)], // Validasi 'name' wajib, string, maks 255, unik di tabel 'categories' kecuali untuk kategori yang sedang diupdate
        ]);

        $category->update($validatedData); // Update data kategori menggunakan mass assignment dari data validasi

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    /**
     * Menghapus kategori tertentu dari database.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete(); // Hapus data kategori dari database
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.'); // Redirect ke halaman index kategori dengan pesan sukses
    }
}