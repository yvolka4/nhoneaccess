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
        // Sikap App
        DB::table('oauth_clients')->where('id', '019ff3fe-b5e2-7270-8329-78785fa016dd')->update([
            'secret' => '$2y$10$9ywvgrSLSc1ls0cMWYVJqOeeJvIyMV.75E5fjZv.eszHF82UqAU/q',
        ]);
        
        // SIM Utama App
        DB::table('oauth_clients')->where('id', '019ff3fe-b9ed-71e0-902b-6dffffbf9473')->update([
            'secret' => '$2y$10$oymkLgbsRrnmxNGOKRYESOJi86BNjfLU.l37iKYAMtYkkSLGoOfcS',
        ]);
        
        // SIPANGKAT App
        DB::table('oauth_clients')->where('id', '019ff3fe-bdc9-735b-a6ed-fc25a35d9ef2')->update([
            'secret' => '$2y$10$cTxlkXtok.XR9TYK2fE59eYJ1HKLYtcAlXKgqBn.YWy6RtIQkqQG6',
        ]);
        
        // E-Gajian App
        DB::table('oauth_clients')->where('id', '019ff406-8ee7-70f2-9bb6-496029cfdde0')->update([
            'secret' => '$2y$10$C5vUXHgF30MM2l4OoiXkE.TrS8wWQjj8dL991GxQU1DvriG7SpA1G',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
