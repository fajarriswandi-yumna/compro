@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="welcome">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <h1 class="g-gradient">Halo {{ Auth::user()->name }} <br>Hari ini kamu mau melakukan apa?</h1>
                <h4>Ayo kelola data website kamu sekarang, semua bisa di kerjakan dengan mudah dan cepat.</h4>

                <div class="row ">
                    <div class="col-md-3">
                        <div class="card listSummary">
                            <div class="card-body">
                                <p>Total calon pelanggan yang telah daftar</p>
                                <br>
                                <div class="d-flex">
                                    <iconify-icon icon="solar:user-broken" width="24" height="24"></iconify-icon>
                                    <p>{{ $totalRegistrations }}</p>  {{-- Ganti dengan variabel totalRegistrations --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card listSummary">
                            <div class="card-body">
                                <p>Total Artikel yang kamu publikasikan</p>
                                <br>
                                <div class="d-flex">
                                    <iconify-icon icon="solar:book-bold" width="24" height="24"></iconify-icon> {{-- Ganti icon --}}
                                    <p>{{ $totalPosts }}</p> {{-- Ganti dengan variabel totalPosts --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card listSummary">
                            <div class="card-body">
                                <p>Total Kunjungan bulan ini di website</p>
                                <br>
                                <div class="d-flex">
                                    <iconify-icon icon="solar:eye-bold" width="24" height="24"></iconify-icon> {{-- Ganti icon --}}
                                    <p>20</p> {{-- Biarkan tetap statis atau ganti dengan data kunjungan jika ada --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card listSummary">
                            <div class="card-body">
                                <p>Total pengguna di website kamu</p>
                                <br>
                                <div class="d-flex">
                                    <iconify-icon icon="solar:users-bold" width="24" height="24"></iconify-icon> {{-- Ganti icon --}}
                                    <p>{{ $totalUsers }}</p> {{-- Ganti dengan variabel totalUsers --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection