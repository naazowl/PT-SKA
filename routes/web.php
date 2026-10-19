<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\ContactMessageController;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profile'])->name('profile');
Route::get('/layanan', [PublicController::class, 'products'])->name('products');
Route::get('/layanan/{product}', [PublicController::class, 'productDetail'])->name('products.show');
Route::get('/artikel', [PublicController::class, 'articles'])->name('articles');
Route::get('/artikel/{article}', [PublicController::class, 'articleDetail'])->name('articles.show');
Route::get('/galeri', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/kontak', [PublicController::class, 'contact'])->name('contact');

// Maksimal 5 pesan per menit per IP supaya tidak mudah di-spam
Route::post('/kontak/kirim', [ContactController::class, 'send'])
    ->middleware('throttle:5,1')
    ->name('contact.send');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Wajib login admin
    Route::middleware('admin.auth')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('produk', ProductController::class)
            ->except(['show'])
            ->parameters(['produk' => 'product']);

        Route::resource('artikel', ArticleController::class)
            ->except(['show'])
            ->parameters(['artikel' => 'article']);

        Route::resource('galeri', GalleryController::class)
            ->except(['show'])
            ->parameters(['galeri' => 'gallery']);

        Route::get('/profil-perusahaan', [CompanyProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil-perusahaan', [CompanyProfileController::class, 'update'])->name('profile.update');

        // Pesan dari halaman kontak
        Route::get('/pesan', [ContactMessageController::class, 'index'])->name('pesan.index');
        Route::get('/pesan/{pesan}', [ContactMessageController::class, 'show'])->name('pesan.show');
        Route::patch('/pesan/{pesan}/toggle', [ContactMessageController::class, 'toggleRead'])->name('pesan.toggle');
        Route::delete('/pesan/{pesan}', [ContactMessageController::class, 'destroy'])->name('pesan.destroy');

       });
});