<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice',
        'client_id',
        'payment_status',
        'amount',
        'bill_date',
        'due_date',
    ];

    // Relationship dengan model Client (one-to-many, belongsTo)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // TAMBAHKAN METHOD generateNoInvoice() DI MODEL Bill.php
    public static function generateNoInvoice()
    {
        $prefix = 'INVA';
        $billCount = Bill::count(); // Ambil jumlah total bill yang sudah ada
        $nextId = $billCount + 1; // ID selanjutnya adalah jumlah bill + 1
        // SUFFIX '-bill' DIHAPUS DARI SINI
        // $suffix = 'bill';
    
        // MODIFIKASI FORMAT NO_INVOICE MENGGUNAKAN sprintf() DI SINI (OPSIONAL, BISA JUGA DI CONTROLLER)
        // return $prefix . '-' . $nextId . '-' . $suffix; // Format awal: INVA-id-bill
        return $prefix . '-' . sprintf('%04d', $nextId); // Format baru: INVA-0001 (TANPA SUFFIX '-bill', FORMAT 4 DIGIT)
    }

    // Method untuk menghitung amount berdasarkan subscribe_type (DIUPDATE untuk mengambil dari Client)
    public static function calculateAmount(Client $client) // Menerima objek Client sebagai parameter
    {
        $monthlyPrice = 50000; // Harga bulanan Rp 50.000
        if ($client->subscribe_type == 'Tahunan') { // Mengakses subscribe_type dari relasi Client
            return $monthlyPrice * 12; // Harga tahunan 12 kali harga bulanan
        }
        return $monthlyPrice; // Harga bulanan jika tipe Bulanan
    }

    // TAMBAHKAN METHOD generateNoInvoice() DI MODEL Bill.php
    // Method generateNoInvoice sudah ada di atas, tidak perlu ditambahkan lagi.
}
