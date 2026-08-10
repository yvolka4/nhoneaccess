<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring - One Access Yayasan Nur Hidayah</title>
    <link rel="icon" type="image/png" href="https://nhsolo.com/images/PUSKOM.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --green:        #1a7c4a;
            --green-dark:   #0d5c35;
            --green-light:  #c8ddd2;
            --green-pale:   #e6f4ec;
            --amber:        #d97706;
            --amber-pale:   #fef3c7;
            --bg:           #f2f7f4;
            --text:         #18181b;
            --muted:        #64748b;
            --border:       #e2e8f0;
            --font:         'Plus Jakarta Sans', sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            min-height: 100vh;
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
        }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed;
            top: 0;
            left: 0; right: 0;
            z-index: 100;
            background: rgba(13,92,53,.92);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 52px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,.08);
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
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            text-transform: uppercase;
            padding: 0;
        }
        .btn-logout:hover { color: #fff; }
        .user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .user-divider { color: rgba(255,255,255,.3); }

        .main-content {
            padding: 120px 52px 50px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            flex: 1;
        }
        .page-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text);
        }
        .page-subtitle {
            font-size: 15px;
            color: #5a7265;
        }
        .empty-box {
            margin-top: 30px;
            background: #fff;
            border: 1px dashed #c8ddd2;
            border-radius: 12px;
            padding: 60px;
            text-align: center;
            color: #5a7265;
            font-size: 14px;
        }

        .grid-5-col {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 40px;
        }
        @media (max-width: 1024px) {
            .grid-5-col { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 768px) {
            .grid-5-col { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<header class="topbar">
    <a href="/" class="topbar-left" style="text-decoration: none;">
        <span class="logo-text">NH One Access</span>
    </a>

    <div style="display: flex; align-items: center; gap: 40px;">
        <nav class="topbar-nav">
            <a href="{{ route('portal') }}">Portal</a>
            <a href="{{ route('monitoring') }}" class="active">Monitoring</a>
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

<main class="main-content">
    <h1 class="page-title">Monitoring Dashboard</h1>
    <p class="page-subtitle">Sistem pemantauan layanan terpadu Yayasan Nur Hidayah.</p>
    
    @if($dbError)
        <div class="empty-box" style="border-color: #fca5a5; color: #b91c1c; background: #fef2f2;">
            {{ $dbError }}
        </div>
    @else
        <!-- Overview Section -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 40px; margin-top: 30px;">
            <!-- Cards Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 16px;">
                <!-- Total -->
                <div style="background: #fff; padding: 20px; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <div style="font-size: 13px; color: var(--muted); margin-bottom: 8px; font-weight: 600;">Total Karyawan</div>
                    <div style="font-size: 28px; font-weight: 700; color: var(--text); line-height: 1;">{{ $total_karyawan }}</div>
                </div>
                <!-- Hadir -->
                <div style="background: #e6f4ec; padding: 20px; border-radius: 14px; border: 1px solid var(--green-light); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <div style="font-size: 13px; color: var(--green-dark); margin-bottom: 8px; font-weight: 600;">Hadir</div>
                    <div style="font-size: 28px; font-weight: 700; color: var(--green-dark); line-height: 1;">{{ $total_hadir }}</div>
                </div>
                <!-- Belum Hadir -->
                <div style="background: #fee2e2; padding: 20px; border-radius: 14px; border: 1px solid #fecaca; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <div style="font-size: 13px; color: #991b1b; margin-bottom: 8px; font-weight: 600;">Belum Hadir</div>
                    <div style="font-size: 28px; font-weight: 700; color: #991b1b; line-height: 1;">{{ $total_tidak_hadir }}</div>
                </div>
                <!-- Terlambat -->
                <div style="background: #fef3c7; padding: 20px; border-radius: 14px; border: 1px solid #fde68a; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <div style="font-size: 13px; color: #92400e; margin-bottom: 8px; font-weight: 600;">Terlambat</div>
                    <div style="font-size: 28px; font-weight: 700; color: #92400e; line-height: 1;">{{ $total_terlambat }}</div>
                </div>
                <!-- Pulang Cepat -->
                <div style="background: #fdf2f8; padding: 20px; border-radius: 14px; border: 1px solid #fbcfe8; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <div style="font-size: 13px; color: #9d174d; margin-bottom: 8px; font-weight: 600;">Pulang Cepat</div>
                    <div style="font-size: 28px; font-weight: 700; color: #9d174d; line-height: 1;">{{ $total_pulang_cepat }}</div>
                </div>
                <!-- Izin -->
                <div style="background: #eff6ff; padding: 20px; border-radius: 14px; border: 1px solid #bfdbfe; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <div style="font-size: 13px; color: #1e40af; margin-bottom: 8px; font-weight: 600;">Izin / Cuti</div>
                    <div style="font-size: 28px; font-weight: 700; color: #1e40af; line-height: 1;">{{ $total_izin }}</div>
                </div>
            </div>

            <!-- Donut Chart -->
            <div style="background: #fff; padding: 24px; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 4px 12px rgba(0,0,0,0.03); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <h3 style="font-size: 15px; font-weight: 600; margin-bottom: 16px; color: var(--text); align-self: flex-start;">Komposisi Kehadiran</h3>
                <div style="width: 100%; max-width: 220px; aspect-ratio: 1; margin: 0 auto;">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; margin-top: 40px;">
            <h2 style="font-size: 18px; font-weight: 700; color: var(--text);">Statistik Unit Kerja</h2>
        </div>
        
        <div class="grid-5-col">
            @foreach($daftar_kantor as $kantor)
                @php
                    $id_k = (string)$kantor->id_kantor;
                    $total = $karyawan_per_kantor[$id_k] ?? 0;
                    
                    if ($total == 0) continue;

                    $hadir = $login_per_kantor[$id_k] ?? 0;
                    $persen = round(($hadir / $total) * 100);
                    $color = $persen >= 80 ? 'var(--green)' : ($persen >= 50 ? 'var(--amber)' : '#dc2626');
                @endphp
                <div style="background: #fff; padding: 20px; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.02); transition: transform 0.2s, box-shadow 0.2s;">
                    <div style="font-weight: 700; font-size: 15px; margin-bottom: 16px; color: var(--text); line-height: 1.3;">
                        {{ $kantor->nama_kantor }}
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 10px;">
                        <div>
                            <span style="font-size: 28px; font-weight: 700; color: {{ $color }}; line-height: 1;">{{ $hadir }}</span>
                            <span style="font-size: 13px; color: var(--muted); font-weight: 500;">/ {{ $total }} Karyawan</span>
                        </div>
                        <div style="font-size: 14px; font-weight: 700; color: {{ $color }}; background: {{ $persen >= 80 ? 'var(--green-pale)' : ($persen >= 50 ? 'var(--amber-pale)' : '#fee2e2') }}; padding: 4px 10px; border-radius: 8px;">
                            {{ $persen }}%
                        </div>
                    </div>
                    
                    <!-- Progress bar -->
                    <div style="width: 100%; height: 8px; background: #f1f5f9; border-radius: 99px; overflow: hidden; box-shadow: inset 0 1px 2px rgba(0,0,0,.05);">
                        <div style="height: 100%; width: {{ $persen }}%; background: {{ $color }}; border-radius: 99px; transition: width 1s ease-in-out;"></div>
                    </div>
                </div>
            @endforeach
        </div>

                <!-- Bar Chart Full Width -->
        <div style="background: #fff; padding: 24px; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 40px;">
            <div style="width: 100%; height: 300px;">
                <canvas id="unitChart"></canvas>
            </div>
        </div>
    @endif
</main>

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

@if(!$dbError)
<script>
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.color = '#64748b';

    // Data untuk Donut Chart
    const attendanceData = {
        labels: ['Hadir Tepat', 'Terlambat', 'Izin', 'Belum Hadir'],
        datasets: [{
            data: [
                {{ max(0, $total_hadir - $total_terlambat) }}, 
                {{ $total_terlambat }}, 
                {{ $total_izin }}, 
                {{ $total_tidak_hadir }}
            ],
            backgroundColor: ['#1a7c4a', '#f59e0b', '#3b82f6', '#ef4444'],
            borderWidth: 0,
            hoverOffset: 4
        }]
    };

    const ctxPie = document.getElementById('attendanceChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: attendanceData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 10, padding: 15 } }
            }
        }
    });

    // Data untuk Bar Chart
    @php
        $unitLabels = [];
        $unitHadir = [];
        $unitTotal = [];
        
        foreach($daftar_kantor as $kantor) {
            $id_k = (string)$kantor->id_kantor;
            $total = $karyawan_per_kantor[$id_k] ?? 0;
            if ($total == 0) continue;
            
            $unitLabels[] = $kantor->nama_kantor;
            $unitHadir[] = $login_per_kantor[$id_k] ?? 0;
            $unitTotal[] = $total;
        }
    @endphp

    const barData = {
        labels: {!! json_encode($unitLabels) !!},
        datasets: [
            {
                label: 'Jumlah Hadir',
                data: {!! json_encode($unitHadir) !!},
                backgroundColor: '#1a7c4a',
                borderRadius: 4
            },
            {
                label: 'Total Karyawan',
                data: {!! json_encode($unitTotal) !!},
                backgroundColor: '#e2e8f0',
                borderRadius: 4
            }
        ]
    };

    const ctxBar = document.getElementById('unitChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            },
            plugins: {
                legend: { position: 'top' }
            }
        }
    });
</script>
@endif

</body>
</html>
