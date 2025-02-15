@extends('layouts.app')

@section('title', 'Detail User Admin')

@section('content')
    <div class="container">
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <h1 class="titlePage">Detail Users</h1>
            <div>breadcrumb</div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header cardHeaderPrimary">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light"><i
                            class="fas fa-arrow-left"></i></a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-light"><i
                            class="fas fa-edit"></i></a>

                </div>

                <div class="headerProfile">
                    @if ($user->profile_image_path)
                        <img src="{{ asset('storage/' . $user->profile_image_path) }}" alt="Gambar Profil"
                            class="rounded-circle" width="150">
                    @else
                        <img src="{{ asset('images/emptyImage.png') }}" alt="Gambar Profil Default" class="rounded-circle"
                            width="150">
                    @endif
                </div>
            </div>
            <div class="card-body pt-5">

                <div class="mb-3 pt-2">
                    <h2>{{ $user->name }}</h2>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
