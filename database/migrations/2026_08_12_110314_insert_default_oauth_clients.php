<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $clients = [
            [
                'id' => '019ff3fe-b5e2-7270-8329-78785fa016dd',
                'name' => 'Sikap App',
                'secret' => '$2y$12$bcgGHuVvbLDHIsTZb4lprOa43kjDbBZ3dY90ZVjeSAmA6.I./kDmK',
                'redirect_uris' => '["http://nhsolo.com/sikap/sso/callback.php","http://localhost/sikap/sso/callback.php"]',
                'grant_types' => '["authorization_code","refresh_token"]',
                'revoked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '019ff3fe-b9ed-71e0-902b-6dffffbf9473',
                'name' => 'SIM Utama App',
                'secret' => '$2y$12$zSCDcpMCHQQplfL1gwonLeYArbLpX6khCYL.uEUFTFSrAUwxFdMhy',
                'redirect_uris' => '["http://nhsolo.com/sim/sso/callback.php","http://localhost/sim/sso/callback.php","http://localhost/sim/sso/callback_oauth2.php","http://puskomnh.com/sim/sso/callback_oauth2.php","https://puskomnh.com/sim/sso/callback_oauth2.php"]',
                'grant_types' => '["authorization_code","refresh_token"]',
                'revoked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '019ff3fe-bdc9-735b-a6ed-fc25a35d9ef2',
                'name' => 'SIPANGKAT App',
                'secret' => '$2y$12$lR2y7.qsLAc4XumGWDfN0ei6XE9ps3.DRri3dh3PAwH/YPkX11wN6',
                'redirect_uris' => '["http://nhsolo.com/sipangkat/sso/callback.php","http://localhost/sipangkat/sso/callback.php"]',
                'grant_types' => '["authorization_code","refresh_token"]',
                'revoked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '019ff406-8ee7-70f2-9bb6-496029cfdde0',
                'name' => 'E-Gajian App',
                'secret' => '$2y$12$wo7Zp2zrWB9.8gnLRuuuaeI/KPhYxOFDmwRJe7EeLGc57hSXOyW6q',
                'redirect_uris' => '["http://localhost/e-gajian/sso/callback.php"]',
                'grant_types' => '["authorization_code","refresh_token"]',
                'revoked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($clients as $client) {
            $exists = DB::table('oauth_clients')->where('id', $client['id'])->exists();
            if ($exists) {
                DB::table('oauth_clients')->where('id', $client['id'])->update($client);
            } else {
                DB::table('oauth_clients')->insert($client);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('oauth_clients')->whereIn('id', [
            '019ff3fe-b5e2-7270-8329-78785fa016dd',
            '019ff3fe-b9ed-71e0-902b-6dffffbf9473',
            '019ff3fe-bdc9-735b-a6ed-fc25a35d9ef2',
            '019ff406-8ee7-70f2-9bb6-496029cfdde0',
        ])->delete();
    }
};
