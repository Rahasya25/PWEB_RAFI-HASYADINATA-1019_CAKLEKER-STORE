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
        footer {
            background: #0D0D0D;
            border-top: 3px solid #DC0000;
            padding: 40px 20px;
            text-align: center;
        }
        .footer-inner {
            max-width: 1300px;
            margin: 0 auto;
        }
        .footer-col a {
            color: #aaa;
            text-decoration: none;
        }
        .footer-col a:hover {
            color: white;
        }
        .copyright {
            margin-top: 20px;
            color: #666;
            font-size: 13px;
        }
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

    <header>
        <div class="nav-header">
            <img src="{{ asset('Images/CAKLEKER-STORE.png') }}" alt="Cakleker Store" class="logo-img">
            <nav>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('tentang') }}">Tentang</a>
                <a href="{{ route('hitung') }}">Hitung</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-inner">
            <div class="footer-col">
                <a href="{{ route('tentang') }}">Tentang Kami</a>
            </div>
            <div class="copyright">
                © 2026 Cakleker Store
            </div>
        </div>
    </footer>
</body>
</html>
