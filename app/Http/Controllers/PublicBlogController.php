<?php

namespace App\Http\Controllers;

use App\Models\Post; // Pastikan Anda menggunakan model Post yang benar
use Illuminate\Http\Request;

class PublicBlogController extends Controller
{
    /**
     * Menampilkan daftar artikel blog untuk publik.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('is_published', true) // Hanya ambil artikel yang sudah dipublikasikan (opsional, jika ada kolom is_published)
                     ->latest() // Urutkan berdasarkan artikel terbaru
                     ->paginate(2); // Pagination, tampilkan 10 artikel per halaman (opsional)

        return view('blog.index', compact('posts')); // Kirim data artikel ke view blog.index
    }

    /**
     * Menampilkan detail artikel blog berdasarkan slug.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
                    ->where('is_published', true) // Pastikan artikel dipublikasikan (opsional, sesuai kebutuhan)
                    ->firstOrFail(); // Ambil artikel berdasarkan slug, 404 jika tidak ditemukan

        return view('blog.show', compact('post')); // Kirim data artikel ke view blog.show
    }
}