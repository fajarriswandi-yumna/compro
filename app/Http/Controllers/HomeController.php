<?php

namespace App\Http\Controllers;

use App\Models\Post; // Import model Post
use App\Models\User; // Import model User
use App\Models\Registration; // Import model User
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        // Ambil total jumlah postingan
        $totalPosts = Post::count();

        // Ambil total jumlah pengguna
        $totalUsers = User::count();

        // Asumsikan "Total pendaftaran" sama dengan total pengguna (jika berbeda, sesuaikan query)
        $totalRegistrations = Registration::count();

        return view('home', [ // Kirim data ke view 'home' menggunakan array asosiatif
            'totalPosts' => $totalPosts,
            'totalUsers' => $totalUsers,
            'totalRegistrations' => $totalRegistrations,
        ]);
    }
}
