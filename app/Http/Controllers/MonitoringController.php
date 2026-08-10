<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        
        $sikapDb = DB::connection('sikap');
        
        try {
            // 1. Total Karyawan
            $total_karyawan_raw = $sikapDb->table('tuser')
                ->whereIn('role_id', [3, 111])
                ->count('id_user');
            $total_karyawan = $total_karyawan_raw - 34;

            // 2. Total Hadir
            $total_hadir = $sikapDb->table('absensi as a')
                ->join('tuser as t', 'a.id_user', '=', 't.id_user')
                ->where('a.tanggal_absen', $today)
                ->whereIn('t.role_id', [3, 111])
                ->distinct('a.id_user')
                ->count('a.id_user');

            $total_tidak_hadir = $total_karyawan - $total_hadir;

            // 3. Daftar Kantor
            $daftar_kantor_raw = $sikapDb->table('kantor')
                ->select('id_kantor', 'nama_kantor')
                ->get();
            
            // Urutkan daftar kantor sesuai urutan id: 2,3,4,5,14,7,6,8,9,1
            // DAN pastikan hanya unit ini saja yang ditampilkan
            $urutan_id = ['2', '3', '4', '5', '14', '7', '6', '8', '9', '1'];
            $daftar_kantor = collect();
            
            foreach($urutan_id as $uid) {
                $kantor = $daftar_kantor_raw->firstWhere('id_kantor', $uid);
                if ($kantor) $daftar_kantor->push($kantor);
            }

            // 4. Jumlah Hadir per Kantor
            $login_per_kantor = $sikapDb->table('absensi as a')
                ->join('tuser as t', 'a.id_user', '=', 't.id_user')
                ->selectRaw("TRIM(SUBSTRING_INDEX(t.id_kantor, ',', 1)) AS id_kantor_utama, COUNT(DISTINCT a.id_user) AS jumlah_login")
                ->where('a.tanggal_absen', $today)
                ->whereIn('t.role_id', [3, 111])
                ->groupBy('id_kantor_utama')
                ->pluck('jumlah_login', 'id_kantor_utama')
                ->toArray();

            // 5. Total Karyawan per Kantor
            $karyawan_per_kantor = $sikapDb->table('tuser')
                ->selectRaw("TRIM(SUBSTRING_INDEX(id_kantor, ',', 1)) AS id_kantor_utama, COUNT(id_user) AS jumlah_total_karyawan")
                ->whereIn('role_id', [3, 111])
                ->groupBy('id_kantor_utama')
                ->pluck('jumlah_total_karyawan', 'id_kantor_utama')
                ->toArray();
                
            // 6. Data Terlambat & Pulang Cepat
            $total_terlambat = $sikapDb->table('absensi as a')
                ->join('tuser as t', 'a.id_user', '=', 't.id_user')
                ->where('a.tanggal_absen', $today)
                ->whereIn('t.role_id', [3, 111])
                ->where('a.waktu_keterlambatan', '>', '00:00:00')
                ->distinct('a.id_user')
                ->count('a.id_user');

            $total_pulang_cepat = $sikapDb->table('absensi as a')
                ->join('tuser as t', 'a.id_user', '=', 't.id_user')
                ->where('a.tanggal_absen', $today)
                ->whereIn('t.role_id', [3, 111])
                ->where('a.waktu_pulang_awal', '>', '00:00:00')
                ->distinct('a.id_user')
                ->count('a.id_user');

            // 7. Data Izin
            $total_izin = $sikapDb->table('izin_kerja as i')
                ->join('tuser as t', 'i.id_user', '=', 't.id_user')
                ->where('i.tanggal_izin', $today)
                ->whereIn('t.role_id', [3, 111])
                // ->where('i.status', 'Disetujui') // Buka komentar jika izin perlu difilter berdasarkan status ACC atasan
                ->distinct('i.id_user')
                ->count('i.id_user');

            // Hitung ulang total tidak hadir (karyawan - hadir - izin)
            $total_tidak_hadir = $total_karyawan - $total_hadir - $total_izin;
                
            $dbError = null;
        } catch (\Exception $e) {
            $dbError = "Gagal mengambil data dari database SIKAP: " . $e->getMessage();
            $total_karyawan = 0;
            $total_hadir = 0;
            $total_tidak_hadir = 0;
            $total_terlambat = 0;
            $total_pulang_cepat = 0;
            $total_izin = 0;
            $daftar_kantor = collect([]);
            $login_per_kantor = [];
            $karyawan_per_kantor = [];
        }

        return view('monitiring', compact(
            'total_karyawan',
            'total_hadir',
            'total_tidak_hadir',
            'total_terlambat',
            'total_pulang_cepat',
            'total_izin',
            'daftar_kantor',
            'login_per_kantor',
            'karyawan_per_kantor',
            'dbError'
        ));
    }
}
