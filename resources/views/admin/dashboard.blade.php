@extends('layouts.app') {{-- Menggunakan layout admin.blade.php --}}

@section('title', 'Dashboard Admin') {{-- Judul halaman --}}

@section('content') {{-- Section konten --}}
    <div class="container-fluid">

        {{-- Page Heading --}}
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

        {{-- Content Row - Contoh Konten Dashboard --}}
        <div class="row">

            {{-- Example Dashboard Card 1 --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">100</div> {{-- Ganti dengan data real --}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Example Dashboard Card 2 --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Categories</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">15</div> {{-- Ganti dengan data real --}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Example Dashboard Card 3 --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Posts
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50</div> {{-- Ganti dengan data real --}}
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Example Dashboard Card 4 --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Registrations</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div> {{-- Ganti dengan data real --}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Row - Grafik atau konten lain bisa ditambahkan di sini --}}
        <div class="row">
            {{-- Contoh: Area untuk Grafik --}}
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Contoh</h6>
                    </div>
                    <div class="card-body">
                        <p>Area ini bisa diisi dengan grafik, misalnya menggunakan Chart.js atau library charting lainnya.</p>
                        {{-- Tempat untuk grafik --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection