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
        DB::table('oauth_clients')
            ->where('id', '019ff406-8ee7-70f2-9bb6-496029cfdde0')
            ->update([
                'redirect_uris' => '["http://localhost/e-gajian/sso/callback.php","http://e-gajian.nhsolo.com/sso/callback","https://e-gajian.nhsolo.com/sso/callback","http://127.0.0.1:8000/sso/callback","http://localhost:8000/sso/callback"]',
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('oauth_clients')
            ->where('id', '019ff406-8ee7-70f2-9bb6-496029cfdde0')
            ->update([
                'redirect_uris' => '["http://localhost/e-gajian/sso/callback_oauth2.php"]',
            ]);
    }
};
