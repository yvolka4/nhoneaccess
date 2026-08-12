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
        // Update SIM Utama
        DB::table('oauth_clients')
            ->where('id', '019ff3fe-b9ed-71e0-902b-6dffffbf9473')
            ->update([
                'redirect_uris' => '["https://nhsolo.com/sim/sso/callback_oauth2.php","http://nhsolo.com/sim/sso/callback.php","http://localhost/sim/sso/callback.php","http://localhost/sim/sso/callback_oauth2.php","http://puskomnh.com/sim/sso/callback_oauth2.php","https://puskomnh.com/sim/sso/callback_oauth2.php"]',
            ]);

        // Update SIKAP
        DB::table('oauth_clients')
            ->where('id', '019ff3fe-b5e2-7270-8329-78785fa016dd')
            ->update([
                'redirect_uris' => '["https://nhsolo.com/sikap/sso/callback_oauth2.php","http://nhsolo.com/sikap/sso/callback.php","http://localhost/sikap/sso/callback.php"]',
            ]);

        // Update SIPANGKAT
        DB::table('oauth_clients')
            ->where('id', '019ff3fe-bdc9-735b-a6ed-fc25a35d9ef2')
            ->update([
                'redirect_uris' => '["https://nhsolo.com/sipangkat/sso/callback_oauth2.php","http://nhsolo.com/sipangkat/sso/callback.php","http://localhost/sipangkat/sso/callback.php"]',
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Update SIM Utama
        DB::table('oauth_clients')
            ->where('id', '019ff3fe-b9ed-71e0-902b-6dffffbf9473')
            ->update([
                'redirect_uris' => '["http://nhsolo.com/sim/sso/callback.php","http://localhost/sim/sso/callback.php","http://localhost/sim/sso/callback_oauth2.php","http://puskomnh.com/sim/sso/callback_oauth2.php","https://puskomnh.com/sim/sso/callback_oauth2.php"]',
            ]);

        // Update SIKAP
        DB::table('oauth_clients')
            ->where('id', '019ff3fe-b5e2-7270-8329-78785fa016dd')
            ->update([
                'redirect_uris' => '["http://nhsolo.com/sikap/sso/callback.php","http://localhost/sikap/sso/callback.php"]',
            ]);

        // Update SIPANGKAT
        DB::table('oauth_clients')
            ->where('id', '019ff3fe-bdc9-735b-a6ed-fc25a35d9ef2')
            ->update([
                'redirect_uris' => '["http://nhsolo.com/sipangkat/sso/callback.php","http://localhost/sipangkat/sso/callback.php"]',
            ]);
    }
};
