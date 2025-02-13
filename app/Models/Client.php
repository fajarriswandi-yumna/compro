<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'clients'; // Opsional, tapi baik untuk didefinisikan

    /**
     * Atribut yang boleh diisi (fillable) untuk mass assignment.
     *
     * Daftar kolom yang diperbolehkan untuk diisi secara massal
     * menggunakan metode seperti Client::create() atau $client->update().
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'no_phone',
        'photo_profile',
        'institution',
        'subscribe_type', // Ini diperbaiki dari `subscribe_status`
        'subscribe_status',
        'subscription_start_date',
        'subscription_end_date',
        'email_verification_token', // <-- TAMBAHKAN BARIS INI: PENTING!!
        'password', // <-- TAMBAHKAN BARIS INI: Jika ingin fillable (pertimbangkan keamanan)
        'is_active', // <-- TAMBAHKAN BARIS INI: Jika ingin fillable (pertimbangkan keamanan)
        'email_verified_at', // <-- TAMBAHKAN BARIS INI: Jika ingin fillable (pertimbangkan keamanan)
    ];

    /**
     * Atribut yang harus di-cast ke tipe data natif.
     *
     * Daftar kolom yang akan diubah tipenya menjadi tipe data PHP yang sesuai
     * saat diakses (misalnya, date string menjadi objek Carbon).
     *
     * @var array
     */
    protected $casts = [
        'subscription_start_date' => 'date', // Cast menjadi tipe date
        'subscription_end_date' => 'date',    // Cast menjadi tipe date
        'email_verified_at' => 'datetime', // Sebaiknya cast juga ke datetime
    ];
}