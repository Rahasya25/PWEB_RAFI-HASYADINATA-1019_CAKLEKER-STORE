@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('content')
<div class="container">
    <h1>Tambah Produk Baru</h1>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3"><label>Kode Produk</label><input type="text" name="kode_produk" class="form-control" required></div>
        <div class="mb-3"><label>Nama Produk</label><input type="text" name="nama_produk" class="form-control" required></div>
        <div class="mb-3"><label>Kategori</label><input type="text" name="kategori" class="form-control" required></div>
        <div class="mb-3"><label>Stok</label><input type="number" name="stok" class="form-control" required></div>
        <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" required></div>
        <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"></textarea></div>
        <div class="mb-3"><label>Foto</label><input type="file" name="foto" class="form-control"></div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
