@extends('layouts.app')
@section('title', 'Daftar Produk')

@push('styles')
<style>
    .produk-section {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 32px;
    }
    .section-title {
        border-left: 4px solid #DC0000;
        padding-left: 20px;
    }
    .section-title h1 {
        font-size: 32px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: white;
    }
    .section-title p {
        color: #888;
        font-size: 12px;
        letter-spacing: 1px;
        margin-top: 6px;
        text-transform: uppercase;
    }
    .btn-add {
        background: #DC0000;
        color: white;
        padding: 12px 28px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: background 0.2s, transform 0.1s;
    }
    .btn-add:hover { background: #FF1E1E; transform: translateY(-1px); }
    .table-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }
    table { width: 100%; border-collapse: collapse; }
    thead tr {
        background: rgba(220,0,0,0.15);
        border-bottom: 1px solid rgba(220,0,0,0.3);
    }
    thead th {
        padding: 16px 20px;
        text-align: left;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #FFD700;
    }
    tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.05);
        transition: background 0.15s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: rgba(255,255,255,0.04); }
    tbody td {
        padding: 16px 20px;
        font-size: 14px;
        color: #ddd;
        vertical-align: middle;
    }
    .produk-foto {
        width: 48px; height: 48px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .foto-placeholder {
        width: 48px; height: 48px;
        background: rgba(255,255,255,0.06);
        border-radius: 4px;
        border: 1px dashed rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
    }
    .badge-kategori {
        background: rgba(255,215,0,0.1);
        color: #FFD700;
        border: 1px solid rgba(255,215,0,0.2);
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .stok-ok { color: #4CAF50; font-weight: 600; }
    .stok-low { color: #FF9800; font-weight: 600; }
    .stok-empty { color: #FF5252; font-weight: 600; }
    .aksi-group { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
    .btn-detail, .btn-edit, .btn-hapus {
        padding: 6px 14px;
        border-radius: 3px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: opacity 0.2s;
    }
    .btn-detail { background: rgba(255,255,255,0.08); color: #ddd; }
    .btn-detail:hover { background: rgba(255,255,255,0.15); }
    .btn-edit { background: rgba(255,215,0,0.15); color: #FFD700; }
    .btn-edit:hover { background: rgba(255,215,0,0.25); }
    .btn-hapus { background: rgba(220,0,0,0.15); color: #FF5252; }
    .btn-hapus:hover { background: rgba(220,0,0,0.3); }
    .pagination-wrap {
        padding: 24px 20px;
        border-top: 1px solid rgba(255,255,255,0.06);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
    }
    .pagination-wrap a,
    .pagination-wrap span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 12px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
        border: 1px solid rgba(255,255,255,0.1);
        color: #aaa;
        background: rgba(255,255,255,0.05);
    }
    .pagination-wrap a:hover {
        background: rgba(255,255,255,0.12);
        color: white;
    }
    .pagination-wrap span[aria-current="page"] {
        background: #DC0000;
        border-color: #DC0000;
        color: white;
    }
    .pagination-wrap span.disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #555;
    }
    .empty-state .empty-icon { font-size: 48px; margin-bottom: 16px; }
    .empty-state p { font-size: 14px; letter-spacing: 1px; }
    @media (max-width: 768px) {
        .section-header { flex-direction: column; align-items: flex-start; gap: 20px; }
    }
</style>
@endpush

@section('content')
<div class="produk-section">
    <div class="section-header">
        <div class="section-title">
            <h1>Katalog Produk</h1>
            <p>{{ $produk->total() }} produk terdaftar</p>
        </div>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('produk.create') }}" class="btn-add">+ Tambah Produk</a>
        @endif
    </div>

    <div class="table-card">
        @if($produk->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $item)
                <tr>
                    <td>
                        @if($item->foto_produk)
                            <img src="{{ asset('storage/'.$item->foto_produk) }}" class="produk-foto" alt="{{ $item->nama_produk }}">
                        @else
                            <div class="foto-placeholder">🏎️</div>
                        @endif
                    </td>
                    <td style="font-family: monospace; color: #888; font-size: 13px;">{{ $item->kode_produk }}</td>
                    <td style="font-weight: 600; color: white;">{{ $item->nama_produk }}</td>
                    <td><span class="badge-kategori">{{ $item->kategori }}</span></td>
                    <td>
                        @if($item->stok_produk == 0)
                            <span class="stok-empty">Habis</span>
                        @elseif($item->stok_produk <= 5)
                            <span class="stok-low">{{ $item->stok_produk }} (Low)</span>
                        @else
                            <span class="stok-ok">{{ $item->stok_produk }}</span>
                        @endif
                    </td>
                    <td style="font-weight: 600;">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                    <td>
                        <div class="aksi-group">
                            <a href="{{ route('produk.show', $item->id) }}" class="btn-detail">Detail</a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($produk->hasPages())
        <div class="pagination-wrap">
            @if($produk->onFirstPage())
                <span class="disabled">&#8592;</span>
            @else
                <a href="{{ $produk->previousPageUrl() }}">&#8592;</a>
            @endif

            @foreach($produk->getUrlRange(1, $produk->lastPage()) as $page => $url)
                @if($page == $produk->currentPage())
                    <span aria-current="page">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($produk->hasMorePages())
                <a href="{{ $produk->nextPageUrl() }}">&#8594;</a>
            @else
                <span class="disabled">&#8594;</span>
            @endif
        </div>
        @endif
        @else
        <div class="empty-state">
            <div class="empty-icon">🏎️</div>
            <p>Belum ada produk. Tambahkan produk pertama!</p>
        </div>
        @endif
    </div>
</div>
@endsection
