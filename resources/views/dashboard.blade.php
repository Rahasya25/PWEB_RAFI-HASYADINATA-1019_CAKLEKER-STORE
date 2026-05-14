@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="hero-content" style="margin-top: 320px;">
    <div>
        <a href="{{ route('produk.index') }}" class="btn btn-primary">
            Halo {{ auth()->user()->name }}, ayo jelajahi toko!
        </a>
    </div>
    <p class="hero-desc">
        Cakleker Store adalah toko merchandise Scuderia Ferrari terpercaya di Indonesia.
        Temukan koleksi eksklusif kaos, topi, diecast, dan aksesoris untuk para Tifosi sejati.
    </p>
    <div class="hero-stats">
        <div>
            <div class="stat-number">5+</div>
            <div class="stat-label">Tahun Berdiri</div>
        </div>
        <div>
            <div class="stat-number">200</div>
            <div class="stat-label">Tifosi Puas</div> {{-- Perbaiki typo "Piala" menjadi "Puas" --}}
        </div>
    </div>
    <div class="hero-promo">
        🏎️ Gratis ongkir untuk pembelian di atas Rp500.000 &nbsp;•&nbsp; Garansi original merchandise 🏎️
    </div>
</div>
@endsection
