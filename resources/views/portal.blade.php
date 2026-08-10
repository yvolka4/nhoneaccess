<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal - One Access Yayasan Nur Hidayah</title>
    <link rel="icon" type="image/png" href="https://nhsolo.com/images/PUSKOM.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700|cormorant-garamond:400,500,600" rel="stylesheet"/>
    <style>
        :root {
            --green:        #1a7c4a;
            --green-dark:   #135e38;
            --green-mid:    #239659;
            --green-pale:   #e6f4ec;
            --green-light:  #d0ecdc;
            --green-muted:  #6abf8e;
            --bg:           #f2f7f4;
            --white:        #ffffff;
            --text:         #18181b;
            --muted:        #5a7265;
            --border:       #c8ddd2;
            --font:         'Plus Jakarta Sans', sans-serif;
            --serif:        'Cormorant Garamond', serif;
            --r:            10px;
            --r-lg:         14px;
            --amber:        #d97706;
            --amber-pale:   #fef3c7;
            --amber-light:  #fde68a;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            min-height: 100%;
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed;
            top: 0;
            left: 0; right: 0;
            z-index: 100;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 52px;
            border-bottom: 1px solid transparent;
            transition: padding .25s, background .25s, border-color .25s, backdrop-filter .25s;
        }
        .topbar.scrolled {
            padding: 16px 52px;
            background: rgba(13,92,53,.92);
            border-bottom-color: rgba(255,255,255,.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .topbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-text {
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: .06em;
            color: #fff;
            text-transform: uppercase;
        }
        .topbar-nav {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .topbar-nav a {
            font-size: 12px;
            font-weight: 500;
            color: rgba(255,255,255,.65);
            text-decoration: none;
            letter-spacing: .04em;
            text-transform: uppercase;
            transition: color .15s;
        }
        .topbar-nav a:hover { color: #fff; }
        .topbar-nav a.active { color: #fff; }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-login {
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255,255,255,.65);
            text-decoration: none;
            letter-spacing: .04em;
            text-transform: uppercase;
            transition: color .15s;
        }
        .btn-login:hover { color: #fff; }
        .btn-logout {
            background: none;
            border: none;
            color: rgba(255,255,255,.65);
            font-family: var(--font);
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding: 0;
            transition: color .15s;
        }
        .btn-logout:hover { color: #fff; }
        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            letter-spacing: .02em;
        }
        .user-divider {
            color: rgba(255,255,255,.3);
        }

        /* ── HERO BANNER ── */
        .hero {
            background: linear-gradient(135deg, #0d5c35 0%, #1a7c4a 60%, #239659 100%);
            padding: 112px 40px 48px;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hero-watermark {
            position: absolute;
            width: 800px; height: 800px;
            background: url('https://nhsolo.com/images/logo1.png') center/contain no-repeat;
            opacity: 0.04;
            top: -100px; right: -150px;
            z-index: 0;
            pointer-events: none;
            transform: rotate(-10deg);
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 250px;
            background: linear-gradient(to bottom, transparent, #f8fafc);
            z-index: 0;
            pointer-events: none;
        }
        .hero-inner {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transform: translateY(-60px);
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 99px;
            font-size: 13.5px;
            font-weight: 600;
            color: rgba(255,255,255,.9);
            letter-spacing: .04em;
            margin-bottom: 40px;
        }
        .hero-badge svg { width: 14px; height: 14px; }
        .hero h1 {
            font-family: var(--serif);
            font-weight: 500;
            font-size: clamp(44px, 7vw, 76px);
            line-height: 1.15;
            color: #fff;
            margin-bottom: 24px;
        }
        .hero h1 span { color: rgba(255,255,255,.6); }
        .hero p {
            font-size: 20px;
            line-height: 1.6;
            color: rgba(255,255,255,.8);
            max-width: 900px;
        }
        .hero-stats {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 24px;
            margin-top: 56px;
            width: 100%;
            max-width: 800px;
        }
        .hero-stats > div {
            background: rgba(13, 92, 53, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 24px 32px;
            min-width: 180px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, background 0.3s, box-shadow 0.3s;
        }
        .hero-stats > div:hover {
            transform: translateY(-5px);
            background: rgba(13, 92, 53, 0.85);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }
        .hero-stat-num {
            font-size: 38px;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }
        .hero-stat-label {
            font-size: 14.5px;
            color: rgba(255,255,255,.7);
            margin-top: 8px;
            letter-spacing: .03em;
        }
        
        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fff;
            color: #1a7c4a;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            cursor: pointer;
            z-index: 10;
            transition: all .2s;
            animation: bounce 2s infinite;
        }
        .scroll-indicator:hover {
            background: #f1f5f9;
        }
        .scroll-indicator svg {
            width: 22px;
            height: 22px;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0) translateX(-50%); }
            40% { transform: translateY(-12px) translateX(-50%); }
            60% { transform: translateY(-6px) translateX(-50%); }
        }

        /* ── NOTICE BANNER (belum login) ── */
        .notice-bar {
            background: var(--amber-pale);
            border-bottom: 1px solid var(--amber-light);
            padding: 11px 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .notice-bar svg { width: 15px; height: 15px; stroke: var(--amber); flex-shrink: 0; }
        .notice-bar span {
            font-size: 12.5px;
            color: #92400e;
            line-height: 1.5;
        }
        .notice-bar a {
            color: var(--amber);
            font-weight: 600;
            text-decoration: none;
        }
        .notice-bar a:hover { text-decoration: underline; }

        /* ── MAIN CONTENT ── */
        .main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 40px 60px;
        }

        /* ── SECTION HEADER ── */
        .section-header {
            display: flex;
            align-items: flex-end;
            gap: 14px;
            margin-bottom: 22px;
        }
        .section-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-bottom: 5px;
        }
        .section-dot.green { background: var(--green); }
        .section-dot.amber { background: var(--amber); }
        .section-info h2 {
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
            line-height: 1.2;
            margin-bottom: 3px;
        }
        .section-info p {
            font-size: 12.5px;
            color: var(--muted);
            line-height: 1.5;
        }
        .section-badge {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: .03em;
        }
        .section-badge.green {
            background: var(--green-pale);
            color: var(--green-dark);
            border: 1px solid var(--green-light);
        }
        .section-badge.amber {
            background: var(--amber-pale);
            color: #92400e;
            border: 1px solid var(--amber-light);
        }
        .section-badge svg { width: 12px; height: 12px; }

        .section-divider {
            height: 1px;
            background: var(--border);
            margin-bottom: 24px;
        }

        /* ── GRID ── */
        .grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 14px;
            margin-bottom: 48px;
        }

        /* ── WEBSITE CARD ── */
        .website-card {
            width: 160px;
            flex-shrink: 0;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--r-lg);
            overflow: hidden;
            cursor: pointer;
            transition: border-color .18s, transform .15s;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
        }
        .website-card:hover {
            border-color: var(--green);
            transform: translateY(-2px);
        }
        .website-card.amber-group:hover {
            border-color: var(--amber);
        }
        .card-logo {
            background: var(--green-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px 20px;
            min-height: 110px;
        }
        .website-card.amber-group .card-logo {
            background: var(--amber-pale);
        }
        .card-logo img {
            max-width: 72px;
            max-height: 64px;
            object-fit: contain;
        }
        .card-body {
            padding: 12px 12px 14px;
            border-top: 1px solid var(--border);
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }
        .card-title {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text);
            text-align: center;
            line-height: 1.35;
            letter-spacing: .02em;
        }
        .card-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 99px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: .03em;
        }
        .card-tag.sso {
            background: var(--green-pale);
            color: var(--green-dark);
        }
        .card-tag.open {
            background: var(--amber-pale);
            color: #92400e;
        }
        .card-tag svg { width: 10px; height: 10px; }

        /* ── MODAL OVERLAY ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 200;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-overlay.active { display: flex; }

        .modal {
            background: var(--white);
            border-radius: 16px;
            width: 100%;
            max-width: 480px;
            overflow: hidden;
            position: relative;
        }
        .modal-header {
            padding: 24px 32px;
            color: #fff;
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }
        .modal-header.sso { background: linear-gradient(135deg, #0d5c35 0%, #1a7c4a 100%); }
        .modal-header.mandiri { background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); }
        .modal-header.publik { background: linear-gradient(135deg, #b45309 0%, #d97706 100%); }
        .modal-logo {
            width: 60px; height: 60px;
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .modal-logo img {
            max-width: 44px;
            max-height: 44px;
            object-fit: contain;
        }
        .modal-title-wrap { flex: 1; }
        .modal-title {
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
            margin-bottom: 6px;
        }
        .modal-tag {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,.2);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px; font-weight: 600;
            color: rgba(255,255,255,.9);
            letter-spacing: .03em;
        }
        .modal-tag svg { width: 11px; height: 11px; }
        .modal-close {
            width: 30px; height: 30px;
            background: rgba(255,255,255,.15);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.8);
            flex-shrink: 0;
            transition: background .15s;
        }
        .modal-close:hover { background: rgba(255,255,255,.25); }
        .modal-close svg { width: 16px; height: 16px; }

        .modal-body { padding: 24px 28px; }
        .modal-desc {
            font-size: 13.5px;
            color: var(--muted);
            line-height: 1.75;
            margin-bottom: 20px;
        }
        .modal-info-row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            background: var(--bg);
            border-radius: var(--r);
            margin-bottom: 16px;
            font-size: 12.5px;
        }
        .modal-info-row svg { width: 14px; height: 14px; stroke: var(--muted); flex-shrink: 0; }
        .modal-info-row span { color: var(--muted); }
        .modal-info-row strong { color: var(--text); margin-left: 2px; }
        .modal-info-row a { color: var(--green); font-weight: 500; text-decoration: none; word-break: break-all; }
        .modal-info-row a:hover { text-decoration: underline; }
        .modal-info-row.amber a { color: var(--amber); }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-visit {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            color: #fff;
            padding: 12px 24px; border-radius: 10px;
            font-size: 13.5px; font-weight: 600; text-decoration: none;
            flex: 1; transition: background .2s, transform .2s;
        }
        .btn-visit.sso { background: #0d5c35; }
        .btn-visit.sso:hover { background: #1a7c4a; transform: translateY(-1px); }
        .btn-visit.mandiri { background: #4f46e5; }
        .btn-visit.mandiri:hover { background: #6366f1; transform: translateY(-1px); }
        .btn-visit.publik { background: #d97706; }
        .btn-visit.publik:hover { background: #f59e0b; transform: translateY(-1px); }
        .btn-visit svg { width: 14px; height: 14px; }
        .btn-close-modal {
            padding: 12px 18px;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: var(--r);
            font-family: var(--font);
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            transition: background .15s;
        }
        .btn-close-modal:hover { background: var(--green-pale); color: var(--green-dark); }

        /* ── FOOTER ── */
        .footer {
            background: linear-gradient(135deg, #0d5c35 0%, #1a7c4a 100%);
            padding: 28px 40px;
            text-align: center;
        }
        .footer p {
            font-size: 11.5px;
            color: rgba(255,255,255,.45);
        }

        @media (max-width: 768px) {
            .topbar { padding: 16px 20px; }
            .topbar-nav { display: none; }
            .hero { padding: 90px 20px 48px; min-height: 100vh; }
            .hero h1 { font-size: clamp(32px, 8vw, 40px); margin-bottom: 16px; }
            .hero p { font-size: 16px; }
            .hero-badge { margin-bottom: 24px; padding: 6px 12px; font-size: 12px; }
            .hero-stats { gap: 12px; margin-top: 32px; flex-direction: column; width: 100%; }
            .hero-stats > div { padding: 16px 24px; min-width: 100%; }
            .hero-stat-num { font-size: 28px; }
            .notice-bar { padding: 10px 20px; }
            .main { padding: 28px 20px 48px; }
            .grid { gap: 10px; }
            .website-card { width: calc(50% - 5px); }
            .footer { padding: 24px 20px !important; }
            .modal { width: 90%; }
            .hero-watermark { width: 400px; height: 400px; top: -50px; right: -80px; }
            .btn-login { padding: 6px 12px; font-size: 11px; }
            
            /* Section Header Responsive */
            .section-header { flex-direction: column; align-items: flex-start; gap: 8px; }
            .section-badge { margin-left: 0; }
            .section-info h2 { font-size: 16px; }
        }
    </style>
</head>
<body>

<!-- ── TOPBAR ── -->
<header class="topbar" id="topbar" @auth style="background: rgba(13, 92, 53, 0.95); padding: 16px 52px; border-bottom: 1px solid rgba(255,255,255,0.08);" @endauth>
    <a href="/" class="topbar-left" style="text-decoration: none;">
        <span class="logo-text">NH One Access</span>
    </a>

    <div style="display: flex; align-items: center; gap: 40px;">
        <nav class="topbar-nav">
            <a href="{{ route('portal') }}" class="active">Portal</a>
            <a href="{{ route('monitoring') }}">Monitoring</a>
            <a href="https://nurhidayah.co.id/id" target="_blank">Yayasan</a>
        </nav>

        <div class="topbar-right">
            @auth
                <span class="user-name">{{ auth()->user()->name }}</span>
                <span class="user-divider">|</span>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;display:flex;">
                    @csrf
                    <button type="submit" class="btn-logout">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-login">Masuk</a>
            @endauth
        </div>
    </div>
</header>

<!-- ── HERO ── -->
@guest
<section class="hero">
    <div class="hero-watermark"></div>
    
    <div class="hero-inner">
        <h1 style="text-transform: uppercase; font-size: clamp(28px, 4.5vw, 48px); font-weight: 700; line-height: 1.2; margin-bottom: 24px;">Portal Layanan Digital Terpadu<br><span>Yayasan Nur Hidayah</span></h1>
        <p>Akses seluruh layanan digital yayasan dari satu portal — mulai dari kepegawaian, akademik, keuangan, hingga operasional, terintegrasi dalam satu ekosistem yang aman dan efisien.</p>
    </div>
    
    <div class="scroll-indicator" onclick="window.scrollTo({ top: window.innerHeight, behavior: 'smooth' })">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
    </div>
</section>
@endguest

<!-- ── NOTICE BAR ── -->
@guest
<div class="notice-bar">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
    <span>Anda belum masuk. Sistem yang terintegrasi NH One Access memerlukan login terlebih dahulu. <a href="{{ route('login') }}">Klik di sini untuk masuk &rarr;</a></span>
</div>
@endguest

<!-- ── MAIN ── -->
<main class="main" @auth style="padding-top: 120px;" @endauth>

    <!-- GROUP 1: SSO -->
    <div class="section-header">
        <div class="section-dot green"></div>
        <div class="section-info">
            <h2>Sistem Terintegrasi NH One Access</h2>
            <p>Login sekali, akses semua sistem ini secara langsung</p>
        </div>
        <span class="section-badge green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
            4 Sistem NH One Access
        </span>
    </div>
    <div class="section-divider"></div>

    <div class="grid">
        <!-- SIM UTAMA -->
        @auth
            <a href="{{ route('sso.redirect', ['app' => 'sim_utama']) }}" class="website-card">
        @else
            <div class="website-card" onclick="openModal('website2')">
        @endauth
            <div class="card-logo"><img src="https://nhsolo.com/images/SIM utama.png" alt="SIM UTAMA YNH"></div>
            <div class="card-body">
                <div class="card-title">SIM UTAMA YNH</div>
                <span class="card-tag sso">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    NH One Access
                </span>
            </div>
        @auth
            </a>
        @else
            </div>
        @endauth

        <!-- SIKAP -->
        @auth
            <a href="{{ route('sso.redirect', ['app' => 'sikap']) }}" class="website-card">
        @else
            <div class="website-card" onclick="openModal('website5')">
        @endauth
            <div class="card-logo"><img src="https://nhsolo.com/images/SIKAP.png" alt="SIKAP"></div>
            <div class="card-body">
                <div class="card-title">SIKAP</div>
                <span class="card-tag sso">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    NH One Access
                </span>
            </div>
        @auth
            </a>
        @else
            </div>
        @endauth

        <!-- SIPANGKAT -->
        @auth
            <a href="{{ route('sso.redirect', ['app' => 'sipangkat']) }}" class="website-card">
        @else
            <div class="website-card" onclick="openModal('website9')">
        @endauth
            <div class="card-logo"><img src="https://nhsolo.com/images/Pangkat.png" alt="SIPANGKAT"></div>
            <div class="card-body">
                <div class="card-title">SIPANGKAT</div>
                <span class="card-tag sso">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    NH One Access
                </span>
            </div>
        @auth
            </a>
        @else
            </div>
        @endauth

        <!-- E-GAJIAN -->
        @auth
            <a href="{{ route('sso.redirect', ['app' => 'egajian']) }}" class="website-card">
        @else
            <div class="website-card" onclick="openModal('website13')">
        @endauth
            <div class="card-logo"><img src="https://nhsolo.com/images/gaji.png" alt="E-gajian"></div>
            <div class="card-body">
                <div class="card-title">E-GAJIAN</div>
                <span class="card-tag sso">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    NH One Access
                </span>
            </div>
        @auth
            </a>
        @else
            </div>
        @endauth
    </div>

    <!-- GROUP 2: Belum Terintegrasi SSO -->
    <div class="section-header">
        <div class="section-dot" style="background:#6366f1;"></div>
        <div class="section-info">
            <h2>Sistem Lainnya</h2>
            <p>Login mandiri di masing-masing sistem</p>
        </div>
        <span class="section-badge" style="background:#eef2ff;color:#3730a3;border:1px solid #c7d2fe;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="12" height="12"><path stroke-linecap="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
            6 Sistem
        </span>
    </div>
    <div class="section-divider"></div>

    <div class="grid">
        <div class="website-card" onclick="openModal('website4')">
            <div class="card-logo"><img src="https://nhsolo.com/images/UpinH.png" alt="SIUPINH"></div>
            <div class="card-body">
                <div class="card-title">SIUPINH</div>
                <span class="card-tag" style="background:#eef2ff;color:#3730a3;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="10" height="10"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Login Mandiri
                </span>
            </div>
        </div>
        <div class="website-card" onclick="openModal('website6')">
            <div class="card-logo"><img src="https://nhsolo.com/images/Sehat.png" alt="SISEHAT"></div>
            <div class="card-body">
                <div class="card-title">SISEHAT</div>
                <span class="card-tag" style="background:#eef2ff;color:#3730a3;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="10" height="10"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Login Mandiri
                </span>
            </div>
        </div>
        <div class="website-card" onclick="openModal('website7')">
            <div class="card-logo"><img src="https://nhsolo.com/images/Jamil.png" alt="SIJAMIL"></div>
            <div class="card-body">
                <div class="card-title">SIJAMIL</div>
                <span class="card-tag" style="background:#eef2ff;color:#3730a3;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="10" height="10"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Login Mandiri
                </span>
            </div>
        </div>
        <div class="website-card" onclick="openModal('website8')">
            <div class="card-logo"><img src="https://nhsolo.com/images/PKBS.png" alt="SIPKBS"></div>
            <div class="card-body">
                <div class="card-title">SIPKBS</div>
                <span class="card-tag" style="background:#eef2ff;color:#3730a3;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="10" height="10"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Login Mandiri
                </span>
            </div>
        </div>
        <div class="website-card" onclick="openModal('website11')">
            <div class="card-logo"><img src="https://nhsolo.com/images/saldo.png" alt="Saldo Plus"></div>
            <div class="card-body">
                <div class="card-title">SALDO PLUS</div>
                <span class="card-tag" style="background:#eef2ff;color:#3730a3;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="10" height="10"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Login Mandiri
                </span>
            </div>
        </div>
        <div class="website-card" onclick="openModal('website3')" style="opacity:.6;pointer-events:none;">
            <div class="card-logo"><img src="https://nhsolo.com/images/IpiNH.png" alt="SIIPINH"></div>
            <div class="card-body">
                <div class="card-title">SIIPINH</div>
                <span class="card-tag" style="background:#f1f5f9;color:#64748b;">
                    Segera Hadir
                </span>
            </div>
        </div>
    </div>

    <!-- GROUP 2: Non-SSO / Publik -->
    <div class="section-header">
        <div class="section-dot amber"></div>
        <div class="section-info">
            <h2>Sistem Akses Publik</h2>
            <p>Dapat diakses langsung tanpa login SSO</p>
        </div>
        <span class="section-badge amber">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
            8 Sistem Publik
        </span>
    </div>
    <div class="section-divider"></div>

    <div class="grid">
        <div class="website-card amber-group" onclick="openModal('website1')">
            <div class="card-logo"><img src="https://nhsolo.com/images/logo1.png" alt="Website Utama"></div>
            <div class="card-body">
                <div class="card-title">WEBSITE UTAMA</div>
                <span class="card-tag open">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Publik
                </span>
            </div>
        </div>
        <div class="website-card amber-group" onclick="openModal('website10')">
            <div class="card-logo"><img src="https://nhsolo.com/images/jejakNH_warna.png" alt="ALUMYAH"></div>
            <div class="card-body">
                <div class="card-title">ALUMYAH</div>
                <span class="card-tag open">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Publik
                </span>
            </div>
        </div>
        <div class="website-card amber-group" onclick="openModal('website12')">
            <div class="card-logo"><img src="https://nhsolo.com/images/kalender.png" alt="Kalender YNH"></div>
            <div class="card-body">
                <div class="card-title">KALENDER YNH</div>
                <span class="card-tag open">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Publik
                </span>
            </div>
        </div>
        <div class="website-card amber-group" onclick="openModal('website14')">
            <div class="card-logo"><img src="https://nhsolo.com/images/ponpes.png" alt="PPNH"></div>
            <div class="card-body">
                <div class="card-title">PPNH</div>
                <span class="card-tag open">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Publik
                </span>
            </div>
        </div>
        <div class="website-card amber-group" onclick="openModal('website15')">
            <div class="card-logo"><img src="https://nhsolo.com/images/webinar.png" alt="Webinar"></div>
            <div class="card-body">
                <div class="card-title">WEBINAR</div>
                <span class="card-tag open">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Publik
                </span>
            </div>
        </div>
        <div class="website-card amber-group" onclick="openModal('website16')">
            <div class="card-logo"><img src="https://nhsolo.com/images/joinnn.png" alt="JoinNH"></div>
            <div class="card-body">
                <div class="card-title">JOIN NH</div>
                <span class="card-tag open">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Publik
                </span>
            </div>
        </div>
        <div class="website-card amber-group" onclick="openModal('website17')">
            <div class="card-logo"><img src="https://nhsolo.com/images/ponpes.png" alt="PPDB PONPES"></div>
            <div class="card-body">
                <div class="card-title">PSB PONPES</div>
                <span class="card-tag open">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Publik
                </span>
            </div>
        </div>
        <div class="website-card amber-group" onclick="openModal('website18')">
            <div class="card-logo"><img src="https://pendaftaran.ppdbnurhidayah.com/image/logo_yayasan.png" alt="PPDB NUR HIDAYAH"></div>
            <div class="card-body">
                <div class="card-title">PPDB NUR HIDAYAH</div>
                <span class="card-tag open">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Publik
                </span>
            </div>
        </div>
    </div>

</main>

<!-- ── MODAL ── -->
<div class="modal-overlay" id="modal-overlay" onclick="closeModalOutside(event)">
    <div class="modal" id="modal-box">
        <div class="modal-header" id="modal-header">
            <div class="modal-logo">
                <img src="" alt="" id="modal-img">
            </div>
            <div class="modal-title-wrap">
                <div class="modal-title" id="modal-title"></div>
                <span class="modal-tag" id="modal-tag"></span>
            </div>
            <button class="modal-close" onclick="closeModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-desc" id="modal-desc"></p>
            <div class="modal-info-row">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                <span>URL: <a href="" target="_blank" id="modal-url"></a></span>
            </div>
            <div class="modal-info-row" id="modal-sso-row">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                <span id="modal-sso-text"></span>
            </div>
            <div class="modal-actions">
                <a href="#" target="_blank" id="modal-visit-btn" class="btn-visit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Buka Sistem
                </a>
                <button class="btn-close-modal" onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ── FOOTER ── -->
<footer class="footer" style="padding: 40px 52px; border-top: 1px solid rgba(0,0,0,.05); background: transparent;">
    <!-- Mengganti div menjadi a href -->
    <a href="https://puskomdatin.nhsolo.com" target="_blank" style="display: flex; align-items: center; justify-content: flex-start; gap: 14px; text-decoration: none;">
        <img src="https://nhsolo.com/images/PUSKOM.png" alt="Puskomdatin YNH" style="height: 42px; opacity: 0.9;">
        <div style="font-size: 11.5px; line-height: 1.4; color: #64748b; font-weight: 500; text-align: left;">
            Copyright &copy; {{ date('Y') }}<br>
            <span style="font-weight: 700; color: #334155; font-size: 12.5px;">Puskomdatin YNH</span><br>
            All rights reserved
        </div>
    </a>
</footer>

<script>
const websites = {
    website1:{title:"Website Utama Yayasan Nur Hidayah",description:"Portal Utama Yayasan Nur Hidayah yang berisi informasi umum tentang yayasan, visi misi, program, dan kegiatan terbaru dari seluruh unit pendidikan di bawah naungan Yayasan Nur Hidayah.",url:"https://nurhidayah.co.id/id",logo:"images/logo1.png",type:"publik"},
    website2:{title:"SIM UTAMA YNH",description:"Sistem Informasi Utama Administrasi dan Kepegawaian Yayasan Nur Hidayah Surakarta.",url:"https://sim.nhsolo.com",logo:"https://nhsolo.com/images/SIM utama.png",type:"sso"},
    website3:{title:"SIIPINH",description:"Sistem Informasi untuk Mengelola Indeks Pegawai dan Kinerja Yayasan Nur Hidayah Surakarta. (Segera Hadir)",url:"#",logo:"https://nhsolo.com/images/IpiNH.png",type:"mandiri"},
    website4:{title:"SIUPINH",description:"Sistem Informasi untuk Membuat Undangan Rapat Online, Presensi Rapat atau Kegiatan dan Administrasi Notulensi di Yayasan Nur Hidayah Surakarta.",url:"https://siupinadmin.nhsolo.com",logo:"https://nhsolo.com/images/UpinH.png",type:"mandiri"},
    website5:{title:"SIKAP",description:"Sistem Informasi untuk Mencatat, Mengelola Kehadiran, Dinas Luar, Laporan Pekerjaan, BPI dan Administrasi Kepegawaian di Yayasan Nur Hidayah Surakarta.",url:"https://sikap.nhsolo.com",logo:"https://nhsolo.com/images/SIKAP.png",type:"sso"},
    website6:{title:"SISEHAT",description:"Sistem Informasi untuk Memantau dan Mencatat Tumbuh Kembang Anak Dalam Konteks Kesehatan dan Pendidikan Di PAUDIT Nur Hidayah Surakarta.",url:"https://sisehat.nhsolo.com",logo:"https://nhsolo.com/images/Sehat.png",type:"mandiri"},
    website7:{title:"SIJAMIL",description:"Sistem Informasi untuk Mengelola Peminjaman dan Operasional Mobil dan NHCC di Yayasan Nur Hidayah Surakarta.",url:"https://sijamil.nhsolo.com/admin",logo:"https://nhsolo.com/images/Jamil.png",type:"mandiri"},
    website8:{title:"SIPKBS",description:"Sistem Informasi untuk Mengajukan Permohonan Keringanan Biaya Sekolah di Yayasan Nur Hidayah.",url:"https://sipkbs.nhsolo.com/admin/login.php",logo:"https://nhsolo.com/images/PKBS.png",type:"mandiri"},
    website9:{title:"SIPANGKAT",description:"Sistem Informasi untuk Mengajukan Peningkatan Karier Terpadu, Tunjangan Keluarga, Studi Lanjut dan Subsidi Kuliah Anak Pegawai di Yayasan Nur Hidayah.",url:"https://sipangkat.nhsolo.com",logo:"https://nhsolo.com/images/Pangkat.png",type:"sso"},
    website10:{title:"ALUMYAH",description:"Sistem Informasi untuk Mengelola Data Alumni Yayasan Nur Hidayah.",url:"https://sialumyah.nhsolo.com",logo:"https://nhsolo.com/images/jejakNH_warna.png",type:"sso"},
    website11:{title:"Saldo Plus",description:"Sistem Informasi terpadu untuk pengelolaan saldo, top-up, dan transaksi digital di lingkungan Yayasan Nur Hidayah.",url:"https://saldoplus.nurhidayah.app/",logo:"https://nhsolo.com/images/saldo.png",type:"mandiri"},
    website12:{title:"Kalender Yayasan Nur Hidayah",description:"Website Kalender Yayasan Nur Hidayah Surakarta.",url:"https://kalender.nhsolo.com/",logo:"https://nhsolo.com/images/kalender.png",type:"publik"},
    website13:{title:"E-gajian",description:"Sistem Informasi Penggajian Terpadu Yayasan Nur Hidayah Surakarta yang digunakan untuk mengelola perhitungan gaji, tunjangan, potongan, slip gaji, serta proses transfer gaji pegawai secara akurat, transparan, dan terintegrasi dengan data kepegawaian.",url:"https://e-gajian.nhsolo.com/",logo:"https://nhsolo.com/images/gaji.png",type:"sso"},
    website14:{title:"PPNH",description:"Portal Resmi Pondok Pesantren Nur Hidayah yang menyajikan informasi profil pondok, visi dan misi, program pendidikan, kegiatan santri, pengumuman, serta berita terbaru seputar kehidupan pesantren.",url:"http://nurhidayah.ponpes.id/",logo:"https://nhsolo.com/images/ponpes.png",type:"publik"},
    website15:{title:"Webinar",description:"Sistem Informasi Webinar Yayasan Nur Hidayah yang digunakan untuk mengelola pendaftaran peserta, jadwal kegiatan, administrasi webinar, absensi, serta dokumentasi kegiatan seminar dan pelatihan secara daring.",url:"https://seminar.nurhidayah.co.id/admin/login.php",logo:"https://nhsolo.com/images/webinar.png",type:"publik"},
    website16:{title:"JoinNH",description:"Sistem Pendaftaran Pegawai Terpadu Yayasan Nur Hidayah.",url:"https://join.nhsolo.com/",logo:"https://nhsolo.com/images/joinnn.png",type:"publik"},
    website17:{title:"PSB PONPES",description:"Sistem Penerimaan Santri Baru (PSB) Pondok Pesantren Nur Hidayah.",url:"https://siraj.nurhidayah.ponpes.id/",logo:"https://nhsolo.com/images/ponpes.png",type:"publik"},
    website18:{title:"PPDB NUR HIDAYAH",description:"Penerimaan Peserta Didik Baru (PPDB) Yayasan Nur Hidayah.",url:"https://pendaftaran.ppdbnurhidayah.com/",logo:"https://pendaftaran.ppdbnurhidayah.com/image/logo_yayasan.png",type:"publik"}
};

function openModal(id) {
    const w = websites[id];
    if (!w) return;

    document.getElementById('modal-img').src = w.logo;
    document.getElementById('modal-img').alt = w.title;
    document.getElementById('modal-title').textContent = w.title;

    const header = document.getElementById('modal-header');
    const tag = document.getElementById('modal-tag');
    const visitBtn = document.getElementById('modal-visit-btn');
    const urlEl = document.getElementById('modal-url');
    const ssoRow = document.getElementById('modal-sso-row');
    const ssoText = document.getElementById('modal-sso-text');
    const urlRow = urlEl.closest('.modal-info-row');

    if (w.type === 'sso') {
        header.className = 'modal-header sso';
        tag.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg> Terintegrasi NH One Access`;
        tag.className = 'modal-tag sso';
        visitBtn.className = 'btn-visit sso';
        ssoRow.style.display = 'flex';
        ssoText.innerHTML = '<strong>Akses Terpadu:</strong>&nbsp; Login menggunakan kredensial NH One Access ini';
        urlRow.style.display = 'none';
    } else if (w.type === 'mandiri') {
        header.className = 'modal-header mandiri';
        tag.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg> Login Mandiri`;
        tag.className = 'modal-tag mandiri';
        visitBtn.className = 'btn-visit mandiri';
        ssoRow.style.display = 'flex';
        ssoText.innerHTML = '<strong>Login Mandiri:</strong>&nbsp; Memerlukan kredensial terpisah dari NH One Access';
        urlRow.style.display = 'flex';
    } else {
        header.className = 'modal-header publik';
        tag.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg> Akses Publik`;
        tag.className = 'modal-tag publik';
        visitBtn.className = 'btn-visit publik';
        ssoRow.style.display = 'flex';
        ssoText.innerHTML = '<strong>Akses Publik:</strong>&nbsp; Dapat diakses langsung tanpa login';
        urlRow.style.display = 'flex';
    }

    document.getElementById('modal-desc').textContent = w.description;
    urlEl.textContent = w.url === '#' ? 'Segera Hadir' : w.url;
    urlEl.href = w.url;

    visitBtn.href = w.url;
    if (w.url === '#') {
        visitBtn.textContent = 'Segera Hadir';
        visitBtn.style.opacity = '0.6';
        visitBtn.style.pointerEvents = 'none';
    } else {
        visitBtn.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg> Buka Sistem`;
        visitBtn.style.opacity = '1';
        visitBtn.style.pointerEvents = 'auto';
    }

    document.getElementById('modal-overlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('modal-overlay').classList.remove('active');
    document.body.style.overflow = '';
}

function closeModalOutside(e) {
    if (e.target === document.getElementById('modal-overlay')) closeModal();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});

const topbar = document.getElementById('topbar');
window.addEventListener('scroll', function() {
    if (window.scrollY > 10) {
        topbar.classList.add('scrolled');
    } else {
        topbar.classList.remove('scrolled');
    }
});
</script>

</body>
</html>
