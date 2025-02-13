@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
<div class="container">
    <h1 class="titlePage mb-4">Blogs</h1>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">Edit</h6>
                    </div>
                    <div class="card-body">


                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Postingan</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Konten</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>







                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0">Options</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id', $post->category_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Gambar Unggulan (Opsional)</label>
                            <br>
                            @if($post->featured_image_path)
                            <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="Gambar Unggulan Saat Ini" width="150" class="mb-2">
                            @endif
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image">
                            @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_published" class="form-label">Status Publikasi</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="is_published" id="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">Publikasikan Artikel?</label>
                            </div>
                            <small class="text-muted">Centang jika Anda ingin artikel ini dipublikasikan di blog.</small>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary text-white">Update</button>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </form>
</div>
</div>
</div>
@endsection