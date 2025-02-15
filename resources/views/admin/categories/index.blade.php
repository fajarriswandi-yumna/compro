@extends('layouts.app')
@section('title', 'Categories')
@section('content')
    <div class="container">

        <div class="mb-2 d-flex justify-content-between align-items-center">
            <h1 class="titlePage">Categories</h1>
            <div>breadcrumb</div>
        </div>

        <div class=" mb-5">
            <div class="card mb-4">
                <div class="card-header card-header d-flex justify-content-between">
                    <div class="mb-0">
                        List Categories
                    </div>
                    <a href="{{ route('admin.categories.create') }}"
                        class="btn btn-primary btn-sm mb-0 d-flex justify-content-between align-items-center pt-2 pb-2 ps-3 pe-3 text-white">
                        <iconify-icon icon="pepicons-pop:plus" width="20" height="20"></iconify-icon> <span>Create
                            new category</span>
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.show', $category->id) }}"
                                                class="btn btn-outline-secondary btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="btn btn-outline-secondary btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-secondary btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data kategori.</td>
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
