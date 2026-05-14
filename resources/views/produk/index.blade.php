@extends('layouts.app')
@section('title', 'Daftar Produk')
@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Produk</h1>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-dark table-striped">
        <thead>
            <tr><th>Kode</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Harga</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
            <tr>
                <td>{{ $item->kode_produk }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->stok }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('produk.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $produk->links() }}
</div>
@endsection
