<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakleker Store - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            color: white;
            background: #0D0D0D;
        }
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
            transform: scale(1.3);
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: -1;
        }
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(20px);
            background: rgba(0,0,0,0.7);
            border-bottom: 3px solid #DC0000;
        }
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px 40px;
        }
        .logo-img {
            height: 45px;
            width: auto;
        }
        nav {
            display: flex;
            gap: 8px;
        }
        nav a {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            transition: color 0.2s;
        }
        nav a:hover {
            color: #FFD700;
        }
        main {
            min-height: 80vh;
            padding: 40px;
        }
        /* ========== FOOTER ENHANCED ========== */
        footer {
            background: #0D0D0D;
            border-top: 3px solid #DC0000;
            padding: 50px 20px 30px;
            margin-top: 60px;
        }
        .footer-container {
            max-width: 1300px;
            margin: 0 auto;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        .footer-logo {
            height: 45px;
            width: auto;
            margin-bottom: 15px;
        }
        .footer-desc {
            color: #aaa;
            font-size: 14px;
            line-height: 1.6;
        }
        .footer-links h4,
        .footer-contact h4,
        .footer-social h4 {
            color: #FFD700;
            font-size: 16px;
            letter-spacing: 1px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .footer-links ul,
        .footer-contact ul {
            list-style: none;
            padding: 0;
        }
        .footer-links li,
        .footer-contact li {
            margin-bottom: 12px;
            font-size: 14px;
        }
        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links a:hover {
            color: #DC0000;
        }
        .footer-contact li i {
            margin-right: 8px;
            font-style: normal;
        }
        .social-icons {
            display: flex;
            gap: 15px;
        }
        .social-icon {
            display: inline-block;
            background: #1A1A1A;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            font-size: 20px;
            text-decoration: none;
            color: white;
            transition: all 0.2s;
        }
        .social-icon:hover {
            background: #DC0000;
            transform: translateY(-3px);
        }
        .footer-bottom {
            border-top: 1px solid #222;
            padding-top: 25px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 13px;
            color: #777;
        }
        .footer-bottom p {
            margin: 0;
        }
        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .footer-brand {
                text-align: center;
            }
            .social-icons {
                justify-content: center;
            }
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
        /* ========== HERO CONTENT & BUTTON ========== */
        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
        .btn {
            display: inline-block;
            background: #DC0000;
            color: white;
            padding: 14px 32px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn:hover {
            background: #FF1E1E;
        }
    </style>
    @stack('styles')
</head>
<body>
    <video autoplay muted loop playsinline class="video-bg">
        <source src="{{ asset('Videos/Ferrari-Reveal-1.mp4') }}" type="video/mp4">
    </video>

    @include('partials.navbar')

    <main>
        @if(session('success'))
            <div class="alert alert-success" style="background: #4CAF50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error" style="background: #f44336; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="{{ asset('Images/CAKLEKER-STORE.png') }}" alt="Cakleker Store" class="footer-logo">
                    <p class="footer-desc">
                        Toko merchandise resmi Scuderia Ferrari di Indonesia. Melayani Tifosi sejati dengan produk original dan garansi terbaik.
                    </p>
                </div>
                <div class="footer-links">
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('kontak') }}">Kontak</a></li>
                        <li><a href="{{ route('hitung') }}">Kalkulator</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>Hubungi Kami</h4>
                    <ul>
                        <li><i>📍</i> Jakarta, Indonesia</li>
                        <li><i>📞</i> +62 21 1234 5678</li>
                        <li><i>✉️</i> info@caklekerstore.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Cakleker Store. Dikenal sebagai toko resmi Ferrari di Indonesia.</p>
                <p>Forza Ferrari! 🏎️</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
