@extends('layouts.app')
@section('title', 'Detail')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Postingan Blog</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Postingan Blog</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Judul Postingan</label>
                <p>{{ $post->title }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <p>
                    @if ($post->category)
                    {{ $post->category->name }}
                    @else
                    Kategori Kosong
                    @endif
                </p>
            </div>

            <dt class="col-sm-3">Status Publikasi</dt>
            <dd class="col-sm-9">
                @if($post->is_published)
                <span class="badge bg-success">Dipublikasikan</span>
                @else
                <span class="badge bg-warning text-dark">Draft</span>
                @endif
            </dd>

            <div class="mb-3">
                <label class="form-label">Konten</label>
                <p>
                <p>{!! $post->content !!}</p>
                </p>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Unggulan</label>
                @if($post->featured_image_path)
                <div>
                    <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="Gambar Unggulan" style="max-width: 300px;">
                </div>
                @else
                <p>-</p>
                @endif
            </div>

            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Kembali ke Daftar Postingan</a>
        </div>
    </div>
</div>
@endsection