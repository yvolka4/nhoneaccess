<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SSO Nur Hidayah - Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700|cormorant-garamond:400,500,600" rel="stylesheet"/>
    <style>
        /* ─── tokens ─── */
        :root {
            --green:       #1a7c4a;
            --green-dark:  #135e38;
            --green-mid:   #239659;
            --green-pale:  #e6f4ec;
            --green-light: #d0ecdc;
            --green-muted: #6abf8e;
            --bg:          #f2f7f4;
            --white:       #ffffff;
            --text:        #18181b;
            --muted:       #5a7265;
            --border:      #c8ddd2;
            --error:       #dc2626;
            --font:        'Plus Jakarta Sans', sans-serif;
            --serif:       'Cormorant Garamond', serif;
            --r:           10px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            overflow: hidden;
        }

        /* ─── Layout ─── */
        .page {
            display: grid;
            grid-template-columns: 1fr 460px;
            height: 100vh;
            overflow: hidden;
        }

        /* ─── LEFT PANEL ─── */
        .left {
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 36px 52px 48px;
            overflow: hidden;
            height: 100%;
            background: linear-gradient(145deg, #0d5c35 0%, #1a7c4a 50%, #239659 100%);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        .blob-1 {
            width: 440px; height: 440px;
            background: rgba(255,255,255,.05);
            top: -100px; left: -100px;
        }
        .blob-2 {
            width: 300px; height: 300px;
            background: rgba(255,255,255,.04);
            bottom: 40px; right: -40px;
        }
        .blob-3 {
            width: 200px; height: 200px;
            background: rgba(255,255,255,.03);
            top: 40%; left: 30%;
        }

        .left-inner {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Nav */
        .l-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-mark {
            width: 36px; height: 36px;
            background: rgba(255,255,255,.18);
            border-radius: 9px;
            border: 1px solid rgba(255,255,255,.25);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-mark svg { width: 18px; height: 18px; }

        .logo-text {
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: .06em;
            color: #fff;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }
        .nav-links a {
            font-size: 12px;
            font-weight: 500;
            color: rgba(255,255,255,.65);
            text-decoration: none;
            letter-spacing: .04em;
            text-transform: uppercase;
            transition: color .15s;
        }
        .nav-links a:hover { color: #fff; }

        /* Hero copy */
        .l-hero {
            padding: 80px 0 40px;
        }

        .l-hero h1 {
            font-family: var(--serif);
            font-weight: 500;
            font-size: clamp(36px, 3.6vw, 58px);
            line-height: 1.1;
            letter-spacing: -.01em;
            color: #fff;
            margin-bottom: 18px;
        }

        .l-hero h1 span { color: rgba(255,255,255,.55); }

        .l-hero p {
            font-size: 13.5px;
            line-height: 1.8;
            color: rgba(255,255,255,.65);
            max-width: 340px;
        }

        /* Feature pills */
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 32px;
        }

        .feat {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 99px;
            font-size: 12px;
            font-weight: 500;
            color: rgba(255,255,255,.85);
        }
        .feat svg { width: 13px; height: 13px; }

        /* Stats Row */
        .stats {
            display: flex;
            gap: 28px;
            margin-top: 48px;
            padding-top: 36px;
            border-top: 1px solid rgba(255,255,255,.12);
        }
        .stat-num {
            font-size: 24px;
            font-weight: 600;
            color: #fff;
            line-height: 1;
        }
        .stat-label {
            font-size: 11.5px;
            color: rgba(255,255,255,.55);
            margin-top: 4px;
            letter-spacing: .03em;
        }

        /* Footer note */
        .l-foot {
            font-size: 11px;
            color: rgba(255,255,255,.4);
            margin-top: auto;
            padding-top: 32px;
        }

        /* ─── RIGHT PANEL ─── */
        .right {
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 36px;
            position: relative;
            height: 100%;
            overflow: hidden;
        }

        .right::before {
            content: '';
            position: absolute;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: var(--green-pale);
            top: -80px; right: -80px;
            z-index: 0;
        }

        .right::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: var(--green-light);
            bottom: -60px; left: -60px;
            z-index: 0;
            opacity: .5;
        }

        .form-container {
            width: 100%;
            max-width: 360px;
            position: relative;
            z-index: 1;
        }

        /* Form brand accent */
        .form-brand {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 28px;
        }
        .form-brand-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            background: var(--green);
        }
        .form-brand-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .form-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }

        .form-sub {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 28px;
            line-height: 1.65;
        }

        /* Divider badge */
        .form-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .divider-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            background: var(--green-pale);
            border: 1px solid var(--green-light);
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--green-dark);
            letter-spacing: .03em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .divider-badge svg { width: 12px; height: 12px; }
        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* Fields */
        .field + .field { margin-top: 16px; }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--green-dark);
            margin-bottom: 7px;
            letter-spacing: .03em;
            text-transform: uppercase;
        }

        .input-wrap { position: relative; }

        .input-wrap svg {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            stroke: var(--green-muted);
            pointer-events: none;
        }

        .field input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--r);
            font-family: var(--font);
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }

        .field input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(26,124,74,.12);
        }

        .field input::placeholder { color: #a8bdb4; }

        /* Error messages */
        .field-error {
            font-size: 11.5px;
            color: var(--error);
            margin-top: 5px;
        }

        /* Alert errors */
        .alert-errors {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: var(--r);
            padding: 12px 14px;
            font-size: 12.5px;
            color: var(--error);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        /* Session status */
        .session-status {
            background: var(--green-pale);
            border: 1px solid var(--green-light);
            border-radius: var(--r);
            padding: 12px 14px;
            font-size: 12.5px;
            color: var(--green-dark);
            margin-bottom: 20px;
        }

        /* Remember + forgot */
        .form-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 16px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            color: var(--muted);
            cursor: pointer;
        }

        .remember input {
            width: 15px; height: 15px;
            accent-color: var(--green);
            cursor: pointer;
        }

        .forgot {
            font-size: 12.5px;
            color: var(--green);
            text-decoration: none;
            font-weight: 600;
            transition: opacity .15s;
        }
        .forgot:hover { opacity: .75; }

        /* Submit button */
        .btn-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 24px;
            padding: 14px;
            background: var(--green);
            color: #fff;
            font-family: var(--font);
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: var(--r);
            cursor: pointer;
            letter-spacing: .02em;
            transition: background .15s, transform .1s, box-shadow .15s;
        }
        .btn-submit svg { width: 16px; height: 16px; }
        .btn-submit:hover {
            background: var(--green-dark);
            box-shadow: 0 4px 16px rgba(26,124,74,.3);
        }
        .btn-submit:active { transform: scale(.99); }

        /* Footer note under button */
        .form-note {
            text-align: center;
            font-size: 11.5px;
            color: var(--muted);
            margin-top: 20px;
            line-height: 1.6;
        }
        .form-note a {
            color: var(--green);
            text-decoration: none;
            font-weight: 500;
        }

        /* ─── Responsive ─── */
        @media (max-width: 900px) {
            html, body { overflow: auto; }
            .page { grid-template-columns: 1fr; height: auto; min-height: 100vh; overflow: auto; }
            .left { display: none; }
            .right {
                height: auto;
                min-height: 100vh;
                padding: 32px 20px;
                background: var(--white);
            }
            .right::before, .right::after { display: none; }
        }
    </style>
</head>
<body>

<div class="page">

    <!-- ─── LEFT PANEL ─── -->
    <div class="left">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <div class="left-inner">
            <nav class="l-nav">
                <a href="/" class="logo">
                    <div class="logo-mark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5"/>
                            <path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <span class="logo-text">SSO Nur Hidayah</span>
                </a>

                <ul class="nav-links">
                    <li><a href="#">Portal</a></li>
                    <li><a href="#">Tentang</a></li>
                    <li><a href="https://nurhidayah.co.id/id" target="_blank">Yayasan</a></li>
                </ul>
            </nav>

            <div class="l-hero">
                <h1>Portal Terpadu<br><span>Nur Hidayah</span></h1>
                <p>
                    Satu akun untuk mengakses seluruh sistem informasi Yayasan Nur Hidayah —
                    akademik, kepegawaian, dan keuangan dalam satu platform yang aman.
                </p>

                <div class="features">
                    <span class="feat">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        Aman &amp; Terpercaya
                    </span>
                    <span class="feat">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                        Akses Cepat
                    </span>
                    <span class="feat">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg>
                        4 Sistem Terintegrasi
                    </span>
                </div>
            </div>

            <div class="stats">
                <div>
                    <div class="stat-num">4+</div>
                    <div class="stat-label">Sistem Terintegrasi</div>
                </div>
                <div>
                    <div class="stat-num">1</div>
                    <div class="stat-label">Akun Tunggal</div>
                </div>
                <div>
                    <div class="stat-num">100%</div>
                    <div class="stat-label">Aman &amp; Terenkripsi</div>
                </div>
            </div>

            <p class="l-foot">&copy; {{ date('Y') }} Yayasan Nur Hidayah. Semua hak dilindungi.</p>
        </div>
    </div>

    <!-- ─── RIGHT PANEL ─── -->
    <div class="right">
        <div class="form-container">

            <div class="form-brand">
                <div class="form-brand-dot"></div>
                <div class="form-brand-line"></div>
            </div>

            <p class="form-title">Selamat datang kembali</p>
            <p class="form-sub">Masuk menggunakan NIK dan password Anda untuk mengakses portal.</p>

            @if ($errors->any())
                <div class="alert-errors">
                    <ul style="padding-left:14px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            <div class="form-divider">
                <span class="divider-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                    Login Aman
                </span>
                <div class="divider-line"></div>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="nik">NIK</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        <input id="nik" type="text" name="nik"
                               value="{{ old('nik') }}"
                               placeholder="16 digit NIK Anda"
                               required autofocus autocomplete="username"/>
                    </div>
                    @error('nik')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        <input id="password" type="password" name="password"
                               placeholder="••••••••"
                               required autocomplete="current-password"/>
                    </div>
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-meta">
                    <label class="remember">
                        <input type="checkbox" name="remember" id="remember_me">
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                    Masuk ke Portal
                </button>
            </form>

            <p class="form-note">Butuh bantuan? Hubungi <a href="#">administrator IT</a> Yayasan.</p>

        </div>
    </div>

</div>

</body>
</html>
