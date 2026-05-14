<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/produk/create', function () {
    return 'ROUTE WORKS!';
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ✅ Route yang bisa diakses semua user login (customer & admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');

    Route::view('/pembelian', 'pembelian')->name('pembelian');
    Route::view('/tentang', 'tentang')->name('tentang');
    Route::view('/manajemen', 'manajemen')->name('manajemen');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Route khusus admin — pakai middleware cek.admin
Route::middleware(['auth', 'cek.admin'])->group(function () {
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

require __DIR__.'/auth.php';
