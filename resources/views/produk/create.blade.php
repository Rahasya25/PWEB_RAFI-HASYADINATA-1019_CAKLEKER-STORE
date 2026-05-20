@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        @csrf
        <div class="mb-4"><label class="block font-medium mb-1 dark:text-white">Kode Produk</label><input type="text" name="kode_produk" class="w-full border p-2 rounded dark:bg-gray-700 dark:border-gray-600" required></div>
        <div class="mb-4"><label class="block font-medium mb-1 dark:text-white">Nama Produk</label><input type="text" name="nama_produk" class="w-full border p-2 rounded dark:bg-gray-700 dark:border-gray-600" required></div>
        <div class="mb-4"><label class="block font-medium mb-1 dark:text-white">Kategori</label><input type="text" name="kategori" class="w-full border p-2 rounded dark:bg-gray-700 dark:border-gray-600" required></div>
        <div class="mb-4"><label class="block font-medium mb-1 dark:text-white">Tanggal Masuk</label><input type="date" name="tanggal_masuk" class="w-full border p-2 rounded dark:bg-gray-700 dark:border-gray-600" required></div>
        <div class="mb-4"><label class="block font-medium mb-1 dark:text-white">Stok</label><input type="number" name="stok_produk" class="w-full border p-2 rounded dark:bg-gray-700 dark:border-gray-600" required></div>
        <div class="mb-4"><label class="block font-medium mb-1 dark:text-white">Harga</label><input type="number" name="harga_produk" class="w-full border p-2 rounded dark:bg-gray-700 dark:border-gray-600" required></div>
        <div class="mb-4"><label class="block font-medium mb-1 dark:text-white">Foto</label><input type="file" name="foto_produk" class="w-full border p-2 rounded dark:bg-gray-700 dark:border-gray-600"></div>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
