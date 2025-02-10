@extends('layouts.app') {{-- Anda bisa menggunakan layout yang berbeda jika ingin --}}

@section('title', 'Detail Tagihan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-body">
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
                    {{-- Tombol Edit dan Kembali Dihilangkan untuk Tampilan Klien --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    /* Style CSS bisa sama dengan admin.bills.show.blade.php */
    .invoice-container {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
    }

    .invoice-title {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .invoice-id {
        font-size: 1.5rem;
        color: #555;
    }

    .invoice-number {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .invoice-details strong,
    .invoice-items strong,
    .invoice-total strong,
    .invoice-status strong {
        font-weight: bold;
    }

    .invoice-total h4 {
        font-weight: bold;
    }

    .badge.bg-success {
        background-color: #28a745;
    }

    .badge.bg-danger {
        background-color: #dc3545;
    }
</style>