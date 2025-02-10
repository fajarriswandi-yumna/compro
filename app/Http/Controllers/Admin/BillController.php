<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Client;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('client')->latest()->paginate(10); // Eager load relationship 'client'
        return view('admin.bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all(); // Ambil semua data client untuk dropdown di form
        return view('admin.bills.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id', // Pastikan client_id ada di tabel clients
            'subscribe_type' => 'required|in:Bulanan,Tahunan', // Validasi subscribe_type harus Bulanan atau Tahunan
            'payment_status' => 'nullable|in:Paid,Not Paid', // Validasi payment_status (opsional), boleh Paid atau Not Paid
        ]);

        $validatedData['no_invoice'] = Bill::generateNoInvoice(); // Generate nomor invoice otomatis
        $validatedData['amount'] = Bill::calculateAmount($validatedData['subscribe_type']); // Hitung amount berdasarkan tipe berlangganan

        Bill::create($validatedData);

        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        return view('admin.bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        $clients = Client::all(); // Ambil semua data client untuk dropdown di form edit
        return view('admin.bills.edit', compact('bill', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id', // Pastikan client_id ada di tabel clients
            'subscribe_type' => 'required|in:Bulanan,Tahunan', // Validasi subscribe_type harus Bulanan atau Tahunan
            'payment_status' => 'nullable|in:Paid,Not Paid', // Validasi payment_status (opsional), boleh Paid atau Not Paid
        ]);

        $validatedData['amount'] = Bill::calculateAmount($validatedData['subscribe_type']); // Hitung ulang amount jika subscribe_type diubah

        $bill->update($validatedData);

        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil dihapus.');
    }
}