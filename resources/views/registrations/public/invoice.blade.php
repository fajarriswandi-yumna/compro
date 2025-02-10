<!DOCTYPE html>
<html>

<head>
    <title>Invoice Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h1>Invoice Pembayaran</h1>
                        <hr>

                        <p>Nomor Invoice: <b>{{ $registration->invoice_number }}</b></p> 

                            <p>Terima kasih atas pendaftaran Anda!</p>

                            <div class="text-start">
                                <p><b>Informasi Pendaftaran:</b></p>
                                <ul>
                                    <li>Nama Lengkap: {{ $registration->full_name }}</li>
                                    <li>Email: {{ $registration->email }}</li>
                                    <li>Nomor Telepon: {{ $registration->phone_number }}</li>
                                    <li>Nama Sekolah: {{ $registration->school_name ?? '-' }}</li>
                                    <li>Paket Pembayaran: {{ ucfirst($registration->payment_package) }}</li>
                                </ul>
                            </div>

                            <h2 class="mt-4">Total Pembayaran: Rp. {{ number_format($nominalPembayaran, 0, ',', '.') }}</h2>

                            <p class="mt-3">Silahkan transfer biaya pendaftaran di nomer berikut ini:</p>
                            <p><b>BSI 7777212981 an Fajar Riswandi</b></p>

                            <p class="mt-3"><b>Batas Waktu Pembayaran:</b> <span id="countdown"></span></p> 

                                <div id="payment-failed-alert" class="alert alert-danger mt-3" role="alert" style="display: none;"> 
                                    Pembayaran Gagal, silahkan hubungi admin.
                                    </div>

                                    <div class="mt-4">
                                        <button onclick="window.print()" class="btn btn-secondary me-2">Print Invoice</button> 
                                        <a href="https://wa.me/6287747393058?text=Saya+mau+konfirmasi+pembayaran." class="btn btn-success" target="_blank">Konfirmasi Pembayaran</a>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentDeadline = new Date("{{ $paymentDeadline }}"); // Ambil paymentDeadline dari Blade dan buat objek Date
            const countdownElement = document.getElementById('countdown');
            const paymentFailedAlert = document.getElementById('payment-failed-alert');

            function updateCountdown() {
                const now = new Date();
                const timeLeft = paymentDeadline.getTime() - now.getTime(); // Selisih waktu dalam milliseconds

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval); // Hentikan countdown jika waktu habis
                    countdownElement.textContent = "Waktu Pembayaran Habis";
                    paymentFailedAlert.style.display = 'block'; // Tampilkan alert gagal bayar
                } else {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    countdownElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`; // Format HH:MM:SS
                }
            }

            updateCountdown(); // Panggil updateCountdown() pertama kali langsung saat halaman load
            const countdownInterval = setInterval(updateCountdown, 1000); // Update countdown setiap detik
        });
    </script>
</body>

</html>