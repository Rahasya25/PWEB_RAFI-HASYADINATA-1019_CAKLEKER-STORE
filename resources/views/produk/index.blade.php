@extends('layouts.app')
@section('title', 'Daftar Produk')
@section('content')
<div style="max-width: 1300px; margin: 40px auto; padding: 0 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="font-size: 32px; border-left: 4px solid #DC0000; padding-left: 20px;">Katalog Produk</h1>
        @if(auth()->user() && auth()->user()->role === 'admin')
            <a href="{{ route('produk.create') }}" class="btn" style="background: #DC0000; padding: 10px 24px;">+ Tambah Produk</a>
        @endif
    </div>

    <div class="filter-bar" style="display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap;">
        <div class="filter-group">
            <select id="filter-kategori" style="padding: 8px 16px; border-radius: 30px; background: rgba(0,0,0,0.7); color: white; border: none; outline: none;">
                <option value="">Semua Kategori</option>
                @php
                    $kategoriList = ['Race Wear', 'Daily Wear', 'Diecast & Model', 'Aksesoris', 'Limited Edition'];
                @endphp
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}">{{ $kat }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-group" style="flex-grow: 1;">
            <input type="text" id="search-input" placeholder="Cari produk..."
                   style="padding: 8px 16px; border-radius: 30px; background: rgba(0,0,0,0.7); color: white; border: none; width: 100%; max-width: 300px; outline: none;">
        </div>
    </div>

    <div style="background: var(--bg-card); border-radius: 8px; overflow: hidden; border: 1px solid var(--border-card);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(0,0,0,0.4); border-bottom: 1px solid var(--border-card);">
                    <th style="padding: 12px; color: var(--kuning);">Foto</th>
                    <th style="padding: 12px; color: var(--kuning);">Kode</th>
                    <th style="padding: 12px; color: var(--kuning);">Nama Produk</th>
                    <th style="padding: 12px; color: var(--kuning);">Kategori</th>
                    <th style="padding: 12px; color: var(--kuning);">Stok</th>
                    <th style="padding: 12px; color: var(--kuning);">Harga</th>
                    <th style="padding: 12px; color: var(--kuning);">Tanggal Masuk</th>
                    <th style="padding: 12px; color: var(--kuning);">Aksi</th>
                </tr>
            </thead>
            <tbody id="produk-tbody">
                {{-- Menggunakan sub-folder partials --}}
                @include('produk.partials.produk_rows', ['produk' => $produk])
            </tbody>
        </table>

        <div id="pagination-links" style="padding: 15px; display: flex; justify-content: center;">
            {{ $produk->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let searchTimeout;
        const filterKategori = document.getElementById('filter-kategori');
        const searchInput = document.getElementById('search-input');
        const tbody = document.getElementById('produk-tbody');
        const paginationDiv = document.getElementById('pagination-links');

        async function fetchProduk() {
            const kategori = filterKategori.value;
            const keyword = searchInput.value;

            tbody.innerHTML = '<tr><td colspan="8" style="text-align:center; padding: 25px; color: var(--kuning);">Memuat data katalog...</td></tr>';

            try {
                const response = await fetch('{{ route("produk.search") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest', // Deteksi AJAX oleh Laravel
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ kategori: kategori, keyword: keyword })
                });

                if (!response.ok) {
                    throw new Error(`HTTP Error: ${response.status}`);
                }

                const data = await response.json();

                if (data.rows !== undefined) {
                    tbody.innerHTML = data.rows;
                    paginationDiv.innerHTML = data.pagination || '';
                } else {
                    throw new Error('Respon data dari server kosong.');
                }
            } catch (error) {
                console.error('Fetch error:', error);
                tbody.innerHTML = '<tr><td colspan="8" style="text-align:center; color:#FF1E1E; padding: 25px; font-weight:bold;">❌ Gagal memuat data live search. Silakan coba beberapa saat lagi.</td></tr>';
            }
        }

        filterKategori.addEventListener('change', fetchProduk);
        searchInput.addEventListener('input', () => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(fetchProduk, 300);
        });
    });
</script>
@endpush
@endsection
