@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Detail Kategori</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Kategori</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <p>{{ $category->name }}</p>
                </div>

                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kembali ke Daftar Kategori</a>
            </div>
        </div>
    </div>
    @endsection