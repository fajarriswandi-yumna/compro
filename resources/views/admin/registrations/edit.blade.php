@extends('layouts.app')

@section('title', 'Edit Status Pembayaran Pendaftaran')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Status Pembayaran Pendaftaran</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Status Pembayaran Pendaftaran</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.registrations.update', $registration->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Status Pembayaran</label>
                        <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                            <option value="">Pilih Status Pembayaran</option>
                            <option value="belum_bayar" {{ old('payment_status', $registration->payment_status) == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="sudah_bayar" {{ old('payment_status', $registration->payment_status) == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                        </select>
                        @error('payment_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Status Pembayaran</button>
                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection