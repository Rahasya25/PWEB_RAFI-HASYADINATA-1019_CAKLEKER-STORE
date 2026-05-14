@extends('layouts.app')
@section('title', 'Edit Produk')
@section('content')
<div class="container">
    <h1>Edit Produk</h1>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3"><label>Kode Produk</label><input type="text" name="kode_produk" value="{{ old('kode_produk', $produk->kode_produk) }}" class="form-control" required></div>
        <div class="mb-3"><label>Nama Produk</label><input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="form-control" required></div>
        <div class="mb-3"><label>Kategori</label><input type="text" name="kategori" value="{{ old('kategori', $produk->kategori) }}" class="form-control" required></div>
        <div class="mb-3"><label>Stok</label><input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="form-control" required></div>
        <div class="mb-3"><label>Harga</label><input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="form-control" required></div>
        <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control">{{ old('deskripsi', $produk->deskripsi) }}</textarea></div>
        <div class="mb-3"><label>Foto saat ini</label><br>@if($produk->foto)<img src="{{ asset('storage/'.$produk->foto) }}" width="100">@endif</div>
        <div class="mb-3"><label>Ganti Foto</label><input type="file" name="foto" class="form-control"></div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
