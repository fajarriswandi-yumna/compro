@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="container">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <h1 class="titlePage">Categories</h1>
                <div>breadcrumb</div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Edity Category</h6>
                    <div>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary text-white">Update</button>
                    </div>
                </div>
                <div class="card-body">


                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
        </form>
    </div>
    </div>
    </div>
@endsection
