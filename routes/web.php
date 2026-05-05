<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HitungController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dashboard'));

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::view('/tentang', 'tentang')->name('tentang');
Route::get('/hitung', [HitungController::class, 'index'])->name('hitung');
Route::view('/kontak', 'kontak')->name('kontak');
Route::get('/test-flash', function () {
    session()->flash('success', 'Ini adalah pesan sukses! Anda berhasil melakukan sesuatu.');
    session()->flash('error', 'Terjadi kesalahan, coba lagi.');
    return redirect()->route('dashboard');
});
