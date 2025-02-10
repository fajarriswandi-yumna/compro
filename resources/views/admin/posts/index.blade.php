@extends('layouts.app')
@section('title', 'Blog')
@section('content')
<div class="container mt-5">

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold">Daftar Postingan Blog</h6>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm mb-3">
                <i class="fas fa-plus"></i> Tambah Postingan
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Search -->
            <div class="mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari Judul Postingan...">
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Gambar Unggulan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Gambar Unggulan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                @if($post->featured_image_path)
                                <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="Gambar Unggulan" width="100">
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                <!-- <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a> -->

                                <a href="{{ route('admin.posts.detail', $post->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>

                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data postingan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>
            <!-- {{ $posts->links() }} -->
            {{ $posts->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $(document).ready(function() {
        // Inisialisasi DataTable (jika diperlukan, bisa dihapus jika tidak)
        $('#dataTable').DataTable();

        // Ambil input search
        const searchInput = $('#searchInput');
        const postTableBody = $('#postTableBody');
        const paginationLinks = $('#pagination-links'); // Ambil div pagination

        // Fungsi untuk melakukan pencarian AJAX
        function searchPosts(query) {
            $.ajax({
                url: "{{ route('admin.posts.search') }}", // URL route search
                type: "GET",
                data: {
                    search: query
                }, // Kirim query pencarian sebagai data
                success: function(data) {
                    postTableBody.html(data); // Update isi tbody dengan hasil pencarian dari server
                    paginationLinks.hide(); // Sembunyikan pagination saat hasil pencarian tampil
                },
                error: function(xhr, status, error) {
                    console.error("Error during search:", error);
                    postTableBody.html('<tr><td colspan="5" class="text-center">Terjadi kesalahan saat mencari data.</td></tr>'); // Tampilkan pesan error jika gagal
                    paginationLinks.show(); // Pastikan pagination muncul kembali jika terjadi error (opsional)
                }
            });
        }

        // Event listener untuk input search (debounce untuk menghindari request berlebihan)
        let searchTimeout;
        searchInput.on('input', function() {
            console.log("Input event triggered!"); // Tambahkan log di awal event listener
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                const query = searchInput.val();
                if (query.length >= 2 || query.length === 0) {
                    searchPosts(query);
                    if (query.length === 0) {
                        paginationLinks.show();
                    } else {
                        paginationLinks.hide();
                    }
                }
            }, 500);
        });
    });

    function searchPosts(query) {
        console.log("searchPosts function called with query:", query); // Log query yang dikirim ke AJAX
        $.ajax({
            url: "{{ route('admin.posts.search') }}",
            type: "GET",
            data: {
                search: query
            },
            success: function(data) {
                console.log("AJAX Success Response:", data); // Log response success
                postTableBody.html(data);
                paginationLinks.hide();
            },
            error: function(xhr, status, error) {
                console.error("Error during search:", error);
                console.log("XHR Response:", xhr); // Log XHR response
                postTableBody.html('<tr><td colspan="5" class="text-center">Terjadi kesalahan saat mencari data.</td></tr>');
                paginationLinks.show();
            }
        });
    }

    @endpush