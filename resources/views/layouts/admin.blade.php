<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Admin Dashboard') - Sistem Admin</title> {{-- Judul Halaman (Dinamis - default 'Admin Dashboard') --}}

    {{-- Custom fonts for this template --}}
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    {{-- Custom styles for this template --}}
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- Datatables Styles - Jika Anda menggunakan DataTables --}}
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    {{-- Custom Styles - Jika Anda memiliki style tambahan --}}
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    {{-- Page Wrapper --}}
    <div id="wrapper">

        {{-- Sidebar --}}
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            {{-- Sidebar - Brand --}}
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i> {{-- Ikon Brand (Font Awesome) --}}
                </div>
                <div class="sidebar-brand-text mx-3">Admin Panel <sup></sup></div> {{-- Teks Brand --}}
            </a>

            {{-- Divider - Garis Pembatas --}}
            <hr class="sidebar-divider my-0">

            {{-- Nav Item - Dashboard --}}
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i> {{-- Ikon Dashboard (Font Awesome) --}}
                    <span>Dashboard</span> {{-- Teks Menu Dashboard --}}
                </a>
            </li>

            {{-- Divider --}}
            <hr class="sidebar-divider">

            {{-- Heading - Menu Utama --}}
            <div class="sidebar-heading">
                Menu Utama
            </div>

            {{-- Nav Item - Users Menu --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="fas fa-fw fa-users"></i> {{-- Ikon User (Font Awesome) --}}
                    <span>Manajemen User</span> {{-- Teks Menu User --}}
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opsi User:</h6>
                        <a class="collapse-item" href="{{ route('admin.users.index') }}">Daftar User</a> {{-- Submenu Daftar User --}}
                        <a class="collapse-item" href="{{ route('admin.users.create') }}">Tambah User</a> {{-- Submenu Tambah User --}}
                    </div>
                </div>
            </li>

            {{-- Nav Item - Categories Menu --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories"
                    aria-expanded="true" aria-controls="collapseCategories">
                    <i class="fas fa-fw fa-list-alt"></i> {{-- Ikon Kategori (Font Awesome) --}}
                    <span>Manajemen Kategori</span> {{-- Teks Menu Kategori --}}
                </a>
                <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opsi Kategori:</h6>
                        <a class="collapse-item" href="{{ route('admin.categories.index') }}">Daftar Kategori</a> {{-- Submenu Daftar Kategori --}}
                        <a class="collapse-item" href="{{ route('admin.categories.create') }}">Tambah Kategori</a> {{-- Submenu Tambah Kategori --}}
                    </div>
                </div>
            </li>

            {{-- Nav Item - Posts Menu --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePosts"
                    aria-expanded="true" aria-controls="collapsePosts">
                    <i class="fas fa-fw fa-file-alt"></i> {{-- Ikon Postingan (Font Awesome) --}}
                    <span>Manajemen Postingan</span> {{-- Teks Menu Postingan --}}
                </a>
                <div id="collapsePosts" class="collapse" aria-labelledby="headingPosts" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opsi Postingan:</h6>
                        <a class="collapse-item" href="{{ route('admin.posts.index') }}">Daftar Postingan</a> {{-- Submenu Daftar Postingan --}}
                        <a class="collapse-item" href="{{ route('admin.posts.create') }}">Tambah Postingan</a> {{-- Submenu Tambah Postingan --}}
                    </div>
                </div>
            </li>

            {{-- Nav Item - Registrations Menu --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRegistrations"
                    aria-expanded="true" aria-controls="collapseRegistrations">
                    <i class="fas fa-fw fa-user-plus"></i> {{-- Ikon Pendaftaran (Font Awesome) --}}
                    <span>Manajemen Pendaftaran</span> {{-- Teks Menu Pendaftaran --}}
                </a>
                <div id="collapseRegistrations" class="collapse" aria-labelledby="headingRegistrations"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opsi Pendaftaran:</h6>
                        <a class="collapse-item" href="{{ route('admin.registrations.index') }}">Daftar Pendaftaran</a> {{-- Submenu Daftar Pendaftaran --}}
                        {{-- Contoh Jika Anda ingin menambahkan fitur create pendaftaran di admin --}}
                        {{-- <a class="collapse-item" href="{{ route('admin.registrations.create') }}">Tambah Pendaftaran</a> --}}
                    </div>
                </div>
            </li>


            {{-- Divider --}}
            <hr class="sidebar-divider d-none d-md-block">

            {{-- Sidebar Toggler (Button untuk mengecilkan/membesarkan sidebar) --}}
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        {{-- End of Sidebar --}}

        {{-- Content Wrapper --}}
        <div id="content-wrapper" class="d-flex flex-column">

            {{-- Main Content --}}
            <div id="content">

                {{-- Topbar --}}
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    {{-- Sidebar Toggle (Topbar) --}}
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    {{-- Topbar Navbar --}}
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        {{-- Nav Item - User Information --}}
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span> {{-- Nama User yang Login --}}
                                @if(Auth::user()->profile_image_path)
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/' . Auth::user()->profile_image_path) }}"> {{-- Gambar Profil User --}}
                                @else
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('img/default_profile.png') }}"> {{-- Gambar Profil Default --}}
                                @endif
                            </a>
                            {{-- Dropdown - User Information --}}
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('admin.users.show', Auth::user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile {{-- Menu Profile --}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout {{-- Menu Logout --}}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                {{-- End of Topbar --}}

                {{-- Begin Page Content - Area Konten Utama --}}
                <div class="container-fluid">

                    {{-- Page Heading - Judul Halaman (Dinamis) --}}
                    <h1 class="h3 mb-4 text-gray-800">@yield('title', 'Dashboard')</h1>

                    {{-- Content Row - Tempat untuk konten halaman spesifik --}}
                    @yield('content') {{-- Section 'content' akan diisi dari view child --}}

                </div>
                {{-- /.container-fluid --}}

            </div>
            {{-- End of Main Content --}}

            {{-- Footer --}}
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website {{ date('Y') }}</span> {{-- Copyright Footer --}}
                    </div>
                </div>
            </footer>
            {{-- End of Footer --}}

        </div>
        {{-- End of Content Wrapper --}}

    </div>
    {{-- End of Page Wrapper --}}

    {{-- Scroll to Top Button (Saat Diklik akan scroll ke atas halaman) --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- Logout Modal - Popup Konfirmasi Logout --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5> {{-- Judul Modal Logout --}}
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div> {{-- Body Modal Logout --}}
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> {{-- Tombol Batal Logout --}}
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a> {{-- Tombol Logout & Form --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap core JavaScript --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Core plugin JavaScript --}}
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    {{-- Custom scripts for all pages --}}
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    {{-- Page level plugins --}}
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    {{-- Page level custom scripts --}}
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    {{-- Stack untuk script tambahan dari view child --}}
    @stack('scripts')


</body>

</html>