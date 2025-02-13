@extends('layouts.app')
@section('title', 'Detail')
@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Detail Postingan Blog</h1>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Preview Post</h6>
            <div>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline-secondary"><i class="fas fa-edit"></i> Edit</a>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h1>{{ $post->title }}</h1>
            </div>

            <div class="mb-3">
                @if($post->featured_image_path)
                <div>
                    <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="Gambar Unggulan" style="max-width: 300px;">
                </div>
                @else
                <p>-</p>
                @endif
            </div>

            <div class="mb-3">
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
                <p>{!! $post->content !!}</p>
            </div>




        </div>
    </div>
</div>
@endsection