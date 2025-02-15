@extends('layouts.app')

@section('title', 'Tambah Kategori Baru')

@section('content')
    <div class="container">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <h1 class="titlePage">Categories</h1>
                <div>breadcrumb</div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Create New User</h6>
                    <div>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary text-white">Save new category</button>
                    </div>
                </div>
                <div class="card-body">


                    <div class="mb-3">
                        <label for="name" class="form-label">Category name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
        </form>
    </div>
    </div>
    </div>
@endsection
