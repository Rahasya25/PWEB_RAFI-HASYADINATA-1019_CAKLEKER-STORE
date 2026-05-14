<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Cakleker Store</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0D0D0D;
            overflow: hidden;
        }

        .video-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            z-index: 0;
            transform: scale(1.3);
        }

        .overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.65);
            z-index: 1;
        }

        .page-wrap {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
            padding: 40px 20px;
        }

        .form-container {
            width: 100%;
            max-width: 420px;
        }

        /* Logo & Header */
        .brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .brand img {
            height: 52px;
            width: auto;
            margin-bottom: 16px;
        }
        .brand-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #888;
        }

        /* Card */
        .form-card {
            background: rgba(15,15,15,0.85);
            border: 1px solid rgba(220,0,0,0.25);
            border-top: 3px solid #DC0000;
            border-radius: 8px;
            padding: 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 24px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04);
        }

        .form-heading {
            margin-bottom: 28px;
        }
        .form-heading h2 {
            font-size: 22px;
            font-weight: 700;
            color: white;
            letter-spacing: 1px;
        }
        .form-heading p {
            font-size: 13px;
            color: #666;
            margin-top: 4px;
        }

        /* Alert */
        .alert-status {
            background: rgba(255,215,0,0.1);
            border: 1px solid rgba(255,215,0,0.2);
            color: #FFD700;
            padding: 10px 14px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #FFD700;
            margin-bottom: 8px;
        }
        .form-group input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 4px;
            padding: 12px 16px;
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .form-group input:focus {
            border-color: #DC0000;
            background: rgba(220,0,0,0.05);
        }
        .form-group input::placeholder { color: #444; }
        .error-msg {
            font-size: 11px;
            color: #FF6B6B;
            margin-top: 6px;
        }

        /* Remember me */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }
        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #DC0000;
            cursor: pointer;
        }
        .remember-row label {
            font-size: 13px;
            color: #888;
            cursor: pointer;
        }

        /* Actions */
        .form-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .btn-login {
            width: 100%;
            background: #DC0000;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 4px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-login:hover { background: #FF1E1E; transform: translateY(-1px); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #444;
            font-size: 11px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.08);
        }

        .link-forgot {
            text-align: center;
            font-size: 13px;
            color: #888;
            text-decoration: none;
            transition: color 0.2s;
        }
        .link-forgot:hover { color: #FFD700; }

        .link-register {
            text-align: center;
            font-size: 13px;
            color: #888;
        }
        .link-register a {
            color: #DC0000;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }
        .link-register a:hover { color: #FF1E1E; }

        /* Footer tagline */
        .page-tagline {
            text-align: center;
            margin-top: 24px;
            font-size: 11px;
            color: #444;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <video autoplay muted loop playsinline class="video-bg">
        <source src="{{ asset('Videos/Ferrari-Reveal-1.mp4') }}" type="video/mp4">
    </video>
    <div class="overlay"></div>

    <div class="page-wrap">
        <div class="form-container">
            <div class="brand">
                <img src="{{ asset('Images/CAKLEKER-STORE.png') }}" alt="Cakleker Store">
                <div class="brand-title">Member Access</div>
            </div>

            <div class="form-card">
                <div class="form-heading">
                    <h2>Selamat Datang</h2>
                    <p>Masuk ke akun Cakleker Store kamu</p>
                </div>

                @if(session('status'))
                    <div class="alert-status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="tifosi@ferrari.com" required autofocus autocomplete="username">
                        @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                        @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="remember-row">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Ingat saya</label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-login">Masuk</button>

                        @if(Route::has('password.request'))
                            <div class="divider">atau</div>
                            <a href="{{ route('password.request') }}" class="link-forgot">Lupa password?</a>
                        @endif

                        <div class="link-register">
                            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="page-tagline">Forza Ferrari 🏎️</div>
        </div>
    </div>
</body>
</html>
