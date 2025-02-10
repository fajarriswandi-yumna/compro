@extends('layouts.app')

@section('title', 'Manajemen Pendaftaran')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Pendaftaran Calon Pelanggan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pendaftaran Calon Pelanggan</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Cust</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Paket Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($registrations as $registration)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-secondary text-white">{{ $registration->id }}</span></td>
                            <td>{{ $registration->full_name }}</td>
                            <td>{{ $registration->email }}</td>
                            <td>{{ $registration->phone_number }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $registration->payment_package)) }}</td>
                            <td>
                                @if($registration->payment_status == 'sudah_bayar')
                                <span class="badge bg-success text-white">Sudah Bayar</span>
                                @else
                                <span class="badge bg-warning text-dark">Belum Bayar</span>
                                @endif
                            </td>
                            
                            <td>
                                <a href="{{ route('admin.registrations.show', $registration->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.registrations.edit', $registration->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit Status Pembayaran
                                </a>
                                <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data pendaftaran.</td> {{-- Update colspan menjadi 8 --}}
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush