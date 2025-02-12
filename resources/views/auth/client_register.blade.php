@extends('layouts.app')

@section('title', 'Pendaftaran Klien Baru')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pendaftaran Klien Baru') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('info'))
                        <div class="alert alert-info" role="alert">
                            {{ session('info') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('client.registration.submit') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="full_name" class="form-label">{{ __('Nama Lengkap') }}</label>
                            <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>
                            @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_phone" class="form-label">{{ __('Nomor Telepon') }}</label>
                            <input id="no_phone" type="text" class="form-control @error('no_phone') is-invalid @enderror" name="no_phone" value="{{ old('no_phone') }}" required autocomplete="no_phone">
                            @error('no_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="institution" class="form-label">{{ __('Institusi (Opsional)') }}</label>
                            <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" value="{{ old('institution') }}" autocomplete="institution">
                            @error('institution')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subscribe_type" class="form-label">{{ __('Tipe Berlangganan') }}</label>
                            <select id="subscribe_type" class="form-select @error('subscribe_type') is-invalid @enderror" name="subscribe_type" required>
                                <option value="" {{ old('subscribe_type') == '' ? 'selected' : '' }}>Pilih Tipe Berlangganan</option>
                                <option value="Bulanan" {{ old('subscribe_type') == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                                <option value="Tahunan" {{ old('subscribe_type') == 'Tahunan' ? 'selected' : '' }}>Tahunan</option>
                            </select>
                            @error('subscribe_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo_profile" class="form-label">{{ __('Foto Profil (Opsional)') }}</label>
                            <input id="photo_profile" type="file" class="form-control @error('photo_profile') is-invalid @enderror" name="photo_profile">
                            @error('photo_profile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Daftar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection