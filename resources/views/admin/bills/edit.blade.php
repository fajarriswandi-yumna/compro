@extends('layouts.app')

@section('title', 'Edit Billing Information')

@section('content')
    <div class="container">
        <form action="{{ route('admin.bills.update', $bill->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="titlePage ">Add Billing</h1>

            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Create New Client</h6>
                    <div>
                        <a href="{{ route('admin.bills.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary text-white">Save new billing</button>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.bills._form') {{-- Include partial form --}}
        </form>
    </div>
    </div>
    </div>
@endsection
