<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

#[Signature('sync:users-from-sim')]
#[Description('Sync users from sim_nurhidayah database to sso_yayasan database')]
class SyncUsersFromSim extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai sinkronisasi data pegawai dari SIM UTAMA ke SSO...');

        try {
            $pegawais = DB::connection('sim')->table('pegawai')->get();
            $countInserted = 0;
            $countUpdated = 0;

            foreach ($pegawais as $pegawai) {
                if (empty($pegawai->nik)) {
                    continue; // Skip jika nik kosong
                }

                $emailRaw = trim($pegawai->email ?? '');
                $email = (!empty($emailRaw) && $emailRaw !== '-') ? $emailRaw : $pegawai->nik . '@sim.nhsolo.com';
                
                // Pastikan email ini unik. Jika sudah dipakai user dengan NIK lain, gunakan email fallback
                $emailConflict = DB::table('users')->where('email', $email)->where('nik', '!=', $pegawai->nik)->exists();
                if ($emailConflict) {
                    $email = $pegawai->nik . '@sim.nhsolo.com';
                }
                
                // Gunakan password default jika kosong
                $password = !empty($pegawai->password) ? $pegawai->password : Hash::make('password123');
                
                $role = $pegawai->role ?? 'pegawai';

                // Gunakan DB Query Builder untuk menghindari double-hashing pada atribut 'password' Eloquent
                $existingUser = DB::table('users')->where('nik', $pegawai->nik)->first();

                if ($existingUser) {
                    DB::table('users')->where('id', $existingUser->id)->update([
                        'name' => $pegawai->nama_lengkap,
                        'email' => $email,
                        'password' => $password,
                        'role' => $role,
                        'is_active' => $pegawai->is_active ?? 1,
                        'updated_at' => Carbon::now(),
                    ]);
                    $countUpdated++;
                } else {
                    DB::table('users')->insert([
                        'nik' => $pegawai->nik,
                        'name' => $pegawai->nama_lengkap,
                        'email' => $email,
                        'password' => $password,
                        'role' => $role,
                        'is_active' => $pegawai->is_active ?? 1,
                        'email_verified_at' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    $countInserted++;
                }
            }

            $this->info("Sinkronisasi selesai! $countInserted user baru ditambahkan, $countUpdated user diperbarui.");
        } catch (\Exception $e) {
            $this->error("Gagal melakukan sinkronisasi: " . $e->getMessage());
        }
    }
}
