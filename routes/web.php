<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;


// ── Halaman Index / Portal (Halaman pertama saat dibuka) ──
Route::get('/', function () {
    return view('portal');
})->name('portal');

use App\Http\Controllers\MonitoringController;

// ── Monitoring ──
Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');


// ── Dashboard (butuh login & verifikasi email) ──
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ── Profile ──
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ── SSO Redirect ──
Route::middleware(['auth'])->group(function () {
    Route::get('/sso/redirect', function (Request $request) {
        $appKey = strtolower($request->query('app'));

        $apps = [
            'sim_utama'  => 'http://nhsolo.com/sim/sso/callback.php',
            'siipinh'    => '#',
            'siupinh'    => 'https://siupinadmin.nhsolo.com/sso/callback',
            'sikap'      => 'http://nhsolo.com/sikap/sso/callback.php',
            'sisehat'    => 'https://sisehat.nhsolo.com/sso/callback',
            'sijamil'    => 'https://sijamil.nhsolo.com/sso/callback',
            'sipkbs'     => 'https://sipkbs.nhsolo.com/sso/callback',
            'sipangkat'  => 'http://nhsolo.com/sipangkat/sso/callback.php',
            'alumyah'    => 'https://sialumyah.nhsolo.com/sso/callback',
            'egajian'    => 'http://e-gajian.nhsolo.com/sso/callback',
        ];

        if (!isset($apps[$appKey])) {
            return "Error: Aplikasi [".$appKey."] tidak terdaftar. Cek link di dashboard Anda.";
        }

        $user = auth()->user();
        if (!$user->nik) {
            return "Error: User [".$user->name."] tidak memiliki NIK di database SSO.";
        }

        $rawToken    = Str::random(64);
        $hashedToken = hash('sha256', $rawToken);

        try {
            if ($appKey === 'egajian') {
                DB::connection('egajian')->table('sso_tokens')->insert([
                    'nik'        => $user->nik,
                    'token'      => $hashedToken,
                    'expires_at' => now()->addMinutes(5),
                    'created_at' => now(),
                ]);
            } else if ($appKey === 'sim_utama') {
                // Cek apakah user ada di database sim_nurhidayah
                $userExists = DB::connection('sim')->table('pegawai')->where('nik', $user->nik)->exists();
                if (!$userExists) {
                    return "Error: Akun dengan NIK [".$user->nik."] tidak ditemukan di sistem SIM UTAMA.";
                }

                // Pastikan tabel sso_tokens ada di database sim_nurhidayah sebelum insert
                DB::connection('sim')->statement("
                    CREATE TABLE IF NOT EXISTS sso_tokens (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nik VARCHAR(50) NOT NULL,
                        token VARCHAR(64) NOT NULL,
                        expires_at TIMESTAMP NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        INDEX (token),
                        INDEX (nik)
                    )
                ");

                DB::connection('sim')->table('sso_tokens')->insert([
                    'nik'        => $user->nik,
                    'token'      => $hashedToken,
                    'expires_at' => now()->addMinutes(5),
                    'created_at' => now(),
                ]);
            } else if ($appKey === 'sipangkat') {
                // Cek apakah user ada di database sipangkat
                $userExists = DB::connection('sipangkat')->table('pegawai')->where('nik', $user->nik)->exists();
                if (!$userExists) {
                    return "Error: Akun dengan NIK [".$user->nik."] tidak ditemukan di sistem SIPANGKAT.";
                }

                // Pastikan tabel sso_tokens ada di database sipangkat sebelum insert
                DB::connection('sipangkat')->statement("
                    CREATE TABLE IF NOT EXISTS sso_tokens (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nik VARCHAR(50) NOT NULL,
                        token VARCHAR(64) NOT NULL,
                        expires_at TIMESTAMP NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        INDEX (token),
                        INDEX (nik)
                    )
                ");

                DB::connection('sipangkat')->table('sso_tokens')->insert([
                    'nik'        => $user->nik,
                    'token'      => $hashedToken,
                    'expires_at' => now()->addMinutes(5),
                    'created_at' => now(),
                ]);
            } else {
                DB::table('sso_tokens')->insert([
                    'nik'        => $user->nik,
                    'token'      => $hashedToken,
                    'expires_at' => now()->addMinutes(5),
                    'created_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            return "Gagal membuat token: " . $e->getMessage();
        }

        $redirectUrl = $apps[$appKey] . "?sso_token=" . $rawToken;

        return redirect()->away($redirectUrl);
    })->name('sso.redirect');
});


require __DIR__.'/auth.php';
