@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')
    <div class="container">
        <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h1 class="titlePage ">Add Client</h1>

            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Edit data Client</h6>
                    <div>
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary text-white">Update</button>
                    </div>
                </div>

                <div class="card-body">


                    @include('admin.clients._form', compact('client')) {{-- INCLUDE _form.blade.php DAN KIRIM DATA $client --}}

        </form>
    </div>
    </div>
    </div>
@endsection
