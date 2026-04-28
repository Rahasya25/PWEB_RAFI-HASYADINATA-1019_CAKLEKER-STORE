@extends('layouts.app')

@section('title', 'Kalkulator Sederhana')

@section('content')
<div class="hero-content">
    <h1>Kalkulator Penjumlahan</h1>
    <form method="GET" action="{{ route('hitung') }}">
        <input type="number" name="a" placeholder="Angka pertama" value="{{ request('a') }}" required style="padding: 10px; margin: 5px;">
        <input type="number" name="b" placeholder="Angka kedua" value="{{ request('b') }}" required style="padding: 10px; margin: 5px;">
        <button type="submit" class="btn" style="padding: 10px 20px;">Hitung</button>
    </form>
    @if(isset($hasil))
        <h2>Hasil: {{ $hasil }}</h2>
    @endif
</div>
@endsection
