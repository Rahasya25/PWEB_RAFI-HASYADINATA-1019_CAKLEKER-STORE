@extends('layouts.app')
@section('title', 'Edit Produk')

@push('styles')
<style>
    .form-section {
        max-width: 720px;
        margin: 60px auto;
        padding: 0 20px;
    }
    .form-header {
        margin-bottom: 40px;
        border-left: 4px solid #FFD700;
        padding-left: 20px;
    }
    .form-header h1 {
        font-size: 32px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: white;
    }
    .form-header p {
        color: #888;
        font-size: 13px;
        letter-spacing: 1px;
        margin-top: 6px;
        text-transform: uppercase;
    }
    .form-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        padding: 40px;
        backdrop-filter: blur(10px);
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .form-group.full { grid-column: 1 / -1; }
    .form-group label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #FFD700;
    }
    .form-group input {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 4px;
        padding: 12px 16px;
        color: white;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        transition: border-color 0.2s, background 0.2s;
        outline: none;
        width: 100%;
    }
    .form-group input:focus {
        border-color: #FFD700;
        background: rgba(255,215,0,0.04);
    }
    .form-group input::placeholder { color: #555; }
    .form-group input[type="file"] {
        padding: 10px 16px;
        cursor: pointer;
        color: #aaa;
    }
    .form-group input[type="file"]::-webkit-file-upload-button {
        background: rgba(255,215,0,0.2);
        color: #FFD700;
        border: 1px solid rgba(255,215,0,0.3);
        padding: 6px 14px;
        border-radius: 3px;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        margin-right: 12px;
    }
    .error-msg { font-size: 11px; color: #FF6B6B; margin-top: 4px; }
    .foto-preview {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 8px;
    }
    .foto-preview img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.15);
    }
    .foto-preview span {
        font-size: 11px;
        color: #888;
        letter-spacing: 1px;
    }
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 32px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    .btn-submit {
        background: #FFD700;
        color: #0D0D0D;
        border: none;
        padding: 14px 36px;
        border-radius: 4px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
    }
    .btn-submit:hover { background: #FFC200; transform: translateY(-1px); }
    .btn-cancel {
        background: transparent;
        color: #aaa;
        border: 1px solid rgba(255,255,255,0.15);
        padding: 14px 36px;
        border-radius: 4px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        transition: border-color 0.2s, color 0.2s;
        display: inline-flex;
        align-items: center;
    }
    .btn-cancel:hover { border-color: white; color: white; }
    @media (max-width: 600px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-card { padding: 24px; }
    }
</style>
@endpush

@section('content')
<div class="form-section">
    <div class="form-header">
        <h1>Edit Produk</h1>
        <p>{{ $produk->kode_produk }} — Perbarui informasi produk</p>
    </div>

    <div class="form-card">
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid">

                <div class="form-group">
                    <label>Kode Produk</label>
                    <input type="text" name="kode_produk" value="{{ old('kode_produk', $produk->kode_produk) }}" required>
                    @error('kode_produk') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                    @error('nama_produk') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $produk->kategori) }}" required>
                    @error('kategori') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $produk->tanggal_masuk->format('Y-m-d')) }}" required>
                    @error('tanggal_masuk') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok_produk" value="{{ old('stok_produk', $produk->stok_produk) }}" min="0" required>
                    @error('stok_produk') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga_produk" value="{{ old('harga_produk', $produk->harga_produk) }}" min="1" required>
                    @error('harga_produk') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full">
                    <label>Ganti Foto Produk</label>
                    <input type="file" name="foto_produk" accept="image/jpg,image/jpeg,image/png">
                    @if($produk->foto_produk)
                        <div class="foto-preview">
                            <img src="{{ asset('storage/'.$produk->foto_produk) }}" alt="Foto saat ini">
                            <span>Foto saat ini — upload baru untuk mengganti</span>
                        </div>
                    @endif
                    @error('foto_produk') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Update Produk</button>
                <a href="{{ route('produk.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
