@extends('layouts.app')

@section('title', 'Detail Client')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Detail Client</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Client</h6>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nama Lengkap</dt>
                    <dd class="col-sm-9">{{ $client->full_name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $client->email }}</dd>

                    <dt class="col-sm-3">No. Telepon</dt>
                    <dd class="col-sm-9">{{ $client->no_phone }}</dd>

                    <dt class="col-sm-3">Foto Profil</dt>
                    <dd class="col-sm-9">
                        @if($client->photo_profile)
                            <img src="{{ Storage::url($client->photo_profile) }}" alt="Foto Profil Client" class="img-thumbnail" width="150">
                        @else
                            Tidak Ada Foto Profil
                        @endif
                    </dd>

                    <dt class="col-sm-3">Institusi</dt>
                    <dd class="col-sm-9">{{ $client->institution }}</dd>

                    <dt class="col-sm-3">Status Berlangganan</dt>
                    <dd class="col-sm-9">{{ $client->subscribe_status }}</dd>

                    <dt class="col-sm-3">Tanggal Mulai Berlangganan</dt>
                    <dd class="col-sm-9">{{ $client->subscription_start_date ? $client->subscription_start_date->format('d M Y') : '-' }}</dd>

                    <dt class="col-sm-3">Tanggal Berakhir Berlangganan</dt>
                    <dd class="col-sm-9">{{ $client->subscription_end_date ? $client->subscription_end_date->format('d M Y') : '-' }}</dd>

                    <dt class="col-sm-3">Dibuat Pada</dt>
                    <dd class="col-sm-9">{{ $client->created_at->format('d M Y, H:i:s') }}</dd>

                    <dt class="col-sm-3">Terakhir Diperbarui</dt>
                    <dd class="col-sm-9">{{ $client->updated_at->format('d M Y, H:i:s') }}</dd>
                </dl>
                <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Kembali ke Daftar Clients</a>
            </div>
        </div>
    </div>
@endsection