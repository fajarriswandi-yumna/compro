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
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil kata kunci pencarian dari request

        $bills = Bill::latest()
            ->with('client') // Eager load relasi 'client' agar lebih efisien
            ->when($search, function ($query, $search) { // Kondisi pencarian jika $search tidak kosong
                return $query->where('no_invoice', 'like', '%' . $search . '%')
                    ->orWhere('client_id', 'like', '%' . $search . '%')
                    // Tambahkan pencarian berdasarkan nama client melalui relasi 'client'
                    ->orWhereHas('client', function ($query) use ($search) {
                        $query->where('full_name', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(3);

        return view('admin.bills.index', compact('bills'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // AMBIL SEMUA DATA KLIEN DARI DATABASE
        $clients = Client::all();

        // GENERATE NO_INVOICE OTOMATIS DI METHOD CREATE()
        $bill = new Bill(); // Buat instance Bill kosong untuk generate no_invoice
        $no_invoice = $bill->generateNoInvoice(); // Panggil method generateNoInvoice() dari model

        // KIRIM DATA $clients DAN $no_invoice KE VIEW 'admin.bills.create'
        return view('admin.bills.create', compact('clients', 'no_invoice')); // KIRIM $no_invoice KE VIEW
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'bill_date' => 'required|date', // VALIDASI bill_date
            'due_date' => 'required|date|after_or_equal:bill_date', // VALIDASI due_date dan pastikan setelah atau sama dengan bill_date
            'payment_status' => 'required|in:Paid,Not Paid',
            'amount' => 'required|numeric|min:0',
        ]);

        // 1. Buat instance Bill baru (tanpa no_invoice dulu)
        $bill = new Bill([
            'client_id' => $request->client_id,
            'bill_date' => $request->bill_date, // AMBIL bill_date DARI REQUEST
            'due_date' => $request->due_date, // AMBIL due_date DARI REQUEST
            'payment_status' => $request->payment_status,
            'amount' => $request->amount,
        ]);

        // 2. Simpan Bill ke database untuk mendapatkan ID
        $bill->save();

        // 3. Generate no_invoice dengan format "INVA-id-bill"
        $bill_id = $bill->id; // Ambil ID Bill yang baru disimpan
        // MODIFIKASI FORMAT NO_INVOICE MENGGUNAKAN sprintf()
        $no_invoice = 'INVA-' . sprintf('%04d', $bill_id);

        // 4. Update Bill dengan no_invoice yang sudah di-generate
        $bill->no_invoice = $no_invoice;
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
            'bill_date' => 'required|date', // VALIDASI bill_date
            'due_date' => 'required|date|after_or_equal:bill_date', // VALIDASI due_date dan pastikan setelah atau sama dengan bill_date
            'payment_status' => 'nullable|in:Paid,Not Paid',
            'amount' => 'nullable|numeric|min:0',
        ]);

        // AMBIL SEMUA DATA DARI REQUEST, TERMASUK bill_date DAN due_date
        $validatedData = $request->all();

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
