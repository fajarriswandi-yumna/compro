<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest; // Import Request Form ProfileUpdateRequest
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan form untuk edit profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [ // View Blade untuk form edit profil
            'user' => $request->user(), // Mengirim data user yang sedang login ke view
        ]);
    }

    /**
     * Update informasi profil pengguna.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse // Menggunakan Request Form ProfileUpdateRequest untuk validasi
    {
        $user = $request->user(); // Ambil user yang sedang login
        $user->fill($request->validated()); // Fill data user dengan data yang sudah divalidasi dari form

        if ($request->hasFile('profile_image')) { // Handle upload gambar profile jika ada
            if ($user->profile_image_path) { // Hapus gambar profile lama jika ada
                Storage::disk('public')->delete($user->profile_image_path);
            }
            $imagePath = $request->file('profile_image')->store('profile_images', 'public'); // Simpan gambar baru
            $user->profile_image_path = $imagePath; // Update path gambar di database
        }


        if ($user->isDirty('email')) { // Jika email diubah, perlu verifikasi email
            $user->email_verified_at = null;
        }

        $user->save(); // Simpan perubahan data user

        return Redirect::route('profile.edit')->with('success', 'Profil berhasil diperbarui.'); // Redirect kembali ke halaman edit profil dengan pesan sukses
    }

    /**
     * Update password pengguna.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([ // Validasi untuk update password
            'current_password' => ['required', 'current_password'], // Validasi password saat ini
            'password' => ['required', 'confirmed', 'min:8'], // Validasi password baru (wajib, confirmed, minimal 8 karakter)
        ]);

        $user = $request->user(); // Ambil user yang sedang login
        $user->password = Hash::make($validatedData['password']); // Hash dan update password baru
        $user->save(); // Simpan perubahan password

        return Redirect::route('profile.edit')->with('success', 'Password berhasil diperbarui.'); // Redirect kembali ke halaman edit profil dengan pesan sukses
    }

    /**
     * Hapus akun pengguna (opsional, bisa ditambahkan nanti).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}