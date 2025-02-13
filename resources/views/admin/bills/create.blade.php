@extends('layouts.app')

@section('title', 'Tambah Tagihan Baru')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Tagihan Baru</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Tagihan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.bills.store') }}" method="POST">
                @csrf

                {{-- Include partial form _form.blade.php --}}
                @include('admin.bills._form', ['no_invoice' => $no_invoice])

                <button type="submit" class="btn btn-primary">Simpan Tagihan</button>
                <a href="{{ route('admin.bills.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection