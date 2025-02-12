@extends('layouts.app')

@section('title', 'Pendaftaran Tertunda')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pendaftaran Tertunda - Verifikasi Email Dibutuhkan') }}</div>

                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-info-circle"></i> {{ __('Terima kasih telah mendaftar!') }}
                    </div>

                    <p>{{ __('Pendaftaran Anda hampir selesai. Silakan periksa inbox email Anda (dan folder spam/junk) untuk melakukan verifikasi email.') }}</p>
                    <p>{{ __('Setelah email Anda diverifikasi, akun Anda akan aktif dan Anda dapat login.') }}</p>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-3">
                        <a href="{{ url('/') }}" class="btn btn-secondary">{{ __('Kembali ke Beranda') }}</a>
                        {{-- Anda bisa menambahkan link ke halaman bantuan atau kontak jika diperlukan --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection