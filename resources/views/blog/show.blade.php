<!DOCTYPE html>
<html>

<head>
    <title>{{ $post->title }} - Aksara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $post->title }}</h1> {{-- Judul artikel --}}
                        <div>
                            @if($post->featured_image_path)
                            <div>
                                <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="Gambar Unggulan" style="max-width: 300px;">
                            </div>
                            @else
                            <p>-</p>
                            @endif
                        </div>
                        <hr>
                        <p class="text-muted">Diterbitkan pada: {{ $post->created_at->format('d M Y') }}</p> {{-- Tanggal publikasi --}}
                        <hr>
                        <div class="post-content">
                            {!! $post->content !!} {{-- Tampilkan konten artikel (gunakan !! untuk output HTML) --}}
                        </div>
                        <hr>
                        <a href="{{ route('blog.index') }}" class="btn btn-secondary">Kembali ke Daftar Artikel</a> {{-- Link kembali ke daftar artikel --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>