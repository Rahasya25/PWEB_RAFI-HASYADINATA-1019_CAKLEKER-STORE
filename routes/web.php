<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman root: redirect berdasarkan role jika sudah login, else welcome
Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        return redirect()->route($role === 'admin' ? 'admin.dashboard' : 'dashboard');
    }
    return view('welcome');
});

// Dashboard untuk semua user yang login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route untuk produk (customer: hanya index dan show)
Route::middleware(['auth'])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
});

Route::get('/produk/create-test', function() {
    return 'OK';
});

// Route untuk manajemen produk (admin: full CRUD) – menggunakan resource tanpa index dan show
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('produk', ProdukController::class)->except(['index', 'show']);
});

// Halaman lain
Route::get('/manajemen', function () {
    return view('manajemen');
})->middleware(['auth'])->name('manajemen');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/pembelian', function () {
    return view('pembelian');
})->middleware(['auth'])->name('pembelian');

// Admin dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Profile routes (dari Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autentikasi Breeze (login, register, dll)
require __DIR__.'/auth.php';
