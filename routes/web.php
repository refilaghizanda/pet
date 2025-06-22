<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HewanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\TransaksiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Pelanggan\DashboardController;
use App\Http\Controllers\Pelanggan\HewanPelangganController;
use App\Http\Controllers\Pelanggan\PesananPelangganController;
use App\Http\Controllers\Pelanggan\TransaksiPelangganController;
use App\Http\Controllers\Pelanggan\ProfileController;

// auth routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'doLogin']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'doRegister']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('layanans', LayananController::class);
    Route::resource('hewans', HewanController::class);
    Route::resource('pesanans', PesananController::class);
    Route::resource('transaksis', TransaksiController::class);
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
    Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);

    Route::get('pesanans/get-hewan/{id_user}', [PesananController::class, 'getHewanByUser'])->name('pesanans.get-hewan');
    Route::get('transaksis/get-harga/{id_pesanan}', [TransaksiController::class, 'getHargaLayanan'])->name('transaksis.get-harga');
});

// customer routes
Route::middleware(['auth', 'pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('hewans', HewanPelangganController::class);
    Route::resource('pesanans', PesananPelangganController::class);
    Route::resource('transaksis', TransaksiPelangganController::class);
    Route::resource('testimonials', App\Http\Controllers\Pelanggan\TestimonialController::class);
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('transaksis/get-harga/{id_pesanan}', [TransaksiPelangganController::class, 'getHargaLayanan'])->name('transaksis.get-harga');
});

// frontend routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blogdetails', [FrontendController::class, 'blogdetails'])->name('blogdetails');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/blog/{id}', [FrontendController::class, 'blogDetail'])->name('blog.detail');

// Route::get('/dashboard', function () {
//     return view('welcome');
// })->middleware('auth')->name('dashboard');
