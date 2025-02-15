@extends('layouts.app')

@section('title', 'List Billing')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="titlePage">Billing List</h1>
            <div>breadcrumb</div>
        </div>

        <div class="mb-5">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <!-- Search -->
                    <div class="mb-0">
                        <form action="{{ route('admin.bills.index') }}" method="GET">
                            <div class="input-group">
                                <span class="input-group-text" id="search-icon">
                                    <iconify-icon icon="ic:round-search" width="24" height="24"></iconify-icon>
                                </span>
                                <input type="text" class="form-control group-text me-2" placeholder="Search Billing"
                                    name="search" value="{{ request('search') }}" aria-describedby="search-icon">
                                @if (request('search'))
                                    <a href="{{ route('admin.bills.index') }}" class="btn btn-secondary"
                                        id="button-clear">Clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('admin.bills.create') }}"
                        class="btn btn-primary btn-sm mb-0 d-flex justify-content-between align-items-center ps-3 pe-3 text-white">
                        <iconify-icon icon="pepicons-pop:plus" width="20" height="20"></iconify-icon>
                        <span>Create bill</span>
                    </a>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No. Invoice</th>
                                    <th>Client</th>
                                    <th>Paket Langganan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Total Tagihan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bills as $bill)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('admin.bills.show', $bill->id) }}">{{ $bill->no_invoice }}</a>
                                        </td>
                                        <td>{{ $bill->client->full_name }}</td>
                                        <td>{{ $bill->client->subscribe_type }}</td>
                                        <td>{{ $bill->payment_status }}</td>
                                        <td>Rp. {{ number_format($bill->amount, 0, ',', '.') }}</td>
                                        <td>{{ $bill->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                        <td>

                                            <a href="{{ route('admin.bills.edit', $bill->id) }}" class="btn btn-outline-secondary btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.bills.destroy', $bill->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user admin ini?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>


                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data tagihan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $bills->links() }}
                </div>
            </div>
        </div>
    @endsection
