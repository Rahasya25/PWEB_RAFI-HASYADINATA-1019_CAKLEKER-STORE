@extends('layouts.app')
@section('title', 'Detail Produk')

@push('styles')
<style>
    .detail-section {
        max-width: 900px;
        margin: 60px auto;
        padding: 0 20px;
    }
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #888;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 32px;
        transition: color 0.2s;
    }
    .back-link:hover { color: white; }
    .detail-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        display: grid;
        grid-template-columns: 320px 1fr;
    }
    .detail-foto {
        background: rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 320px;
        border-right: 1px solid rgba(255,255,255,0.06);
    }
    .detail-foto img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .detail-foto .no-foto {
        font-size: 80px;
        opacity: 0.3;
    }
    .detail-info {
        padding: 40px;
    }
    .produk-kode {
        font-family: monospace;
        font-size: 12px;
        color: #DC0000;
        letter-spacing: 2px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .produk-nama {
        font-size: 28px;
        font-weight: 700;
        color: white;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }
    .produk-kategori {
        display: inline-block;
        background: rgba(255,215,0,0.1);
        color: #FFD700;
        border: 1px solid rgba(255,215,0,0.2);
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 32px;
    }
    .divider {
        height: 1px;
        background: rgba(255,255,255,0.06);
        margin-bottom: 32px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
    }
    .info-item {}
    .info-item .info-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #666;
        margin-bottom: 6px;
    }
    .info-item .info-value {
        font-size: 18px;
        font-weight: 700;
        color: white;
    }
    .info-item .info-value.harga { color: #DC0000; font-size: 22px; }
    .info-item .info-value.stok-ok { color: #4CAF50; }
    .info-item .info-value.stok-low { color: #FF9800; }
    .info-item .info-value.stok-empty { color: #FF5252; }
    .detail-actions {
        display: flex;
        gap: 12px;
        padding-top: 24px;
        border-top: 1px solid rgba(255,255,255,0.06);
    }
    .btn-edit-detail {
        background: rgba(255,215,0,0.15);
        color: #FFD700;
        border: 1px solid rgba(255,215,0,0.3);
        padding: 12px 28px;
        border-radius: 4px;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-edit-detail:hover { background: rgba(255,215,0,0.25); }
    .btn-hapus-detail {
        background: rgba(220,0,0,0.15);
        color: #FF5252;
        border: 1px solid rgba(220,0,0,0.3);
        padding: 12px 28px;
        border-radius: 4px;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-hapus-detail:hover { background: rgba(220,0,0,0.3); }
    @media (max-width: 700px) {
        .detail-card { grid-template-columns: 1fr; }
        .detail-foto { min-height: 220px; }
        .info-grid { grid-template-columns: 1fr; }
        .detail-info { padding: 24px; }
    }
</style>
@endpush

@section('content')
<div class="detail-section">
    <a href="{{ route('produk.index') }}" class="back-link">← Kembali ke Katalog</a>

    <div class="detail-card">
        <div class="detail-foto">
            @if($produk->foto_produk)
                <img src="{{ asset('storage/'.$produk->foto_produk) }}" alt="{{ $produk->nama_produk }}">
            @else
                <div class="no-foto">🏎️</div>
            @endif
        </div>

        <div class="detail-info">
            <div class="produk-kode">{{ $produk->kode_produk }}</div>
            <div class="produk-nama">{{ $produk->nama_produk }}</div>
            <div class="produk-kategori">{{ $produk->kategori }}</div>

            <div class="divider"></div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Harga</div>
                    <div class="info-value harga">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Stok</div>
                    <div class="info-value
                        @if($produk->stok_produk == 0) stok-empty
                        @elseif($produk->stok_produk <= 5) stok-low
                        @else stok-ok @endif">
                        @if($produk->stok_produk == 0) Habis
                        @elseif($produk->stok_produk <= 5) {{ $produk->stok_produk }} (Low Stock)
                        @else {{ $produk->stok_produk }} unit @endif
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Masuk</div>
                    <div class="info-value" style="font-size: 16px;">{{ $produk->tanggal_masuk->format('d F Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Terakhir Diupdate</div>
                    <div class="info-value" style="font-size: 16px;">{{ $produk->updated_at->format('d F Y') }}</div>
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
            <div class="detail-actions">
                <a href="{{ route('produk.edit', $produk->id) }}" class="btn-edit-detail">Edit Produk</a>
                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-hapus-detail">Hapus Produk</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
