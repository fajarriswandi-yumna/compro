<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $users = User::where('role', 'admin')->get(); // Ambil semua user dengan role 'admin'
        $users = User::where('role', 'admin')
            ->orWhere('role', 'user')
            ->get();
        return view('admin.users.index', compact('users')); // Kirim data users ke view 'admin.users.index'
    }

    /**
     * Menampilkan form untuk membuat user admin baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create'); // Tampilkan view 'admin.users.create' untuk form create
    }

    /**
     * Menyimpan user admin yang baru dibuat ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input dari form create
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Email harus unik di tabel 'users'
            'password' => 'required|min:8|confirmed', // Password harus diisi, minimal 8 karakter, dan 'confirmed' (harus sama dengan field password_confirmation)
            'role' => 'required|in:admin,user', // **Validasi Role: Wajib diisi, hanya boleh 'admin' atau 'user'**
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar (opsional, tipe image, ukuran maks 2MB)
        ]);

        // Buat instance User model baru
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // Hash password sebelum disimpan
        $user->role = $validatedData['role']; // **Set Role dari input form**

        // Handle upload gambar profile jika ada file yang diupload
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public'); // Simpan gambar di storage/app/public/profile_images, disk 'public'
            $user->profile_image_path = $imagePath; // Simpan path gambar ke kolom 'profile_image_path' di database
        }

        $user->save(); // Simpan data user ke database

        // Redirect ke halaman index user admin dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User admin berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail user admin tertentu.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user')); // Tampilkan view 'admin.users.show' dengan data user
    }

    /**
     * Menampilkan form untuk mengedit user admin tertentu.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user')); // Tampilkan view 'admin.users.edit' dengan data user untuk diedit
    }

    /**
     * Mengupdate data user admin tertentu di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // Validasi input form edit
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)], // Email harus unik, kecuali untuk user yang sedang diupdate
            'password' => 'nullable|min:8|confirmed', // Password opsional saat update, jika diisi harus min 8 char dan confirmed
            'role' => 'required|in:admin,user', // **Validasi Role: Wajib diisi, hanya boleh 'admin' atau 'user'**
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar (opsional, tipe image, ukuran maks 2MB)
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role']; // **Update Role dari input form**

        // Update password hanya jika field password diisi di form
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']); // Hash password baru
        }

        // Handle update gambar profile jika ada file baru yang diupload
        if ($request->hasFile('profile_image')) {
            // Hapus gambar profile lama jika ada
            if ($user->profile_image_path) {
                Storage::disk('public')->delete($user->profile_image_path); // Hapus file gambar dari storage 'public'
            }
            $imagePath = $request->file('profile_image')->store('profile_images', 'public'); // Simpan gambar baru
            $user->profile_image_path = $imagePath; // Update path gambar di database
        }

        $user->save(); // Simpan perubahan data user ke database

        // Redirect ke halaman index user admin dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User admin berhasil diupdate.');
    }

    /**
     * Menghapus user admin tertentu dari database.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Hapus gambar profile jika ada
        if ($user->profile_image_path) {
            Storage::disk('public')->delete($user->profile_image_path); // Hapus file gambar dari storage 'public'
        }

        $user->delete(); // Hapus data user dari database

        // Redirect ke halaman index user admin dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User admin berhasil dihapus.');
    }
}