@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Detail Kategori</h1>

        <div class="card shadow mb-4">
            <div class="card-header card-header d-flex justify-content-between">
                <h6 class="m-0">Informasi Kategori</h6>
                <div class="d-flex">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-secondary me-2"><i
                            class="fas fa-edit"></i> Edit</a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"><i
                            class="fas fa-arrow-left"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label"><small>Category Name</small></label>
                    <p>{{ $category->name }}</p>
                </div>


            </div>
        </div>
    </div>
@endsection
