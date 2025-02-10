<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Tambahkan use Carbon

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'school_name',
        'payment_package',
        'payment_status',
        'invoice_number', // Tambahkan invoice_number ke fillable
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($registration) { // Ubah event menjadi 'created'
            $registration->invoice_number = 'INV' . $registration->id; // Format invoice: INV + registration ID
            $registration->save(); // Simpan kembali model untuk mengupdate invoice_number
        });
    }
}
