<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Menampilkan daftar semua postingan blog.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //$posts = Post::with('category')->latest()->get(); // Ambil semua data postingan, eager load relasi 'category', urutkan dari terbaru
        $posts = Post::with('category')->latest()->paginate(2); // Ambil semua data postingan, eager load relasi 'category', urutkan dari terbaru
        return view('admin.posts.index', compact('posts')); // Kirim data posts ke view 'admin.posts.index'
    }

    public function search(Request $request)
    {
        $query = $request->input('search'); // Ambil query pencarian dari request

        $posts = Post::where('title', 'like', '%' . $query . '%') // Cari postingan dengan judul yang mirip dengan query
            ->with('category')
            ->paginate(2); // Tetap gunakan pagination dengan limit 2

        return view('admin.posts.search-results', compact('posts')); // Return view yang berisi hasil pencarian
    }

    /**
     * Menampilkan form untuk membuat postingan blog baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id'); // Ambil semua kategori untuk dropdown, format name => id
        return view('admin.posts.create', compact('categories')); // Kirim data categories ke view 'admin.posts.create'
    }

    /**
     * Menyimpan postingan blog yang baru dibuat ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input form create
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'nullable|boolean', // Tambahkan validasi untuk is_published, opsional dan boolean
        ]);

        $post = new Post();
        $post->category_id = $validatedData['category_id'];
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        // Tambahkan is_published
        $post->is_published = $request->has('is_published'); // Atau $validatedData['is_published'] = $request->boolean('is_published');

        // Handle upload gambar unggulan jika ada file yang diupload
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('post_images', 'public');
            $post->featured_image_path = $imagePath;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail postingan blog tertentu.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post')); // Tampilkan view 'admin.posts.show' dengan data post
    }

    public function showBySlug($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail(); // Ambil postingan berdasarkan slug, tampilkan 404 jika tidak ketemu
        return view('admin.posts.show-detail-slug', compact('post')); // Buat view baru 'admin.posts.show-detail-slug' atau sesuaikan nama view Anda
    }

    /**
     * Menampilkan form untuk mengedit postingan blog tertentu.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id'); // Ambil semua kategori untuk dropdown, format name => id
        return view('admin.posts.edit', compact('post', 'categories')); // Kirim data post dan categories ke view 'admin.posts.edit'
    }

    /**
     * Mengupdate data postingan blog tertentu di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        // Validasi input form edit
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'nullable|boolean', // Tambahkan validasi untuk is_published, opsional dan boolean
        ]);

        $post->category_id = $validatedData['category_id'];
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        // Tambahkan update is_published
        $post->is_published = $request->has('is_published'); // Atau $validatedData['is_published'] = $request->boolean('is_published');

        // Handle update gambar unggulan jika ada file baru yang diupload
        if ($request->hasFile('featured_image')) {
            // Hapus gambar unggulan lama jika ada
            if ($post->featured_image_path) {
                Storage::disk('public')->delete($post->featured_image_path);
            }
            $imagePath = $request->file('featured_image')->store('post_images', 'public');
            $post->featured_image_path = $imagePath;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diupdate.');
    }

    /**
     * Menghapus postingan blog tertentu dari database.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        // Hapus gambar unggulan jika ada
        if ($post->featured_image_path) {
            Storage::disk('public')->delete($post->featured_image_path); // Hapus file gambar dari storage 'public'
        }

        $post->delete(); // Hapus data post dari database

        // Redirect ke halaman index postingan dengan pesan sukses
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }
}
