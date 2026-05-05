@extends('layouts.app')

@section('title', 'Tentang Cakleker Store')

@section('content')
<div class="hero-content">
    <h1>Tentang Cakleker Store</h1>
    <div style="text-align: left; max-width: 800px; margin: 30px auto; background: rgba(0,0,0,0.5); padding: 30px; border-radius: 16px; backdrop-filter: blur(4px);">
        <h2 style="color: #DC0000;">Sejarah Kami</h2>
        <p style="line-height: 1.6; margin-bottom: 20px;">Cakleker Store didirikan pada tahun 2020 oleh sekelompok penggemar berat Scuderia Ferrari. Berawal dari kecintaan terhadap tim balap asal Maranello, Italia, kami ingin menyediakan merchandise resmi yang mudah diakses oleh para Tifosi di Indonesia. Sejak itu, kami telah melayani ribuan pelanggan dan menjadi salah satu toko merchandise Ferrari terpercaya di Nusantara.</p>

        <h2 style="color: #DC0000;">Visi & Misi</h2>
        <p><strong>Visi:</strong> Menjadi pusat komunitas Tifosi terbesar di Indonesia yang tidak hanya menjual produk, tetapi juga merayakan semangat balap Ferrari.</p>
        <p><strong>Misi:</strong> Menyediakan produk original dengan harga kompetitif, memberikan pengalaman berbelanja yang aman dan nyaman, serta terus memperluas koleksi agar sesuai dengan kebutuhan para penggemar.</p>

        <h2 style="color: #DC0000;">Komitmen Kami</h2>
        <ul style="list-style: disc; padding-left: 20px;">
            <li>100% Original Merchandise – Garansi uang kembali jika terbukti palsu.</li>
            <li>Pengiriman cepat ke seluruh Indonesia dengan mitra logistik terpercaya.</li>
            <li>Layanan pelanggan responsif siap membantu 24/7.</li>
        </ul>

        <p style="margin-top: 30px; font-style: italic; text-align: center;">Forza Ferrari! 🏎️🏁</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    console.log('Halaman Tentang dimuat - Cakleker Store');
    // Contoh: Anda bisa menambahkan tracking analytics atau efek animasi di sini
</script>
@endpush
