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


// ── SSO Redirect (OAuth2 Adapted) ──
Route::middleware(['auth'])->group(function () {
    Route::get('/sso/redirect', function (Request $request) {
        $appKey = strtolower($request->query('app'));

        $loginEndpoints = [
            'sim_utama'  => 'https://nhsolo.com/sim/sso/login_oauth2.php',
            'sikap'      => 'https://nhsolo.com/sikap/sso/login_oauth2.php',
            'sipangkat'  => 'https://nhsolo.com/sipangkat/sso/login_oauth2.php',
            'egajian'    => 'https://e-gajian.nhsolo.com/sso/login'
        ];

        if (!isset($loginEndpoints[$appKey])) {
            return "Error: Aplikasi [".$appKey."] belum didaftarkan sebagai OAuth2 Client di SSO ini.";
        }

        return redirect($loginEndpoints[$appKey]);
    })->name('sso.redirect');
});


require __DIR__.'/auth.php';