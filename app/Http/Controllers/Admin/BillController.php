<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('client')->latest()->paginate(10);
        return view('admin.bills.index', compact('bills'));
    }

    // HAPUS METHOD autocompleteClientName() KARENA TIDAK DIPERLUKAN LAGI
    // public function autocompleteClientName(Request $request)
    // {
    //     // ... (kode autocomplete sebelumnya) ...
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // AMBIL SEMUA DATA KLIEN DARI DATABASE
        $clients = Client::all();
        // KIRIM DATA $clients KE VIEW 'admin.bills.create'
        return view('admin.bills.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'payment_status' => 'required|in:Unpaid,Paid,Pending',
            // 'subscribe_type' => 'required|in:Bulanan,Tahunan', // HAPUS validasi subscribe_type
            'amount' => 'required|numeric|min:0',
        ]);

        $client = Client::findOrFail($request->client_id);

        $bill = new Bill();
        $bill->no_invoice = Bill::generateNoInvoice();
        $bill->client()->associate($client);
        // $bill->subscribe_type = $request->subscribe_type; // HAPUS set subscribe_type
        $bill->payment_status = $request->payment_status;
        $bill->amount = Bill::calculateAmount($client); // KIRIM OBJEK CLIENT ke calculateAmount()
        $bill->save();

        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        $bill->load('client');
        return view('admin.bills.show', compact('bill'));
    }

    public function downloadPdf(Bill $bill)
    {
        $pdf = PDF::loadView('admin.bills.pdf-template', compact('bill'))->setPaper('a4', 'landscape');
        return $pdf->download('invoice-' . $bill->no_invoice . '.pdf');
    }

    /**
     * Send invoice via email.
     */
    public function sendEmail(Bill $bill)
    {
        Mail::to($bill->client->email)->send(new InvoiceMail($bill));
        return redirect()->route('admin.bills.show', $bill->id)->with('success', 'Invoice berhasil dikirim ke email client.');
    }
    /**
     * Send invoice to client via email. public access
     */
    public function showClient(Bill $bill)
    {
        return view('client.bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        $clients = Client::all();
        return view('admin.bills.edit', compact('bill', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            // 'subscribe_type' => 'required|in:Bulanan,Tahunan', // HAPUS validasi subscribe_type dari sini
            'payment_status' => 'nullable|in:Paid,Not Paid',
        ]);

        // $validatedData['amount'] = Bill::calculateAmount($validatedData['subscribe_type']); // HAPUS hitung ulang amount berdasarkan subscribe_type di sini

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