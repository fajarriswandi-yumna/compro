@extends('layouts.app')

@section('title', 'Add Client')

@section('content')
    <div class="container">
        <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="titlePage ">Add Client</h1>

            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Create New Client</h6>
                    <div>
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary text-white">Save new client</button>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.clients._form') {{-- INCLUDE _form.blade.php --}}
        </form>
    </div>
    </div>
    </div>
@endsection
