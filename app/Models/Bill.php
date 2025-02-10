<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice',
        'client_id',
        'subscribe_type',
        'payment_status',
        'amount',
    ];

    // Relationship dengan model Client (one-to-many, belongsTo)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Method untuk membuat nomor invoice otomatis (format INV-idbill)
    public static function generateNoInvoice()
    {
        $latestBill = self::latest()->first();
        $id = $latestBill ? $latestBill->id + 1 : 1;
        return 'INV-' . str_pad($id, 6, '0', STR_PAD_LEFT); // Format: INV-000001, INV-000002, dst.
    }

    // Method untuk menghitung amount berdasarkan subscribe_type
    public static function calculateAmount($subscribeType)
    {
        $monthlyPrice = 50000; // Harga bulanan Rp 50.000
        if ($subscribeType == 'Tahunan') {
            return $monthlyPrice * 12; // Harga tahunan 12 kali harga bulanan
        }
        return $monthlyPrice; // Harga bulanan jika tipe Bulanan
    }
}