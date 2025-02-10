@extends('layouts.app')

@section('title', 'Detail Tagihan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Tagihan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Tagihan</h6>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">No Invoice</dt>
                <dd class="col-sm-9">{{ $bill->no_invoice }}</dd>

                <dt class="col-sm-3">Nama Client</dt>
                <dd class="col-sm-9">{{ $bill->client->full_name }}</dd>

                <dt class="col-sm-3">No. Telepon Client</dt>
                <dd class="col-sm-9">{{ $bill->client->no_phone }}</dd>

                <dt class="col-sm-3">Email Client</dt>
                <dd class="col-sm-9">{{ $bill->client->email }}</dd>

                <dt class="col-sm-3">Tipe Berlangganan</dt>
                <dd class="col-sm-9">{{ $bill->subscribe_type }}</dd>

                <dt class="col-sm-3">Status Pembayaran</dt>
                <dd class="col-sm-9">{{ $bill->payment_status }}</dd>

                <dt class="col-sm-3">Total Tagihan</dt>
                <dd class="col-sm-9">Rp. {{ number_format($bill->amount, 0, ',', '.') }}</dd>

                <dt class="col-sm-3">Dibuat Pada</dt>
                <dd class="col-sm-9">{{ $bill->created_at->format('d M Y, H:i:s') }}</dd>

                <dt class="col-sm-3">Terakhir Diperbarui</dt>
                <dd class="col-sm-9">{{ $bill->updated_at->format('d M Y, H:i:s') }}</dd>
            </dl>
            <a href="{{ route('admin.bills.edit', $bill->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.bills.index') }}" class="btn btn-secondary">Kembali ke Daftar Tagihan</a>
        </div>
    </div>
</div>
@endsection