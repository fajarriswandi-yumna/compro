@extends('layouts.app')

@section('title', 'Manajemen User Admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="titlePage">Users</h1>
        <div>breadcrumb</div>
    </div>

    <div class="mt-5 mb-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0">Daftar User Admin</h6>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm mb-0 d-flex justify-content-between align-items-center ps-3 pe-3 pt-2 pb-2 text-white">
                    <i class="fas fa-plus"></i> &nbsp; Create User
                </a>

            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table align-middle table-striped1 table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th colspan="2">Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($user->profile_image_path)
                                    <img src="{{ asset('storage/' . $user->profile_image_path) }}" alt="Profile Image" class="avatarImage">
                                    @else
                                    <img class="avatarImage" src="{{ asset('images/emptyImage.png') }}" alt="Feature Image">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>

                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
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
                                <td colspan="5" class="text-center">Tidak ada data user admin.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

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