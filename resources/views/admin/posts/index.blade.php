@extends('layouts.app')
@section('title', 'Blog')
@section('content')
<div class="container">


    <div class="d-flex justify-content-between align-items-center">
        <h1 class="titlePage mb-4">Blogs</h1>
        <div>breadcrumb</div>
    </div>

    <!-- <div class="mt-5 mb-5">
        <div class="card mb-4">
            <div class="card-header card-header d-flex justify-content-between">Header</div>
            <div class="card-body">Body</div>
            <div class="card-footer">Footer</div>
        </div>
    </div> -->

    <!-- Start Card Container -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <!-- Search -->
            <div class="mb-0">
                <form action="{{ route('admin.posts.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text" id="search-icon">
                            <iconify-icon icon="ic:round-search" width="24" height="24"></iconify-icon>
                        </span>
                        <input type="text" class="form-control group-text me-2" placeholder="Cari artikel" name="search" value="{{ request('search') }}" aria-describedby="search-icon">
                        <!-- <button class="btn btn-primary" type="submit" id="button-search">Cari</button> -->
                        @if(request('search'))
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary" id="button-clear">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm mb-0 d-flex justify-content-between align-items-center ps-3 pe-3 text-white">
                <iconify-icon icon="pepicons-pop:plus" width="20" height="20"></iconify-icon> <span>Create Post</span>
            </a>
        </div>
        <div class="card-body vh-100">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle table-striped1 table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th colspan="2">Title</th>
                            <th>Visibility</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($post->featured_image_path)
                                <img class="avatarImage" src="{{ asset('storage/' . $post->featured_image_path) }}" alt="Gambar Unggulan" width="100">
                                @else
                                <img class="avatarImage" src="{{ asset('images/emptyImage.png') }}" alt="Feature Image">
                                @endif
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>
                                @if($post->is_published)
                                <span class="badge bg-success">Dipublikasikan</span>
                                @else
                                <span class="badge bg-warning text-dark">Draft</span>
                                @endif
                            </td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                <!-- Action Button Group -->
                                <div class="btn-group">
                                    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <iconify-icon icon="pepicons-pencil:dots-x" width="20" height="20"></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.posts.edit', $post) }}"><i class="fas fa-edit"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.posts.detail', $post->id) }}"><i class="fas fa-eye"></i> View</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <!-- <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a> -->
                                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <a type="submit" class="dropdown-item btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Action Button Group -->

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
    <!-- Start Card Container -->

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