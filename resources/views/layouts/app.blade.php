<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakleker Store - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --merah: #DC0000;
            --merah-terang: #FF1E1E;
            --kuning: #FFD700;
            --hitam: #0D0D0D;
            --hitam-lunak: #1A1A1A;
            --abu: #2C2C2C;
            --teks: #FFFFFF;
            --bg-body: #0D0D0D;
            --bg-header: rgba(0,0,0,0.7);
            --bg-card: rgba(0,0,0,0.6);
            --border-card: rgba(255,215,0,0.2);
        }
        /* Light mode - kuning solid */
        html.light {
            --teks: #0D0D0D;
            --bg-body: #FFE500;  /* kuning solid */
            --bg-header: #FFD700;
            --bg-card: rgba(255,255,255,0.9);
            --border-card: rgba(0,0,0,0.1);
            --kuning: #000000;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--teks);
            background: var(--bg-body);
            transition: background 0.3s, color 0.3s;
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
        html.light body::before {
            background: rgba(255,229,0,0.7);
        }
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(20px);
            background: var(--bg-header);
            border-bottom: 3px solid var(--merah);
        }
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px 40px;
        }
        .logo-img { height: 45px; width: auto; }
        nav { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
        nav a, .nav-logout-btn {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--teks);
            padding: 8px 16px;
            text-decoration: none;
            transition: color 0.2s;
        }
        nav a:hover, .nav-logout-btn:hover { color: var(--kuning); }
        .nav-logout-btn {
            background: none;
            border: none;
            cursor: pointer;
        }
        .user-name {
            color: var(--kuning);
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 8px 16px;
        }
        .theme-toggle {
            background: var(--abu);
            border: none;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }
        main { min-height: 80vh; padding: 40px; }
        .alert-success, .alert-error { padding: 10px; border-radius: 5px; margin-bottom: 20px; color: white; }
        .alert-success { background: #4CAF50; }
        .alert-error { background: #f44336; }

        /* Hero */
        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
        .hero-desc { margin: 24px auto; color: #ccc; line-height: 1.6; }
        html.light .hero-desc { color: #333; }
        .hero-stats { display: flex; gap: 48px; justify-content: center; margin: 30px 0; }
        .stat-number { font-size: 40px; font-weight: bold; color: var(--kuning); }
        .stat-label { font-size: 11px; color: var(--kuning); letter-spacing: 2px; }
        .hero-promo { font-size: 13px; color: #aaa; }
        .btn {
            display: inline-block;
            background: var(--merah);
            color: white;
            padding: 14px 32px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn:hover { background: var(--merah-terang); }

        /* Footer */
        footer {
            background: var(--hitam);
            border-top: 3px solid var(--merah);
            padding: 50px 20px 30px;
            margin-top: 60px;
        }
        .footer-container { max-width: 1300px; margin: 0 auto; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; margin-bottom: 40px; }
        .footer-logo { height: 45px; margin-bottom: 15px; }
        .footer-desc { color: #aaa; font-size: 14px; line-height: 1.6; max-width: 280px; }
        .footer-links h4 { color: var(--kuning); font-size: 14px; letter-spacing: 1px; margin-bottom: 20px; }
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: #ccc; text-decoration: none; font-size: 13px; }
        .footer-links a:hover { color: var(--merah); }
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
        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; text-align: center; }
            .footer-desc { max-width: 100%; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }

        /* API F1 Section (card grid) */
        .championship-section {
            max-width: 1300px;
            margin: 80px auto 0;
            padding: 20px;
            background: var(--bg-card);
            border-radius: 24px;
            border: 1px solid var(--border-card);
        }
        .championship-section h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            color: var(--kuning);
        }
        .championship-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .championship-card {
            background: rgba(0,0,0,0.3);
            border-radius: 20px;
            padding: 20px;
            transition: transform 0.2s;
        }
        html.light .championship-card { background: rgba(0,0,0,0.05); }
        .championship-card:hover { transform: translateY(-4px); }
        .championship-card h3 {
            color: var(--kuning);
            font-size: 22px;
            margin-bottom: 16px;
            border-left: 4px solid var(--merah);
            padding-left: 12px;
        }
        .championship-list {
            list-style: none;
            padding: 0;
        }
        .championship-list li {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 14px;
        }
        html.light .championship-list li { border-bottom-color: rgba(0,0,0,0.1); }
        .loading-indicator { text-align: center; padding: 20px; color: var(--kuning); }

        /* Tabel produk aesthetic */
        .produk-table-wrapper {
            background: rgba(0,0,0,0.3);
            border-radius: 20px;
            overflow: hidden;
            backdrop-filter: blur(4px);
        }
        .produk-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .produk-table th {
            background: var(--merah);
            color: white;
            padding: 14px 16px;
            text-align: left;
        }
        .produk-table td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .produk-table tr:hover {
            background: rgba(220,0,0,0.1);
        }
        .badge-kategori {
            background: rgba(255,215,0,0.2);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
        .stok-ok { color: #4CAF50; font-weight: 600; }
        .stok-low { color: #FF9800; font-weight: 600; }
        .stok-empty { color: #FF5252; font-weight: 600; }
        .btn-detail, .btn-edit, .btn-hapus {
            padding: 4px 12px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 12px;
            margin-right: 5px;
        }
        .btn-detail { background: #2196F3; color: white; }
        .btn-edit { background: #FFC107; color: black; }
        .btn-hapus { background: #f44336; color: white; border: none; cursor: pointer; }
        .filter-bar {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            align-items: center;
            flex-wrap: wrap;
        }
        .filter-group select, .search-group input {
            padding: 10px 16px;
            background: rgba(0,0,0,0.5);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 30px;
            color: var(--teks);
            outline: none;
        }
        html.light .filter-group select, html.light .search-group input {
            background: rgba(0,0,0,0.1);
        }
        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px;
            gap: 5px;
        }
        .pagination a, .pagination span {
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            background: rgba(0,0,0,0.3);
            color: var(--teks);
        }
        .pagination .active {
            background: var(--merah);
            color: white;
        }

        .produk-table-wrapper {
            background: #1A1A1A;
            border-radius: 20px;
            overflow: hidden;
        }

        html.light .produk-table-wrapper {
            background: #FFFFFF;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .produk-table td, .produk-table th {
            background-color: transparent;
        }

        .produk-table tr {
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        html.light .produk-table tr {
            border-bottom-color: #ddd;
        }
    </style>
    <script>
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for(let i=0;i<ca.length;i++) {
                let c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
        function applyTheme(theme) {
            if (theme === 'light') {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            } else if (theme === 'dark') {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
            } else if (theme === 'system') {
                const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (isDark) {
                    document.documentElement.classList.remove('light');
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.classList.add('light');
                }
            }
        }
        (function() {
            const theme = getCookie('theme');
            const fontSize = getCookie('font_size');
            if (theme) applyTheme(theme);
            else applyTheme('dark');
            if (fontSize) document.documentElement.style.fontSize = fontSize;
        })();
        function toggleTheme() {
            const isLight = document.documentElement.classList.contains('light');
            if (isLight) {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
                setCookie('theme', 'dark', 365);
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                setCookie('theme', 'light', 365);
            }
        }
    </script>
    @stack('styles')
</head>
<body>
    <video autoplay muted loop playsinline class="video-bg">
        <source src="{{ asset('Videos/Ferrari-Reveal-1.mp4') }}" type="video/mp4">
    </video>

    @auth
        @if(auth()->user()->role == 'admin')
            @include('partials.navbar-admin')
        @else
            @include('partials.navbar-customer')
        @endif
    @else
        @include('partials.navbar-customer')
    @endauth

    <main>
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')
</body>
</html>
