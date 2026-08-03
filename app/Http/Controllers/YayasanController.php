<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\AbsensiGuru;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class YayasanController extends Controller
{
    public function index(Request $request)
    {
        $cabangId = $request->input('cabang_id');

        $queryGuru = Guru::query();
        $querySiswa = Siswa::query();
        $queryPembayaran = Pembayaran::query();
        $queryPendaftaran = Pendaftaran::query();
        $queryAbsensi = Absensi::query();

        if ($cabangId) {
            $queryGuru->where('cabang_id', $cabangId);
            $querySiswa->where('cabang_id', $cabangId);
            $queryPembayaran->where('cabang_id', $cabangId);
            $queryPendaftaran->where('cabang_id', $cabangId);
            $queryAbsensi->where('cabang_id', $cabangId);
        }

        $totalGuru = $queryGuru->count();
        $totalSiswa = $querySiswa->count();
        $totalPembayaranLunas = $queryPembayaran->where('status', 'Lunas')->sum('nominal');
        $totalPendaftaran = $queryPendaftaran->count();

        // Recent pendaftaran registrations
        $recentPendaftaran = (clone $queryPendaftaran)->latest()->take(5)->get();

        // Count of students per class
        $kelasStats = [
            'Baby Class' => (clone $querySiswa)->where('kelas', 'Baby Class')->count(),
            'Toddler' => (clone $querySiswa)->where('kelas', 'Toddler')->count(),
            'Nursery' => (clone $querySiswa)->where('kelas', 'Nursery')->count(),
        ];

        // SPP Monthly Revenue Chart Data
        $currentYear = today()->year;
        $sppMonthlyData = (clone $queryPembayaran)->selectRaw('bulan, SUM(nominal) as total')
            ->where('tahun', $currentYear)
            ->where('status', 'Lunas')
            ->groupBy('bulan')
            ->get();

        $monthsOrder = [
            'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4,
            'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8,
            'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
        ];
        
        $sppMonthlyOrdered = collect($monthsOrder)->map(function($num, $name) use ($sppMonthlyData) {
            $found = $sppMonthlyData->firstWhere('bulan', $name);
            return $found ? (int)$found->total : 0;
        });

        // Student Attendance Doughnut Chart Data
        $attendanceStats = (clone $queryAbsensi)->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();
        
        $studentAttendanceData = [
            'hadir' => ($attendanceStats['Hadir'] ?? 0) + ($attendanceStats['hadir'] ?? 0),
            'izin' => ($attendanceStats['Izin'] ?? 0) + ($attendanceStats['izin'] ?? 0),
            'sakit' => ($attendanceStats['Sakit'] ?? 0) + ($attendanceStats['sakit'] ?? 0),
            'alfa' => ($attendanceStats['Alfa'] ?? 0) + ($attendanceStats['alfa'] ?? 0),
        ];

        return view('yayasan.dashboard', compact(
            'totalGuru',
            'totalSiswa',
            'totalPembayaranLunas',
            'totalPendaftaran',
            'recentPendaftaran',
            'kelasStats',
            'sppMonthlyOrdered',
            'studentAttendanceData',
            'currentYear'
        ));
    }

    public function pdfDashboard(Request $request)
    {
        $cabangId = $request->input('cabang_id');

        $queryGuru = Guru::query();
        $querySiswa = Siswa::query();
        $queryPembayaran = Pembayaran::query();
        $queryPendaftaran = Pendaftaran::query();
        $queryAbsensi = Absensi::query();

        if ($cabangId) {
            $queryGuru->where('cabang_id', $cabangId);
            $querySiswa->where('cabang_id', $cabangId);
            $queryPembayaran->where('cabang_id', $cabangId);
            $queryPendaftaran->where('cabang_id', $cabangId);
            $queryAbsensi->where('cabang_id', $cabangId);
        }

        $totalGuru = $queryGuru->count();
        $totalSiswa = $querySiswa->count();
        $totalPembayaranLunas = $queryPembayaran->where('status', 'Lunas')->sum('nominal');
        $totalPendaftaran = $queryPendaftaran->count();

        // Recent pendaftaran registrations
        $recentPendaftaran = (clone $queryPendaftaran)->latest()->take(5)->get();

        // Count of students per class
        $kelasStats = [
            'Baby Class' => (clone $querySiswa)->where('kelas', 'Baby Class')->count(),
            'Toddler' => (clone $querySiswa)->where('kelas', 'Toddler')->count(),
            'Nursery' => (clone $querySiswa)->where('kelas', 'Nursery')->count(),
        ];

        // SPP Monthly Revenue
        $currentYear = today()->year;
        $sppMonthlyData = (clone $queryPembayaran)->selectRaw('bulan, SUM(nominal) as total')
            ->where('tahun', $currentYear)
            ->where('status', 'Lunas')
            ->groupBy('bulan')
            ->get();

        $monthsOrder = [
            'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4,
            'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8,
            'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
        ];
        
        $sppMonthlyOrdered = collect($monthsOrder)->mapWithKeys(function($num, $name) use ($sppMonthlyData) {
            $found = $sppMonthlyData->firstWhere('bulan', $name);
            return [$name => $found ? (int)$found->total : 0];
        });

        // Student Attendance Data
        $attendanceStats = (clone $queryAbsensi)->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();
        
        $studentAttendanceData = [
            'hadir' => ($attendanceStats['Hadir'] ?? 0) + ($attendanceStats['hadir'] ?? 0),
            'izin' => ($attendanceStats['Izin'] ?? 0) + ($attendanceStats['izin'] ?? 0),
            'sakit' => ($attendanceStats['Sakit'] ?? 0) + ($attendanceStats['sakit'] ?? 0),
            'alfa' => ($attendanceStats['Alfa'] ?? 0) + ($attendanceStats['alfa'] ?? 0),
        ];

        $cabang = $cabangId ? \App\Models\Cabang::find($cabangId) : null;

        $pdf = Pdf::loadView('yayasan.pdf-dashboard', compact(
            'totalGuru',
            'totalSiswa',
            'totalPembayaranLunas',
            'totalPendaftaran',
            'recentPendaftaran',
            'kelasStats',
            'sppMonthlyOrdered',
            'studentAttendanceData',
            'currentYear',
            'cabang'
        ));

        return $pdf->download('Laporan-Menyeluruh-Ebony-Preschool.pdf');
    }

    public function laporanGuru(Request $request)
    {
        $cabangId = $request->input('cabang_id');

        $queryGuru = Guru::orderBy('nama');
        $queryAbsensi = AbsensiGuru::with('guru');

        if ($cabangId) {
            $queryGuru->where('cabang_id', $cabangId);
            $queryAbsensi->where('cabang_id', $cabangId);
        }

        $guru = $queryGuru->get();

        // Filters for Absensi Guru
        $tanggalMulai = $request->input('tanggal_mulai', today()->startOfMonth()->toDateString());
        $tanggalSelesai = $request->input('tanggal_selesai', today()->toDateString());
        $guruId = $request->input('guru_id');

        $queryAbsensi->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai]);

        if ($guruId) {
            $queryAbsensi->where('guru_id', $guruId);
        }

        $absensi = $queryAbsensi->orderBy('tanggal', 'desc')->get();

        return view('yayasan.laporan-guru', compact('guru', 'absensi', 'tanggalMulai', 'tanggalSelesai', 'guruId'));
    }

    public function pdfGuru(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $query = Guru::orderBy('nama');
        if ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }
        $guru = $query->get();
        $pdf = Pdf::loadView('yayasan.pdf-guru', compact('guru'));
        return $pdf->download('Laporan-Data-Guru-Ebony.pdf');
    }

    public function pdfAbsensiGuru(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $tanggalMulai = $request->input('tanggal_mulai', today()->startOfMonth()->toDateString());
        $tanggalSelesai = $request->input('tanggal_selesai', today()->toDateString());
        $guruId = $request->input('guru_id');

        $queryAbsensi = AbsensiGuru::with('guru')
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai]);

        if ($cabangId) {
            $queryAbsensi->where('cabang_id', $cabangId);
        }

        $selectedGuru = null;
        if ($guruId) {
            $queryAbsensi->where('guru_id', $guruId);
            $selectedGuru = Guru::find($guruId);
        }

        $absensi = $queryAbsensi->orderBy('tanggal', 'desc')->get();

        $pdf = Pdf::loadView('yayasan.pdf-absensi-guru', compact('absensi', 'tanggalMulai', 'tanggalSelesai', 'selectedGuru'));
        return $pdf->download('Laporan-Absensi-Guru-Ebony.pdf');
    }

    public function laporanSiswa(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $kelasOptions = ['Baby Class', 'Toddler', 'Nursery'];
        $kelas = $request->input('kelas');

        $querySiswa = Siswa::query();
        $queryAbsensi = Absensi::with('siswa');

        if ($cabangId) {
            $querySiswa->where('cabang_id', $cabangId);
            $queryAbsensi->where('cabang_id', $cabangId);
        }

        if ($kelas) {
            $querySiswa->where('kelas', $kelas);
        }
        $siswa = $querySiswa->orderBy('nama')->get();

        // Filters for Absensi Siswa
        $tanggalMulai = $request->input('tanggal_mulai', today()->startOfMonth()->toDateString());
        $tanggalSelesai = $request->input('tanggal_selesai', today()->toDateString());
        $kelasAbsensi = $request->input('kelas_absensi');

        $queryAbsensi->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai]);

        if ($kelasAbsensi) {
            $queryAbsensi->whereHas('siswa', function ($q) use ($kelasAbsensi) {
                $q->where('kelas', $kelasAbsensi);
            });
        }

        $absensi = $queryAbsensi->orderBy('tanggal', 'desc')->get();

        return view('yayasan.laporan-siswa', compact(
            'siswa',
            'kelasOptions',
            'kelas',
            'absensi',
            'tanggalMulai',
            'tanggalSelesai',
            'kelasAbsensi'
        ));
    }

    public function pdfSiswa(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $kelas = $request->input('kelas');
        $querySiswa = Siswa::query();
        if ($cabangId) {
            $querySiswa->where('cabang_id', $cabangId);
        }
        if ($kelas) {
            $querySiswa->where('kelas', $kelas);
        }
        $siswa = $querySiswa->orderBy('nama')->get();

        $pdf = Pdf::loadView('yayasan.pdf-siswa', compact('siswa', 'kelas'));
        return $pdf->download('Laporan-Data-Siswa-Ebony.pdf');
    }

    public function pdfAbsensiSiswa(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $tanggalMulai = $request->input('tanggal_mulai', today()->startOfMonth()->toDateString());
        $tanggalSelesai = $request->input('tanggal_selesai', today()->toDateString());
        $kelasAbsensi = $request->input('kelas_absensi');

        $queryAbsensi = Absensi::with('siswa')
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai]);

        if ($cabangId) {
            $queryAbsensi->where('cabang_id', $cabangId);
        }

        if ($kelasAbsensi) {
            $queryAbsensi->whereHas('siswa', function ($q) use ($kelasAbsensi) {
                $q->where('kelas', $kelasAbsensi);
            });
        }

        $absensi = $queryAbsensi->orderBy('tanggal', 'desc')->get();

        $pdf = Pdf::loadView('yayasan.pdf-absensi-siswa', compact('absensi', 'tanggalMulai', 'tanggalSelesai', 'kelasAbsensi'));
        return $pdf->download('Laporan-Absensi-Siswa-Ebony.pdf');
    }

    public function laporanPembayaran(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $status = $request->input('status');

        $query = Pembayaran::with('siswa');

        if ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }
        if ($bulan) {
            $query->where('bulan', $bulan);
        }
        if ($tahun) {
            $query->where('tahun', $tahun);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $pembayaran = $query->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();

        $totalPemasukan = (clone $query)->where('status', 'Lunas')->sum('nominal');
        $jumlahLunas = (clone $query)->where('status', 'Lunas')->count();
        $jumlahBelumLunas = (clone $query)->where('status', 'Belum Lunas')->count();

        return view('yayasan.laporan-pembayaran', compact(
            'pembayaran',
            'bulan',
            'tahun',
            'status',
            'totalPemasukan',
            'jumlahLunas',
            'jumlahBelumLunas'
        ));
    }

    public function pdfPembayaran(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $status = $request->input('status');

        $query = Pembayaran::with('siswa');

        if ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }
        if ($bulan) {
            $query->where('bulan', $bulan);
        }
        if ($tahun) {
            $query->where('tahun', $tahun);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $pembayaran = $query->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();
        $totalPemasukan = (clone $query)->where('status', 'Lunas')->sum('nominal');

        $pdf = Pdf::loadView('yayasan.pdf-pembayaran', compact('pembayaran', 'bulan', 'tahun', 'status', 'totalPemasukan'));
        return $pdf->download('Laporan-Keuangan-Ebony.pdf');
    }

    public function laporanPendaftaran(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $status = $request->input('status');

        $query = Pendaftaran::query();
        if ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $pendaftaran = $query->latest()->get();

        return view('yayasan.laporan-pendaftaran', compact('pendaftaran', 'status'));
    }

    public function pdfPendaftaran(Request $request)
    {
        $cabangId = $request->input('cabang_id');
        $status = $request->input('status');

        $query = Pendaftaran::query();
        if ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $pendaftaran = $query->latest()->get();

        $pdf = Pdf::loadView('yayasan.pdf-pendaftaran', compact('pendaftaran', 'status'));
        return $pdf->download('Laporan-Pendaftaran-Baru-Ebony.pdf');
    }
}
