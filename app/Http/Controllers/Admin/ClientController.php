<?php

namespace App\Http\Controllers\Admin;  // Namespace sekarang adalah App\Http\Controllers\Admin

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\PhoneNumber;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Tambahkan parameter Request $request
    {
        $search = $request->input('search'); // Ambil kata kunci pencarian dari request

        $clients = Client::latest()
            ->when($search, function ($query, $search) { // Kondisi pencarian jika $search tidak kosong
                return $query->where('full_name', 'like', '%' . $search . '%') // Cari di kolom full_name
                    ->orWhere('email', 'like', '%' . $search . '%')    // Atau di kolom email
                    ->orWhere('no_phone', 'like', '%' . $search . '%'); // Atau di kolom no_phone
            })
            ->paginate(5);

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('clients', 'email'), // Validasi email unik di tabel clients
            ],
            'no_phone' => ['required', 'string', 'max:20', 'phone:ID'], // Validasi nomor telepon Indonesia
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'institution' => 'nullable|string|max:255',
            'subscribe_type' => 'required|in:Bulanan,Tahunan',
            'subscribe_status' => 'required|in:Aktif,Non Aktif',
            'subscription_start_date' => 'nullable|date',
            'subscription_end_date' => 'nullable|date|after_or_equal:subscription_start_date', // End date harus setelah atau sama dengan start date
        ]);

        $clientData = $validatedData;

        // Handle upload foto profil jika ada
        if ($request->hasFile('photo_profile')) {
            $photoPath = $request->file('photo_profile')->store('client_photos', 'public');
            $clientData['photo_profile'] = $photoPath;
        }

        Client::create($clientData);

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil ditambahkan.'); // Perhatikan perubahan route name
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('clients', 'email')->ignore($client->id), // Ignore email unik untuk client yang sedang diedit
            ],
            'no_phone' => ['required', 'string', 'max:20', 'phone:ID'], // Validasi nomor telepon Indonesia
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'institution' => 'nullable|string|max:255',
            'subscribe_type' => 'required|in:Bulanan,Tahunan',
            'subscribe_status' => 'required|in:Aktif,Non Aktif',
            'subscription_start_date' => 'nullable|date',
            'subscription_end_date' => 'nullable|date|after_or_equal:subscription_start_date', // End date harus setelah atau sama dengan start date
        ]);

        $clientData = $validatedData;

        // Handle update foto profil jika ada file baru diupload
        if ($request->hasFile('photo_profile')) {
            // Hapus foto profil lama jika ada
            if ($client->photo_profile) {
                Storage::disk('public')->delete($client->photo_profile);
            }
            $photoPath = $request->file('photo_profile')->store('client_photos', 'public');
            $clientData['photo_profile'] = $photoPath;
        }

        $client->update($clientData);

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil diperbarui.'); // Perhatikan perubahan route name
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Hapus foto profil jika ada
        if ($client->photo_profile) {
            Storage::disk('public')->delete($client->photo_profile);
        }

        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil dihapus.'); // Perhatikan perubahan route name
    }
}
