<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Blog Artikel</h1>
        <hr>

        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: inherit;">{{ $post->title }}</a></h5>
                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 200, '...') }}</p> {{-- Tampilkan ringkasan konten, batasi 200 karakter --}}
                            <p class="card-text"><small class="text-muted">Diterbitkan pada: {{ $post->created_at->format('d M Y') }}</small></p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center">Tidak ada artikel blog saat ini.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            <!-- {{ $posts->links() }} {{-- Tampilkan pagination links jika ada --}} -->
            {{ $posts->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>