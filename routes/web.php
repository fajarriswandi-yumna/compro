<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationPublicController;
use App\Http\Controllers\PublicBlogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\ClientRegisterController;
use App\Http\Controllers\Admin\BillController;

// Route Otentikasi (Login, Register, dll.) - Jika belum ada, bisa generate menggunakan Breeze atau Jetstream atau buat manual.
Auth::routes(); // Jika menggunakan Auth::routes() default Laravel
// Atau definisikan route login/register manual jika custom

Route::get('/', function () {
    return view('welcome'); // Atau view homepage company profile Anda
});

// Route untuk tampilan tagihan klien (TANPA LOGIN)
Route::get('/client/bills/{bill}', [BillController::class, 'showClient'])->name('client.bills.show');

// Routes Pendaftaran Klien Publik (TANPA LOGIN)
Route::get('/client/register', [ClientRegisterController::class, 'showRegistrationForm'])->name('client.registration.form');

Route::post('/client/register', [ClientRegisterController::class, 'register'])->name('client.registration.submit');
Route::get('/client/verify-email/{token}', [ClientRegisterController::class, 'verify'])->name('client.registration.verify'); // <-- UBAH 'verifyEmail' menjadi 'verify'
Route::get('/client/verification-success', [ClientRegisterController::class, 'showVerificationSuccess'])->name('client.registration.success');
Route::get('/client/registration-pending', [ClientRegisterController::class, 'showRegistrationPending'])->name('client.registration.pending');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('/users', UserController::class)->names('admin.users');
    Route::resource('/categories', CategoryController::class)->names('admin.categories');
    Route::resource('/posts', PostController::class)->names('admin.posts');
    Route::get('/posts/{slug}', [App\Http\Controllers\Admin\PostController::class, 'showBySlug'])->name('admin.posts.detail');
    Route::resource('clients', ClientController::class)->names('admin.clients'); // Resource routes untuk ClientController di namespace Admin
    Route::get('/posts/search', [App\Http\Controllers\Admin\PostController::class, 'search'])->name('admin.posts.search'); // Route untuk search
    Route::resource('/registrations', RegistrationController::class)->names('admin.registrations');
    
    Route::get('/bills/{bill}/download-pdf', [BillController::class, 'downloadPdf'])->name('admin.bills.download-pdf'); // Route untuk download pdf
    Route::post('/bills/{bill}/send-email', [BillController::class, 'sendEmail'])->name('admin.bills.send-email'); // Route untuk kirim email (POST)
    Route::resource('bills', BillController::class)->names('admin.bills');
    
});

Route::middleware('auth')->group(function () { // Gunakan middleware 'auth' agar hanya user yang login bisa mengakses
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Route untuk menampilkan form edit profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Route untuk menangani update data profile
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update'); // Route khusus untuk update password
});

Route::get('/layanan-pendaftaran', [RegistrationPublicController::class, 'create'])->name('registration.public.create');
Route::post('/layanan-pendaftaran', [RegistrationPublicController::class, 'store'])->name('registration.public.store');

// Route untuk halaman Invoice Pembayaran
Route::get('/invoice-pembayaran/{registration}', [RegistrationPublicController::class, 'showInvoice'])->name('registration.public.invoice');

// Blog public
Route::get('/blog', [PublicBlogController::class, 'index'])->name('blog.index'); // Route untuk halaman daftar artikel blog
Route::get('/blog/{slug}', [PublicBlogController::class, 'show'])->name('blog.show');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
