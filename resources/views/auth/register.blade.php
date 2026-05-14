<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar — Cakleker Store</title>
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
            overflow-x: hidden;
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
            max-width: 460px;
        }

        /* Brand */
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
            border: 1px solid rgba(255,215,0,0.15);
            border-top: 3px solid #FFD700;
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
            border-color: #FFD700;
            background: rgba(255,215,0,0.04);
        }
        .form-group input::placeholder { color: #444; }
        .error-msg {
            font-size: 11px;
            color: #FF6B6B;
            margin-top: 6px;
        }

        /* Grid 2 kolom untuk password */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* Actions */
        .form-actions {
            margin-top: 28px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .btn-register {
            width: 100%;
            background: #FFD700;
            color: #0D0D0D;
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
        .btn-register:hover { background: #FFC200; transform: translateY(-1px); }

        .link-login {
            text-align: center;
            font-size: 13px;
            color: #888;
        }
        .link-login a {
            color: #DC0000;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }
        .link-login a:hover { color: #FF1E1E; }

        /* Syarat & ketentuan hint */
        .hint {
            font-size: 11px;
            color: #555;
            text-align: center;
            margin-top: 4px;
        }

        .page-tagline {
            text-align: center;
            margin-top: 24px;
            font-size: 11px;
            color: #444;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        @media (max-width: 480px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-card { padding: 28px 24px; }
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
                <div class="brand-title">Bergabung Bersama Tifosi</div>
            </div>

            <div class="form-card">
                <div class="form-heading">
                    <h2>Buat Akun Baru</h2>
                    <p>Daftar dan mulai belanja merchandise Ferrari</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required autofocus autocomplete="name">
                        @error('name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="tifosi@ferrari.com" required autocomplete="username">
                        @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" placeholder="••••••••" required autocomplete="new-password">
                            @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
                            @error('password_confirmation') <div class="error-msg">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-register">Daftar Sekarang</button>
                        <div class="hint">Dengan mendaftar, kamu menyetujui syarat & ketentuan kami.</div>
                        <div class="link-login">
                            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="page-tagline">Forza Ferrari 🏎️</div>
        </div>
    </div>
</body>
</html>
