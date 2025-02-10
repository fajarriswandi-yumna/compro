<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF; // Import Facade PDF
use Illuminate\Support\Facades\Mail; // Import Facade Mail
use App\Mail\InvoiceMail; // Import Mail Class InvoiceMail


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

    public function downloadPdf(Bill $bill) // Route model binding untuk Bill $bill
    {
        // $pdf = PDF::loadView('admin.bills.pdf-template', compact('bill')); // Load view default size PDF
        $pdf = PDF::loadView('admin.bills.pdf-template', compact('bill'))->setPaper('a4', 'landscape'); // Load view dengan ukuran kertas A4 landscape

        // Opsi download: inline (tampilkan di browser) atau attachment (download file)
        // return $pdf->stream('invoice-' . $bill->no_invoice . '.pdf'); // Inline di browser
        return $pdf->download('invoice-' . $bill->no_invoice . '.pdf'); // Download file
    }

    /**
     * Send invoice via email.
     */
    public function sendEmail(Bill $bill)
    {
        Mail::to($bill->client->email)->send(new InvoiceMail($bill)); // Kirim email menggunakan Mail Facade dan Mail Class

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
