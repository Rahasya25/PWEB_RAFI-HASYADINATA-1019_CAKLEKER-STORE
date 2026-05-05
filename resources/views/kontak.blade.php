@extends('layouts.app')
@section('title', 'Kontak')
@section('content')
<div class="hero-content">
    <h1>Hubungi Kami</h1>
    <p>Email: info@caklekerstore.com</p>
    <p>Telepon: +62 21 12345678</p>
</div>

@push('scripts')
<script>
    console.log('Halaman Kontak dimuat');
</script>
@endpush
@endsection
