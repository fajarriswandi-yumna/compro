@extends('layouts.app')

@section('title', 'Edit Tagihan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Tagihan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Tagihan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.bills.update', $bill->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.bills._form') {{-- Include partial form --}}

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.bills.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection