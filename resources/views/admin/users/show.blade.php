@extends('layouts.app')

@section('title', 'Detail User Admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Detail User Admin</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi User Admin</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($user->profile_image_path)
                        <img src="{{ asset('storage/' . $user->profile_image_path) }}" alt="Gambar Profil" class="rounded-circle" width="150">
                    @else
                        <img src="{{ asset('img/default_profile.png') }}" alt="Gambar Profil Default" class="rounded-circle" width="150">
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <p>{{ $user->name }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <p>{{ $user->email }}</p>
                </div>

                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali ke Daftar User Admin</a>
            </div>
        </div>
    </div>
@endsection