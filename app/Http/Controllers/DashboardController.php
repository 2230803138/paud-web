<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ================= SISWA =================
        $totalSiswa = Siswa::count();

        // ================= GURU =================
        $totalGuru = Guru::count();

        // ================= PENDAFTARAN =================
        $totalPendaftaran = Pendaftaran::count();

        $jumlahDiterima = Pendaftaran::where('status', 'diterima')->count();

        $pendaftaranTerbaru = Pendaftaran::latest()->take(5)->get();

        $aktivitas = Pendaftaran::latest()->take(5)->get();

        $isPgsql = DB::connection()->getDriverName() === 'pgsql';
        $pendaftaranMonthExpr = $isPgsql ? 'EXTRACT(MONTH FROM created_at)' : 'MONTH(created_at)';

        $grafik = Pendaftaran::selectRaw("{$pendaftaranMonthExpr} as bulan, COUNT(*) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // ================= PEMBAYARAN =================
        $totalPembayaran = Pembayaran::count();

        $jumlahLunas = Pembayaran::where('status', 'Lunas')->count();

        $jumlahBelumLunas = Pembayaran::where('status', 'Belum Lunas')->count();

        $totalNominal = Pembayaran::where('status', 'Lunas')->sum('nominal');

        // Pembayaran bulan ini
        $pembayaranBulanIni = Pembayaran::whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->count();

        // Total pemasukan bulan ini
        $pemasukanBulanIni = Pembayaran::where('status', 'Lunas')
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('nominal');

        // ================= GRAFIK PEMASUKAN =================
            $pembayaranMonthExpr = $isPgsql ? 'EXTRACT(MONTH FROM tanggal_bayar)' : 'MONTH(tanggal_bayar)';

            $grafikPembayaran = Pembayaran::select(
                    DB::raw("{$pembayaranMonthExpr} as bulan"),
                    DB::raw('SUM(nominal) as total')
                )
                ->where('status', 'Lunas')
                ->whereYear('tanggal_bayar', now()->year)
                ->groupBy(DB::raw($pembayaranMonthExpr))
                ->orderBy(DB::raw($pembayaranMonthExpr))
                ->get();

            $labelBulan = [];
            $dataPemasukan = [];

            $namaBulan = [
                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
                5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
                9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
            ];

            for ($i = 1; $i <= 12; $i++) {
                $labelBulan[] = $namaBulan[$i];

                $item = $grafikPembayaran->firstWhere('bulan', $i);

                $dataPemasukan[] = $item ? (int) $item->total : 0;
            }

        // ================= RETURN =================
        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalPendaftaran',
            'jumlahDiterima',
            'pendaftaranTerbaru',
            'aktivitas',
            'grafik',

            // Pembayaran
            'totalPembayaran',
            'jumlahLunas',
            'jumlahBelumLunas',
            'totalNominal',
            'pembayaranBulanIni',
            'pemasukanBulanIni',

            // Grafik Pemasukan
            'labelBulan',
            'dataPemasukan'
        ));
    }

    public function search(Request $request)
    {
        $q = $request->query('q', '');
        
        if (empty($q)) {
            return response()->json([
                'menus' => [],
                'siswa' => [],
                'guru' => []
            ]);
        }

        // Search Menus
        $allMenus = [
            ['name' => 'Dashboard', 'url' => '/dashboard', 'icon' => '🏠'],
            ['name' => 'Verifikasi Pendaftaran', 'url' => '/pendaftaran', 'icon' => '📝'],
            ['name' => 'Data Peserta Didik', 'url' => '/siswa', 'icon' => '👨‍🎓'],
            ['name' => 'Absensi Siswa', 'url' => '/absensi', 'icon' => '📅'],
            ['name' => 'Absensi Guru', 'url' => '/absensi-guru', 'icon' => '👩‍🏫'],
            ['name' => 'Data Guru', 'url' => '/guru', 'icon' => '👩‍🏫'],
            ['name' => 'Data Kelas', 'url' => '/kelas', 'icon' => '📚'],
            ['name' => 'Pembayaran SPP', 'url' => '/pembayaran', 'icon' => '💳'],
            ['name' => 'Jadwal Kegiatan', 'url' => '/jadwal', 'icon' => '📅'],
            ['name' => 'Informasi Sekolah', 'url' => '/informasi', 'icon' => '📢'],
            ['name' => 'Laporan Ekspor', 'url' => '/laporan', 'icon' => '📄'],
        ];

        $matchedMenus = [];
        foreach ($allMenus as $menu) {
            if (stripos($menu['name'], $q) !== false) {
                $matchedMenus[] = $menu;
            }
        }

        // Search Students
        $siswa = Siswa::where('nama', 'like', "%{$q}%")
            ->orWhere('kelas', 'like', "%{$q}%")
            ->take(5)
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->nama,
                    'desc' => 'Kelas: ' . ($item->kelas ?? '-'),
                    'url' => '/siswa/' . $item->id . '/edit',
                    'icon' => '👶'
                ];
            });

        // Search Teachers
        $guru = Guru::where('nama', 'like', "%{$q}%")
            ->orWhere('jabatan', 'like', "%{$q}%")
            ->take(5)
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->nama,
                    'desc' => 'Jabatan: ' . ucwords($item->jabatan),
                    'url' => '/guru/' . $item->id . '/edit',
                    'icon' => '👩‍🏫'
                ];
            });

        return response()->json([
            'menus' => $matchedMenus,
            'siswa' => $siswa,
            'guru' => $guru
        ]);
    }

    public function notifications()
    {
        $pendingPendaftaran = Pendaftaran::where('status', 'menunggu')->latest()->take(5)->get();
        $count = Pendaftaran::where('status', 'menunggu')->count();
        
        return response()->json([
            'count' => $count,
            'items' => $pendingPendaftaran->map(function($item) {
                return [
                    'title' => 'Pendaftaran Baru',
                    'body' => 'Calon Siswa: ' . $item->nama_anak,
                    'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                    'url' => '/pendaftaran'
                ];
            })
        ]);
    }
}