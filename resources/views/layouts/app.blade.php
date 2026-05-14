<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakleker Store - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; color: white; background: #0D0D0D; }
        .video-bg { position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -2; transform: scale(1.3); }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: -1; }
        header { position: sticky; top: 0; z-index: 1000; backdrop-filter: blur(20px); background: rgba(0,0,0,0.7); border-bottom: 3px solid #DC0000; }
        .nav-header { display: flex; justify-content: space-between; align-items: center; max-width: 1300px; margin: 0 auto; padding: 20px 40px; }
        .logo-img { height: 45px; width: auto; }
        nav { display: flex; gap: 8px; }
        nav a { font-size: 15px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: white; padding: 8px 16px; text-decoration: none; transition: color 0.2s; }
        nav a:hover { color: #FFD700; }
        main { min-height: 80vh; padding: 40px; }
        .hero-content { text-align: center; max-width: 800px; margin: 0 auto; }
        .hero-desc { margin: 20px auto; color: #ccc; line-height: 1.6; }
        .hero-stats { display: flex; gap: 48px; justify-content: center; margin: 30px 0; }
        .stat-number { font-size: 40px; font-weight: bold; }
        .stat-label { font-size: 11px; color: #FFD700; letter-spacing: 2px; }
        .hero-promo { font-size: 13px; color: #aaa; }
        .btn { display: inline-block; background: #DC0000; color: white; padding: 14px 32px; border-radius: 4px; text-decoration: none; font-weight: bold; margin-top: 20px; }
        .btn:hover { background: #FF1E1E; }
        footer { background: #0D0D0D; border-top: 3px solid #DC0000; padding: 50px 20px 30px; margin-top: 60px; }
        .footer-container { max-width: 1300px; margin: 0 auto; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; margin-bottom: 40px; }
        .footer-logo { height: 45px; margin-bottom: 15px; }
        .footer-desc { color: #aaa; font-size: 14px; line-height: 1.6; max-width: 280px; }
        .footer-links h4 { color: #FFD700; font-size: 14px; letter-spacing: 1px; margin-bottom: 20px; }
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: #ccc; text-decoration: none; font-size: 13px; }
        .footer-links a:hover { color: #DC0000; }
        .footer-bottom { border-top: 1px solid #222; padding-top: 25px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 15px; font-size: 13px; color: #777; }
        @media (max-width: 768px) { .footer-grid { grid-template-columns: 1fr; text-align: center; } .footer-desc { max-width: 100%; } .footer-bottom { flex-direction: column; text-align: center; } }
        .nav-logout-btn {
            background: none;
            border: none;
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 8px 16px;
            cursor: pointer;
            transition: color 0.2s;
        }
        .nav-logout-btn:hover {
            color: #FFD700;
        }
        .user-name {
            color: #FFD700;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 8px 16px;
            background: none;
        }
    </style>
    @stack('styles')
</head>
<body>
    <video autoplay muted loop playsinline class="video-bg">
        <source src="{{ asset('Videos/Ferrari-Reveal-1.mp4') }}" type="video/mp4">
    </video>

    {{-- Pemilihan navbar berdasarkan role dari database, bukan session --}}
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
            <div class="alert-success" style="background: #4CAF50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error" style="background: #f44336; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
