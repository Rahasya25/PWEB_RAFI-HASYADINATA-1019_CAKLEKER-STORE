@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="hero-content">
    <h1>Selamat Datang di Cakleker Store</h1>
    <a href="{{ route('tentang') }}" class="btn">Pelajari Lebih Lanjut</a>
</div>
@endsection
