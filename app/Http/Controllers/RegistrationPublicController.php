<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Carbon\Carbon; // Tambahkan use Carbon

class RegistrationPublicController extends Controller
{
    // ... (method create tidak perlu diubah) ...
    public function create()
    {
        $paymentPackages = ['bulanan', 'tahunan']; // Definisikan pilihan paket pembayaran
        return view('registrations.public.create', compact('paymentPackages')); // Kirim ke view form pendaftaran
    }
    /**
     * Menyimpan data pendaftaran baru dari form publik.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data form pendaftaran
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:registrations', // Pastikan email unik di tabel registrations
            'phone_number' => [
                'required',
                'string',
                'max:20', // Sesuaikan panjang maks no. telepon
                'regex:/^(?:\+62|0)[2-9][0-9]{8,15}$/', // Validasi format nomor telepon Indonesia
            ],
            'school_name' => 'nullable|string|max:255',
            'payment_package' => 'required|in:bulanan,tahunan', // Validasi harus salah satu dari ENUM
            // 'payment_status' tidak perlu divalidasi di sini, karena default 'belum_bayar'
        ], [
            'phone_number.regex' => 'Format nomor telepon tidak valid untuk Indonesia. Contoh format yang benar: 08xxxxxxxxxx atau +628xxxxxxxxxx.', // Pesan error custom untuk validasi regex nomor telepon
        ]);

        // Buat dan simpan data pendaftaran baru
        $registration = Registration::create($validatedData); // Simpan data dan dapatkan instance Registration yang baru dibuat

        // Hitung waktu kadaluarsa pembayaran (2 menit dari sekarang)
        // $paymentDeadline = Carbon::now()->addHours(24);
        $paymentDeadline = Carbon::now()->addMinutes(2)->toIso8601String(); // Format ke ISO 8601

        // Redirect ke halaman Invoice Pembayaran, kirim data Registration dan paymentDeadline
        return redirect()->route('registration.public.invoice', ['registration' => $registration, 'paymentDeadline' => $paymentDeadline]);
    }

    /**
     * Menampilkan halaman Invoice Pembayaran.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\View\View
     */
    public function showInvoice(Registration $registration, Request $request) // Tambahkan Request $request
    {
        $nominalPembayaran = 0; // Inisialisasi nominal pembayaran
        $hargaPerBulan = 50000; // Harga dasar per bulan
        

        // Hitung nominal pembayaran berdasarkan paket yang dipilih
        if ($registration->payment_package === 'bulanan') {
            $nominalPembayaran = $hargaPerBulan; // Jika bulanan, harga tetap per bulan
        } elseif ($registration->payment_package === 'tahunan') {
            $nominalPembayaran = $hargaPerBulan * 12; // Jika tahunan, harga per bulan dikali 12
        }

        // Ambil paymentDeadline dari query string (dari redirect)
        $paymentDeadline = $request->query('paymentDeadline'); // Ambil paymentDeadline dari query string

        return view('registrations.public.invoice', compact('registration', 'nominalPembayaran', 'paymentDeadline')); // Kirim data registration, nominal, dan deadline ke view
    }
}
