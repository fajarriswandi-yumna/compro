@extends('layouts.app')

@section('title', 'Daftar Tagihan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Tagihan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tagihan</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.bills.create') }}" class="btn btn-primary mb-3">Tambah Tagihan Baru</a>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Invoice</th>
                            <th>Client</th>
                            <th>Tipe Berlangganan</th>
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
                            <td><a href="{{ route('admin.bills.show', $bill->id) }}">{{ $bill->no_invoice }}</a></td>
                            <td>{{ $bill->client->full_name }}</td> {{-- Akses nama client melalui relationship --}}
                            <td>{{ $bill->subscribe_type }}</td>
                            <td>{{ $bill->payment_status }}</td>
                            <td>Rp. {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td>{{ $bill->created_at->format('d-m-Y H:i:s') }}</td> <td>
                            <td>
                                <a href="{{ route('admin.bills.edit', $bill->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.bills.destroy', $bill->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus tagihan ini?')">Hapus</button>
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