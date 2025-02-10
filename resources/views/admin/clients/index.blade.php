@extends('layouts.app')

@section('title', 'Daftar Clients')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Clients</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Clients</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary mb-3">Tambah Client Baru</a>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="mb-3">
                <form action="{{ route('admin.clients.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari client (Nama, Email, No. Telp)..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit" id="button-search">Cari</button>
                        @if(request('search'))
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary" id="button-clear">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Status</th>
                            <th>End Subscription</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $client->full_name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->no_phone }}</td>
                            <td>{{ $client->subscribe_status }}</td>
                            <td>{{ $client->subscription_end_date }}</td>
                            <td>
                                <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus client ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data client.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- {{ $clients->links() }} -->
            {{ $clients->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>
</div>
@endsection