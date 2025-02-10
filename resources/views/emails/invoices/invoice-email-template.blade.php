<x-mail::message>
# Invoice #{{ $bill->no_invoice }} dari AKSARA

**Kepada Yth. {{ $bill->client->full_name }},**

Berikut adalah detail tagihan Anda:

**Detail Tagihan:**

- **No. Invoice:** {{ $bill->no_invoice }}
- **Nama Client:** {{ $bill->client->full_name }}
- **Tipe Berlangganan:** {{ $bill->subscribe_type }}
- **Status Pembayaran:** {{ $bill->payment_status }}
- **Total Tagihan:** Rp. {{ number_format($bill->amount, 0, ',', '.') }}

**Detail Client:**

- **Nama Lengkap:** {{ $bill->client->full_name }}
- **Nomor Telepon:** {{ $bill->client->no_phone }}
- **Email:** {{ $bill->client->email }}

Terima kasih atas kepercayaan Anda menggunakan layanan kami.

Salam Hangat,
Tim AKSARA

<?php
    $billDetailUrl = route('client.bills.show', $bill->id); // Ubah route ke client.bills.show
?>
<x-mail::button :url="$billDetailUrl">
Lihat Detail Tagihan
</x-mail::button>

<br>
<small>Ini adalah email otomatis. Mohon tidak membalas email ini secara langsung.</small>
</x-mail::message>