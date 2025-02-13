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