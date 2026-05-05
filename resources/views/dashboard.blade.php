@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="hero-content">
    <h1>Selamat Datang di Cakleker Store</h1>
    <a href="{{ route('tentang') }}" class="btn">Pelajari Lebih Lanjut</a>
    <div style="display: flex; gap: 20px; flex-wrap: wrap; justify-content: center; margin: 30px 0;">
        @forelse($dataStatistik as $stat)
            <x-stat-card :judul="$stat->judul" :nilai="$stat->nilai" :ikon="$stat->ikon" :warna="$stat->warna" />
        @empty
            <p>Belum ada data statistik.</p>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
    console.log('Dashboard siap');
</script>
@endpush
@endsection
