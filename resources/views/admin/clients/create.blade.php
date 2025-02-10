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

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_phone" class="form-label">No. Telepon <span class="text-danger">*</span> (Contoh: 628123456789)</label>
                        <input type="text" class="form-control @error('no_phone') is-invalid @enderror" id="no_phone" name="no_phone" value="{{ old('no_phone') }}" required placeholder="Contoh: 628123456789">
                        @error('no_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Gunakan kode negara (contoh: 62 untuk Indonesia) tanpa simbol + atau 0 di depan.</small>
                    </div>

                    <div class="mb-3">
                        <label for="photo_profile" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control @error('photo_profile') is-invalid @enderror" id="photo_profile" name="photo_profile">
                        @error('photo_profile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="institution" class="form-label">Institusi</label>
                        <input type="text" class="form-control @error('institution') is-invalid @enderror" id="institution" name="institution" value="{{ old('institution') }}">
                        @error('institution')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subscribe_status" class="form-label">Status Berlangganan <span class="text-danger">*</span></label>
                        <select class="form-select @error('subscribe_status') is-invalid @enderror" id="subscribe_status" name="subscribe_status" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ old('subscribe_status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non Aktif" {{ old('subscribe_status') == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                        @error('subscribe_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subscription_start_date" class="form-label">Tanggal Mulai Berlangganan</label>
                        <input type="date" class="form-control @error('subscription_start_date') is-invalid @enderror" id="subscription_start_date" name="subscription_start_date" value="{{ old('subscription_start_date') }}">
                        @error('subscription_start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subscription_end_date" class="form-label">Tanggal Berakhir Berlangganan</label>
                        <input type="date" class="form-control @error('subscription_end_date') is-invalid @enderror" id="subscription_end_date" name="subscription_end_date" value="{{ old('subscription_end_date') }}">
                        @error('subscription_end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Simpan Client</button>
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection