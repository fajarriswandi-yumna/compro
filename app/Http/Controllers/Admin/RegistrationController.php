<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftaran calon pelanggan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $registrations = Registration::latest()->get(); // Ambil semua data pendaftaran, urutkan dari terbaru
        return view('admin.registrations.index', compact('registrations')); // Kirim data registrations ke view 'admin.registrations.index'
    }

    /**
     * Show the form for creating a new resource. (Tidak diimplementasikan untuk pendaftaran di sisi admin)
     */
    public function create()
    {
        // Tidak diperlukan form create di admin untuk pendaftaran
        // Pendaftaran dilakukan dari frontend oleh calon pelanggan
    }

    /**
     * Store a newly created resource in storage. (Tidak diimplementasikan untuk pendaftaran di sisi admin)
     */
    public function store(Request $request)
    {
        // Tidak diperlukan store di admin untuk pendaftaran
        // Pendaftaran dilakukan dari frontend oleh calon pelanggan
    }

    /**
     * Menampilkan detail pendaftaran calon pelanggan tertentu.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\View\View
     */
    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration')); // Tampilkan view 'admin.registrations.show' dengan data registration
    }
    

    /**
     * Menampilkan form untuk mengedit pendaftaran calon pelanggan tertentu.
     * (Umumnya hanya untuk update status pembayaran)
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\View\View
     */
    public function edit(Registration $registration)
    {
        return view('admin.registrations.edit', compact('registration')); // Tampilkan view 'admin.registrations.edit' dengan data registration untuk diedit
    }

    /**
     * Mengupdate data pendaftaran calon pelanggan tertentu di database.
     * (Umumnya hanya untuk update status pembayaran)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Registration $registration)
    {
        // Validasi input form edit (hanya status pembayaran yang bisa diupdate di admin)
        $validatedData = $request->validate([
            'payment_status' => 'required|in:belum_bayar,sudah_bayar', // 'payment_status' wajib diisi dan harus salah satu dari 'belum_bayar' atau 'sudah_bayar'
        ]);

        $registration->update($validatedData); // Update data registration, hanya field 'payment_status' yang diupdate

        // Redirect ke halaman index pendaftaran dengan pesan sukses
        return redirect()->route('admin.registrations.index')->with('success', 'Status pembayaran pendaftaran berhasil diupdate.');
    }

    /**
     * Menghapus pendaftaran calon pelanggan tertentu dari database.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Registration $registration)
    {
        $registration->delete(); // Hapus data registration dari database
        return redirect()->route('admin.registrations.index')->with('success', 'Pendaftaran berhasil dihapus.'); // Redirect ke halaman index pendaftaran dengan pesan sukses
    }
}