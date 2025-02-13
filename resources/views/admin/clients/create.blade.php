@extends('layouts.app')

@section('title', 'Tambah Client Baru')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Tambah Client Baru</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Client</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('admin.clients._form') {{-- INCLUDE _form.blade.php --}}

                    <button type="submit" class="btn btn-primary">Simpan Client</button>
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection