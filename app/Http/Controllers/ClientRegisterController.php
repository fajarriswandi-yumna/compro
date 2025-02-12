<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Mail\VerifyClientEmail;

class ClientRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.client_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'no_phone' => 'required|string|max:20',
            'institution' => 'nullable|string|max:255',
            'subscribe_type' => 'required|in:Bulanan,Tahunan', // PASTIKAN VALIDASI INI ADA
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $clientData = $request->except('photo_profile');

        if ($request->hasFile('photo_profile')) {
            $photoPath = $request->file('photo_profile')->store('profile_photos', 'public');
            $clientData['photo_profile'] = $photoPath;
        }

        $verification_token = Str::random(60);
        $clientData['email_verification_token'] = $verification_token;
        $clientData['password'] = Hash::make(Str::random(16));

        // dd($clientData);

        $client = Client::create($clientData); // Data client (termasuk subscribe_type) disimpan ke tabel clients

        // Kirim email verifikasi
        Mail::to($request->email)->send(new VerificationMail($client, $verification_token));

        return redirect()->route('client.registration.pending')->with('success', 'Pendaftaran berhasil! Silakan periksa email Anda untuk verifikasi akun.');
    }

    public function showRegistrationPending()
    {
        return view('auth.registration_pending'); // <-- Pastikan path view benar: 'auth.registration_pending'
    }

    public function verify(Request $request, $token)
    {
        $client = Client::where('email_verification_token', $token)->first();

        if (!$client) {
            return redirect()->route('client.registration.form')->with('error', 'Token verifikasi tidak valid atau sudah kadaluarsa.'); // <-- PERIKSA NAMA ROUTE DI SINI: 'client.registration.form'
        }

        if ($client->is_active) {
            return redirect()->route('client.registration.form')->with('info', 'Akun Anda sudah aktif. Silakan login.'); // <-- PERIKSA NAMA ROUTE DI SINI: 'client.registration.form'
        }

        $client->update([
            'is_active' => true,
            'email_verified_at' => now(),
            'email_verification_token' => null, // Hapus token setelah verifikasi
        ]);

        // Perbaikan: Pass data 'clientName' ke view account-activated
        return view('client.auth.account-activated', ['clientName' => $client->full_name]); // <-- TAMBAHKAN BARIS INI: Pass data clientName ke view
    }
}