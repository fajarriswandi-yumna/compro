<!DOCTYPE html>
<html>

<head>
    <title>Invoice - {{ $bill->no_invoice }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .invoice-container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            width: 100%;
            /* Pastikan 100% width untuk PDF */
            max-width: 800px;
            /* Batasi lebar maksimum jika perlu */
            margin: 0 auto;
            /* Center container */
        }

        .invoice-title {
            font-size: 2.0rem;
            /* Lebih kecil dari show.blade.php */
            font-weight: bold;
            color: #333;
            /* Warna teks lebih gelap untuk PDF */
        }

        .invoice-id {
            font-size: 1.2rem;
            /* Lebih kecil dari show.blade.php */
            color: #777;
            /* Warna teks lebih redup untuk PDF */
        }

        .invoice-number {
            font-size: 1.5rem;
            /* Lebih kecil dari show.blade.php */
            font-weight: bold;
            color: #333;
            /* Warna teks lebih gelap untuk PDF */
        }

        .invoice-details strong,
        .invoice-items strong,
        .invoice-total strong,
        .invoice-status strong {
            font-weight: bold;
            color: #333;
            /* Warna teks lebih gelap untuk PDF */
        }

        .invoice-total h4 {
            font-weight: bold;
            color: #333;
            /* Warna teks lebih gelap untuk PDF */
        }

        .badge.bg-success {
            background-color: #28a745;
            color: white;
            /* Teks putih untuk badge di PDF */
            padding: 0.3em 0.6em;
            /* Padding badge */
            border-radius: 0.25rem;
            /* Radius badge */
        }

        .badge.bg-danger {
            background-color: #dc3545;
            color: white;
            /* Teks putih untuk badge di PDF */
            padding: 0.3em 0.6em;
            /* Padding badge */
            border-radius: 0.25rem;
            /* Radius badge */
        }

        hr {
            border-top: 1px solid #ccc;
            /* Garis pemisah lebih jelas di PDF */
        }

        .text-end {
            text-align: right;
            /* Utility class untuk text-align: right di PDF */
        }

        .mt-2 {
            margin-top: 0.5rem;
            /* Utility class untuk margin-top: 0.5rem di PDF */
        }

        .mt-3 {
            margin-top: 1rem;
            /* Utility class untuk margin-top: 1rem di PDF */
        }

        .mt-4 {
            margin-top: 1.5rem;
            /* Utility class untuk margin-top: 1.5rem di PDF */
        }

        .mb-3 {
            margin-bottom: 1rem;
            /* Utility class untuk margin-bottom: 1rem di PDF */
        }

        .mb-4 {
            margin-bottom: 1.5rem;
            /* Utility class untuk margin-bottom: 1.5rem di PDF */
        }

        .d-flex {
            display: flex;
            /* Utility class untuk display: flex di PDF */
        }

        .justify-content-between {
            justify-content: space-between;
            /* Utility class untuk justify-content: space-between di PDF */
        }

        .align-items-baseline {
            align-items: baseline;
            /* Utility class untuk align-items: baseline di PDF */
        }

        .flex-column {
            flex-direction: column;
            /* Utility class untuk flex-direction: column di PDF */
        }

        .align-items-end {
            align-items: flex-end;
            /* Utility class untuk align-items: flex-end di PDF */
        }

        .row {
            display: flex;
            /* Utility class untuk row */
            flex-wrap: wrap;
            /* Utility class untuk row */
            margin-right: -15px;
            /* Utility class untuk row (sesuaikan jika perlu) */
            margin-left: -15px;
            /* Utility class untuk row (sesuaikan jika perlu) */
        }

        .col-md-6 {
            flex: 0 0 auto;
            /* Utility class untuk col-md-6 */
            width: 50%;
            /* Utility class untuk col-md-6 */
            padding-right: 15px;
            /* Utility class untuk col-md-6 (sesuaikan jika perlu) */
            padding-left: 15px;
            /* Utility class untuk col-md-6 (sesuaikan jika perlu) */
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header d-flex justify-content-between align-items-baseline">
            <div>
                <h2 class="invoice-title text-primary">AKSARA</h2>
                <hr /> <br />
            </div>
            <div class="d-flex flex-column align-items-end">
                <h4 class="invoice-id">Invoice</h4>
                <h5 class="invoice-number">#{{ $bill->no_invoice }}</h5>
            </div>
        </div>

        <div class="invoice-details mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="invoice-recipient">
                        <strong>Recipient</strong>
                        <p class="mt-2">{{ $bill->client->full_name }}</p>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="invoice-date">
                        <strong>Date Created</strong>
                        <p class="mt-2">{{ $bill->created_at->format('d/m/y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-items mt-4">
            <div class="row">
                <div class="col-md-6">
                    <strong>Subscription Type</strong>
                    <p class="mt-2">{{ $bill->subscribe_type }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <strong></strong>
                    <p class="mt-2"></p> {{-- Empty label in image --}}
                    <p class="mt-2">Rp. {{ number_format($bill->amount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="invoice-total d-flex justify-content-between">
            <strong>Total</strong>
            <h4 class="text-primary">Rp. {{ number_format($bill->amount, 0, ',', '.') }}</h4>
        </div>

        <div class="invoice-status mt-3 text-end">
            <strong>Status</strong>
            @if ($bill->payment_status == 'Paid')
            <span class="badge bg-success">Paid</span>
            @else
            <span class="badge bg-danger">Unpaid</span>
            @endif
        </div>
    </div>
</body>

</html>