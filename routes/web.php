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

        // Client IDs dari Passport (Harus disesuaikan dengan database oauth_clients)
        $oauthClients = [
            'sim_utama'  => [
                'client_id' => '019ff3fe-b9ed-71e0-902b-6dffffbf9473',
                'redirect'  => 'https://nhsolo.com/sim/sso/callback_oauth2.php'
            ],
            'sikap'      => [
                'client_id' => '019ff3fe-b5e2-7270-8329-78785fa016dd',
                'redirect'  => 'https://nhsolo.com/sikap/sso/callback_oauth2.php'
            ],
            'sipangkat'  => [
                'client_id' => '019ff3fe-bdc9-735b-a6ed-fc25a35d9ef2',
                'redirect'  => 'https://nhsolo.com/sipangkat/sso/callback_oauth2.php'
            ],
            'egajian'    => [
                'client_id' => '019ff406-8ee7-70f2-9bb6-496029cfdde0',
                'redirect'  => 'https://e-gajian.nhsolo.com/sso/callback'
            ]
        ];

        if (!isset($oauthClients[$appKey])) {
            return "Error: Aplikasi [".$appKey."] belum didaftarkan sebagai OAuth2 Client di SSO ini.";
        }

        $client = $oauthClients[$appKey];
        
        // Membangun URL untuk standard OAuth2 Authorization Code Grant
        $query = http_build_query([
            'client_id' => $client['client_id'],
            'redirect_uri' => $client['redirect'],
            'response_type' => 'code',
            'scope' => '',
            'state' => Str::random(40), // CSRF Protection
        ]);

        return redirect('/oauth/authorize?'.$query);
    })->name('sso.redirect');
});


require __DIR__.'/auth.php';