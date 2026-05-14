@extends('layouts.app')
@section('title', 'Detail Produk')
@section('content')
<div class="container">
    <h1>Detail Produk</h1>
    <p><strong>Kode:</strong> {{ $produk->kode_produk }}</p>
    <p><strong>Nama:</strong> {{ $produk->nama_produk }}</p>
    <p><strong>Kategori:</strong> {{ $produk->kategori }}</p>
    <p><strong>Stok:</strong> {{ $produk->stok }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
    <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
    @if($produk->foto) <img src="{{ asset('storage/'.$produk->foto) }}" width="200"> @endif
    <br><a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
