<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm-bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang abu-abu muda, sesuaikan jika perlu */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh; /* Pastikan konten memenuhi tinggi viewport */
            margin: 0; /* Hilangkan margin body default */
        }

        .card {
            border: 0; /* Hilangkan border card jika diinginkan */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05); /* Efek bayangan tipis */
            border-radius: 0.25rem; /* Sudut card sedikit membulat */
        }
        .card-header {
            background-color: #ffffff; /* Header card warna putih */
            border-bottom: 1px solid #dee2e6; /* Border bawah header */
            padding: 1.25rem 1.5rem;
            font-weight: bold; /* Tebalkan teks header */
            text-align: center; /* Pusatkan teks header */
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .card-body {
            padding: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Aktivasi Akun Berhasil') }}</div>

                    <div class="card-body text-center">
                        <h4 class="mb-4">Selamat, {{ $clientName }}!</h4>
                        <p>Anda telah berhasil mendaftar untuk layanan kami. Silakan selesaikan pembayaran dan konfirmasi pembayaran dengan klik tombol di bawah ini:</p>

                        <div class="d-grid gap-2 col-md-6 mx-auto mt-4">
                            <a href="https://wa.me/6287747393058" class="btn btn-success" target="_blank">
                                <i class="bi bi-whatsapp me-2"></i> Konfirmasi Pembayaran via Whatsapp
                            </a>
                        </div>

                        <hr class="my-4">

                        <p class="mb-1">**No Rekening Pembayaran:**</p>
                        <p class="mb-0">**BSI**</p>
                        <p class="mb-0">**0877771821**</p>
                        <p class="mb-0">**an Fajar Riswandi**</p>

                        <hr class="my-4">

                        <p>Setelah pembayaran terkonfirmasi, dibutuhkan waktu 24 jam untuk proses installasi dan konfigurasi, setelah itu anda bisa langsung menggunakan layanan kami dengan mudah.</p>
                        <p class="mb-0">Terima kasih.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
