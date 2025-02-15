@extends('layouts.app')

@section('title', 'List Clients')

@section('content')
    <div class="container">
        <form action="{{ route('admin.clients.index') }}" method="GET">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="titlePage">Clients</h1>
                <div>breadcrumb</div>
            </div>

            <div class="mb-5">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <!-- Search -->
                        <div class="mb-0">
                            <form action="{{ route('admin.clients.index') }}" method="GET">
                                <div class="input-group">
                                    <span class="input-group-text" id="search-icon">
                                        <iconify-icon icon="ic:round-search" width="24" height="24"></iconify-icon>
                                    </span>
                                    <input type="text" class="form-control group-text me-2" placeholder="Cari artikel"
                                        name="search" value="{{ request('search') }}" aria-describedby="search-icon">
                                    <!-- <button class="btn btn-primary" type="submit" id="button-search">Cari</button> -->
                                    @if (request('search'))
                                        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary"
                                            id="button-clear">Clear</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <a href="{{ route('admin.clients.create') }}"
                            class="btn btn-primary btn-sm mb-0 d-flex justify-content-between align-items-center ps-3 pe-3 text-white">
                            <iconify-icon icon="pepicons-pop:plus" width="20" height="20"></iconify-icon>
                            <span>Create
                                data client</span>
                        </a>
                    </div>
                    <div class="card-body vh-100">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">

                            <table class="table align-middle table-hover table-bordered" id="dataTable" width="100%" height="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th colspan="2">Nama Lengkap</th>
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
                                            <td class="text-center">
                                                @if($client->photo_profile)
                                                <img class="avatarImage" src="{{ asset('storage/' . $client->photo_profile) }}" alt="Gambar Unggulan" width="100">
                                                @else
                                                <img class="avatarImage" src="{{ asset('images/emptyImage.png') }}" alt="Feature Image">
                                                @endif
                                            </td>
                                            <td>{{ $client->full_name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->no_phone }}</td>
                                            <td>{{ $client->subscribe_status }}</td>
                                            <td>{{ $client->subscription_end_date }}</td>
                                            <td>

                                                <!-- Action Button Group -->
                                                <div class="btn-group">
                                                    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <iconify-icon icon="pepicons-pencil:dots-x" width="20"
                                                            height="20"></iconify-icon>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.clients.edit', $client) }}"><i
                                                                    class="fas fa-edit"></i> Edit</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.clients.show', $client->id) }}"><i
                                                                    class="fas fa-eye"></i> View</a></li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <!-- <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a> -->
                                                            <form action="{{ route('admin.clients.destroy', $client->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a type="submit" class="dropdown-item btn-sm"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                                                    <i class="fas fa-trash"></i> Detele
                                                                </a>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Action Button Group -->
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data not found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </form>
    </div>



    <!-- {{ $clients->links() }} -->
    {{ $clients->links('vendor.pagination.custom-pagination') }}
    </div>
    </div>
    </div>
@endsection
