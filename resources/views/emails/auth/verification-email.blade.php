<x-mail::message>
# Verifikasi Email Pendaftaran Akun AKSARA

**Halo {{ $clientName }},**

Terima kasih telah mendaftar di AKSARA.

Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda dan mengaktifkan akun Anda.

<x-mail::button :url="$verificationUrl">
Verifikasi Email Sekarang
</x-mail::button>

Jika tombol di atas tidak berfungsi, Anda bisa menyalin dan membuka URL berikut di browser Anda:

[{{ $verificationUrl }}]({{ $verificationUrl }})

Terima kasih,
Tim AKSARA
</x-mail::message>