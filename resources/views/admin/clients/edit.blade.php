@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Client</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Client</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('admin.clients._form', compact('client')) {{-- INCLUDE _form.blade.php DAN KIRIM DATA $client --}}

                    <button type="submit" class="btn btn-primary">Update Client</button>
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection