@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Detail Pendaftaran Calon Pelanggan</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pendaftaran</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <p>{{ $registration->full_name }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <p>{{ $registration->email }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <p>{{ $registration->phone_number }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Sekolah</label>
                    <p>{{ $registration->school_name ?? '-' }}</p> </div>

                <div class="mb-3">
                    <label class="form-label">Paket Pembayaran</label>
                    <p>{{ ucfirst(str_replace('_', ' ', $registration->payment_package)) }}</p> </div>

                <div class="mb-3">
                    <label class="form-label">Status Pembayaran</label>
                    <p>
                        @if($registration->payment_status == 'sudah_bayar')
                            <span class="badge bg-success text-white">Sudah Bayar</span>
                        @else
                            <span class="badge bg-warning text-dark">Belum Bayar</span>
                        @endif
                    </p>
                </div>

                <a href="{{ route('admin.registrations.edit', $registration->id) }}" class="btn btn-warning">Edit Status Pembayaran</a>
                <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">Kembali ke Daftar Pendaftaran</a>
            </div>
        </div>
    </div>
@endsection