<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Terpadu - SSO Nur Hidayah</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700|cormorant-garamond:400,500,600" rel="stylesheet"/>

    <style>
        /* ─── TOKENS (Sama persis dengan halaman Login) ─── */
        :root {
            --blue:      #3b6cf8;
            --blue-dark: #2a55d6;
            --blue-pale: #eef2ff;
            --bg:        #f5f6fa;
            --white:     #ffffff;
            --text:      #18181b;
            --muted:     #71717a;
            --border:    #e4e4e7;
            --font:      'Plus Jakarta Sans', sans-serif;
            --serif:     'Cormorant Garamond', serif;
            --r:         14px; /* Sedikit lebih bulat untuk card aplikasi */
            --shadow:    0 12px 40px rgba(0,0,0,.04);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* ─── DEKORASI BACKGROUND ─── */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
        }
        .blob-1 {
            width: 500px; height: 500px;
            background: rgba(59,108,248,.06);
            top: -100px; left: -100px;
        }
        .blob-2 {
            width: 400px; height: 400px;
            background: rgba(59,108,248,.04);
            bottom: -50px; right: -50px;
        }

        /* ─── LAYOUT UTAMA ─── */
        .portal-wrapper {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 48px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-mark {
            width: 36px; height: 36px;
            background: var(--blue);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .logo-mark svg { width: 18px; height: 18px; color: var(--white); }

        .logo-text {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .02em;
            color: var(--text);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            text-align: right;
            display: none; /* Sembunyikan di layar kecil */
        }
        @media(min-width: 600px) { .user-info { display: block; } }

        .user-info p { font-size: 13px; font-weight: 600; color: var(--text); }
        .user-info span { font-size: 11.5px; color: var(--muted); }

        .btn-logout {
            padding: 8px 16px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--muted);
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: all .15s;
            text-decoration: none;
        }
        .btn-logout:hover {
            color: var(--error);
            border-color: var(--error);
            background: #fef2f2;
        }

        /* ─── KONTEN UTAMA ─── */
        .main-content {
            flex: 1;
            padding: 40px 48px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Membuat form selalu di tengah vertikal (bukan ke bawah) */
        }

        /* Welcome Banner */
        .welcome-banner {
            margin-bottom: 40px;
        }

        .welcome-banner h1 {
            font-family: var(--serif);
            font-size: clamp(32px, 4vw, 44px);
            font-weight: 500;
            color: var(--text);
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .welcome-banner p {
            font-size: 14.5px;
            color: var(--muted);
        }

        /* Grid Aplikasi */
        .app-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .app-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 28px;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow);
            transition: transform .2s, border-color .2s, box-shadow .2s;
            text-decoration: none;
        }

        .app-card:hover {
            transform: translateY(-4px);
            border-color: var(--blue);
            box-shadow: 0 16px 40px rgba(59, 108, 248, 0.12);
        }

        .app-icon {
            width: 48px;
            height: 48px;
            background: var(--blue-pale);
            color: var(--blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            transition: background .2s, color .2s;
        }

        .app-card:hover .app-icon {
            background: var(--blue);
            color: var(--white);
        }

        .app-icon svg {
            width: 24px;
            height: 24px;
        }

        .app-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }

        .app-desc {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            flex-grow: 1;
            margin-bottom: 24px;
        }

        .app-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--blue);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .app-link svg { width: 14px; height: 14px; transition: transform .2s; }
        .app-card:hover .app-link svg { transform: translateX(4px); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .topbar { padding: 16px 24px; }
            .main-content { padding: 32px 24px; justify-content: flex-start; }
            .welcome-banner { margin-bottom: 32px; }
        }
    </style>
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<div class="portal-wrapper">

    <header class="topbar">
        <a href="/" class="logo">
            <div class="logo-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5"/>
                    <path d="M2 12l10 5 10-5"/>
                </svg>
            </div>
            <span class="logo-text">SSO Nur Hidayah</span>
        </a>

        <div class="user-menu">
            <div class="user-info">
                <p>{{ Auth::user()->name ?? 'User Pengguna' }}</p>
                <span>Terautentikasi</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Keluar</button>
            </form>
        </div>
    </header>

    <main class="main-content">

        <div class="welcome-banner">
            <h1>Portal Ekosistem Terpadu</h1>
            <p>Pilih layanan aplikasi yang ingin Anda tuju. Anda akan otomatis masuk tanpa perlu login kembali.</p>
        </div>

        <div class="app-grid">

            <a href="{{ route('sso.redirect', ['app' => 'sim_utama']) }}" class="app-card">
                <div class="app-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="app-title">SIM Utama</h3>
                <p class="app-desc">Sistem Informasi Manajemen Utama untuk pengaturan data sentral dan administrasi yayasan.</p>
                <div class="app-link">Buka Aplikasi <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
            </a>

            <a href="{{ route('sso.redirect', ['app' => 'sikap']) }}" class="app-card">
                <div class="app-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                </div>
                <h3 class="app-title">SIKAP</h3>
                <p class="app-desc">Manajemen kehadiran pegawai, nilai siswa, jadwal kuliah, dan data akademik secara terpusat.</p>
                <div class="app-link">Buka Aplikasi <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
            </a>

            <a href="{{ route('sso.redirect', ['app' => 'sipangkat']) }}" class="app-card">
                <div class="app-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <h3 class="app-title">SIPANGKAT</h3>
                <p class="app-desc">Sistem Informasi untuk memantau jenjang karir, kenaikan pangkat, dan penilaian kinerja pegawai.</p>
                <div class="app-link">Buka Aplikasi <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
            </a>

            <a href="{{ route('sso.redirect', ['app' => 'egajian']) }}" class="app-card">
                <div class="app-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="app-title">E-Gajian</h3>
                <p class="app-desc">Portal akses slip gaji digital dan informasi rekapitulasi insentif bulanan secara transparan.</p>
                <div class="app-link">Buka Aplikasi <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
            </a>

        </div>
    </main>
</div>

</body>
</html>
