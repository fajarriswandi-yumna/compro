<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Aksara') }} - Transformasi Digital Pendidikan</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <x-head.tinymce-config />
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top">
            <div class="container">
                <a class="navbar-brand logoNavbar" href="{{ url('/') }}">
                    <img src="{{ asset('images/logoSmall.png') }}" alt="{{ config('app.name', 'Aksara') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav navbarMenu me-auto">
                        <li><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item dropdown">
                            <a id="CategoriesDropdown" class="nav-link dropdown-toggle {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Blog</a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="CategoriesDropdown">
                                <a class="dropdown-item {{ request()->routeIs('admin.posts.index') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">Posts</a>
                                <a class="dropdown-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Categories</a>
                            </div>
                        </li>
                        <li><a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a></li>
                        <li><a class="nav-link {{ request()->routeIs('admin.clients.index') ? 'active' : '' }}" href="{{ route('admin.clients.index') }}">Clients</a></li>
                        <li><a class="nav-link {{ request()->routeIs('admin.bills.index') ? 'active' : '' }}" href="{{ route('admin.bills.index') }}">Bills</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="{{ route('admin.registrations.index') }}">Registrations</a></li> -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto navBarRightMenu">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        <!-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif -->
                        @else
                        <li class="nav-item">
                            <a href="" class="nav-link navIcon"><iconify-icon icon="proicons:bell-dot" width="24" height="24"></iconify-icon></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link navIcon" id="darkModeToggle">
                                <iconify-icon icon="tdesign:mode-dark" width="24" height="24"></iconify-icon>
                            </a>
                        </li>

                        <li class="nav-item dropdown userDropdown">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="">{{ Auth::user()->name }}</span>
                                <span class="avatar-container">
                                    <img src="{{ Auth::user()->profile_image_path ? asset('storage/' . Auth::user()->profile_image_path) : asset('images/emptyImage.png') }}"
                                        class="rounded-circle profile-avatar" alt="{{ Auth::user()->name }}" width="50" height="50">
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"> {{-- Tambahkan link ke profile.edit --}}
                                    {{ __('Profil Saya') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>



        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <x-forms.tinymce-editor />
    {{-- Script Iconify CDN (sebelum </body>) --}}
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar'); // Pilih navbar berdasarkan class 'navbar'

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) { // Ubah angka 50 sesuai dengan posisi scroll yang Anda inginkan untuk memicu "onScroll"
                    navbar.classList.add('onScroll'); // Tambahkan class 'onScroll'
                } else {
                    navbar.classList.remove('onScroll'); // Hapus class 'onScroll'
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle'); // Tombol Toggle Dark Mode
            const body = document.body; // Elemen <body>

            // Fungsi untuk mengaktifkan Dark Mode
            const enableDarkMode = () => {
                body.classList.add('dark-mode'); // Tambahkan class 'dark-mode' ke <body>
                localStorage.setItem('darkModeEnabled', 'true'); // Simpan preferensi di localStorage
            };

            // Fungsi untuk menonaktifkan Dark Mode
            const disableDarkMode = () => {
                body.classList.remove('dark-mode'); // Hapus class 'dark-mode' dari <body>
                localStorage.setItem('darkModeEnabled', 'false'); // Simpan preferensi di localStorage
            };

            // Cek preferensi Dark Mode dari localStorage saat halaman di-load
            if (localStorage.getItem('darkModeEnabled') === 'true') {
                enableDarkMode(); // Aktifkan dark mode jika preferensi di localStorage true
            }

            // Event listener untuk tombol toggle dark mode
            darkModeToggle.addEventListener('click', (event) => {
                event.preventDefault(); // Mencegah link dari berpindah halaman (karena href="#")

                if (body.classList.contains('dark-mode')) {
                    disableDarkMode(); // Jika dark mode aktif, nonaktifkan
                } else {
                    enableDarkMode(); // Jika dark mode tidak aktif, aktifkan
                }
            });
        });
    </script>
</body>

</html>