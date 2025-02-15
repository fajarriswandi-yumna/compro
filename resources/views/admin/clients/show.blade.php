@extends('layouts.app')

@section('title', 'Detail Client')

@section('content')
    <div class="container">
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <h1 class="titlePage">Detail Client</h1>
            <div>breadcrumb</div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header cardHeaderPrimary">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-light"><i
                            class="fas fa-arrow-left"></i></a>
                    <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-outline-light"><i
                            class="fas fa-edit"></i></a>

                </div>

                <div class="headerProfile">
                    @if ($client->photo_profile)
                        <img src="{{ asset('storage/' . $client->photo_profile) }}" alt="Gambar Profil"
                            class="rounded-circle" width="150">
                    @else
                        <img src="{{ asset('images/emptyImage.png') }}" alt="Gambar Profil Default" class="rounded-circle"
                            width="150">
                    @endif
                </div>
            </div>
            <div class="card-body pt-5">
                <dl class="row pt-2">
                    <dt class="col-sm-3">Nama Lengkap</dt>
                    <dd class="col-sm-9">{{ $client->full_name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $client->email }}</dd>

                    <dt class="col-sm-3">No. Telepon</dt>
                    <dd class="col-sm-9">{{ $client->no_phone }}</dd>

                    <dt class="col-sm-3">Institusi</dt>
                    <dd class="col-sm-9">{{ $client->institution }}</dd>

                    <dt class="col-sm-3">Paket Langganan</dt>
                    <dd class="col-sm-9">{{ $client->subscribe_type }}</dd>

                    <dt class="col-sm-3">Status Berlangganan</dt>
                    <dd class="col-sm-9">{{ $client->subscribe_status }}</dd>

                    <dt class="col-sm-3">Tanggal Mulai Berlangganan</dt>
                    <dd class="col-sm-9">
                        {{ $client->subscription_start_date ? $client->subscription_start_date->format('d M Y') : '-' }}
                    </dd>

                    <dt class="col-sm-3">Tanggal Berakhir Berlangganan</dt>
                    <dd class="col-sm-9">
                        {{ $client->subscription_end_date ? $client->subscription_end_date->format('d M Y') : '-' }}</dd>

                    <dt class="col-sm-3">Dibuat Pada</dt>
                    <dd class="col-sm-9">{{ $client->created_at->format('d M Y, H:i:s') }}</dd>

                    <dt class="col-sm-3">Terakhir Diperbarui</dt>
                    <dd class="col-sm-9">{{ $client->updated_at->format('d M Y, H:i:s') }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
