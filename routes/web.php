<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Auth\OrangtuaRegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\DashboardGuruController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// ================= HOME =================
Route::get('/', function () {
    $informasi = \App\Models\Informasi::where('status', 'Dipublikasikan')
        ->latest('tanggal')
        ->get();

    return view('home', compact('informasi'));
});

// ================= REGISTER ORANG TUA =================
Route::get('/register-orangtua', [OrangtuaRegisterController::class, 'create'])
    ->middleware('guest')
    ->name('orangtua.register');

Route::post('/register-orangtua', [OrangtuaRegisterController::class, 'store'])
    ->middleware('guest')
    ->name('orangtua.register.store');

// ================= LOGIN ORANG TUA =================
Route::get('/login-orangtua', function () {
    return view('auth.login-orangtua');
})->name('login.orangtua');

Route::post('/login-orangtua', [AuthenticatedSessionController::class, 'store']);

// ================= DASHBOARD ADMIN =================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard');

Route::get('/admin/search', [DashboardController::class, 'search'])
    ->middleware(['auth', 'admin'])
    ->name('admin.search');

Route::get('/admin/notifications', [DashboardController::class, 'notifications'])
    ->middleware(['auth', 'admin'])
    ->name('admin.notifications');

// ================= DASHBOARD ORANG TUA =================
Route::get('/dashboard-orangtua', function () {

    $siswa = \App\Models\Siswa::where('user_id', auth()->id())->first();

    $hadir = 0;
    $izin = 0;
    $sakit = 0;
    $alfa = 0;
    $belumLunasCount = 0;
    $belumLunasItems = collect();

    if ($siswa) {

        $hadir = \App\Models\Absensi::where('siswa_id', $siswa->id)
            ->where('status', 'Hadir')
            ->count();

        $izin = \App\Models\Absensi::where('siswa_id', $siswa->id)
            ->where('status', 'Izin')
            ->count();

        $sakit = \App\Models\Absensi::where('siswa_id', $siswa->id)
            ->where('status', 'Sakit')
            ->count();

        $alfa = \App\Models\Absensi::where('siswa_id', $siswa->id)
            ->where('status', 'Alfa')
            ->count();

        // Get SPP tagihan belum lunas
        $belumLunasCount = \App\Models\Pembayaran::where('siswa_id', $siswa->id)
            ->where('status', 'Belum Lunas')
            ->count();

        $belumLunasItems = \App\Models\Pembayaran::where('siswa_id', $siswa->id)
            ->where('status', 'Belum Lunas')
            ->get();

        // Get last payment date
        $lastPayment = \App\Models\Pembayaran::where('siswa_id', $siswa->id)
            ->where('status', 'Lunas')
            ->whereNotNull('tanggal_bayar')
            ->latest('tanggal_bayar')
            ->first();

        $lastPaymentDate = $lastPayment ? $lastPayment->tanggal_bayar : null;

        // Get Laporan data for chart or photos depending on class
        $laporanPerkembangan = \App\Models\Laporan::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'asc')
            ->get();

        $fotoKegiatan = \App\Models\Laporan::where('siswa_id', $siswa->id)
            ->whereNotNull('foto')
            ->orderBy('tanggal', 'desc')
            ->get();
    } else {
        $laporanPerkembangan = collect();
        $fotoKegiatan = collect();
    }

    return view('orangtua.dashboard', compact(
        'siswa',
        'hadir',
        'izin',
        'sakit',
        'alfa',
        'belumLunasCount',
        'belumLunasItems',
        'lastPaymentDate',
        'laporanPerkembangan',
        'fotoKegiatan'
    ));

})->middleware(['auth','orangtua'])->name('dashboard.orangtua');

// ================= KELAS =================
Route::resource('kelas', KelasController::class)
    ->middleware(['auth', 'admin']);

// ================= PEMBAYARAN PDF =================
Route::get('/pembayaran/pdf', [PembayaranController::class, 'exportPdf'])
    ->middleware(['auth', 'admin'])
    ->name('pembayaran.pdf');

// ================= SISWA =================
Route::resource('siswa', SiswaController::class)
    ->middleware(['auth', 'admin']);

// ================= GURU =================
Route::resource('guru', GuruController::class)
    ->middleware(['auth', 'admin']);

// ================= DASHBOARD GURU =================
Route::middleware(['auth', 'guru'])->group(function () {

    Route::get('/dashboard-guru', [DashboardGuruController::class, 'index'])
        ->name('dashboard.guru');

    Route::get('/dashboard-guru/absensi', [DashboardGuruController::class, 'absensi'])
        ->name('guru.absensi');

    Route::post('/dashboard-guru/absen-izin-sakit', [AbsensiGuruController::class, 'storeIzinSakit'])
        ->name('guru.absen.izin-sakit');

    Route::get('/dashboard-guru/absensi-anak', [DashboardGuruController::class, 'absensiAnak'])
        ->name('guru.absensi-anak');

    Route::post('/dashboard-guru/absensi-anak', [DashboardGuruController::class, 'storeAbsensiAnak'])
        ->name('guru.absensi-anak.store');

    Route::get('/dashboard-guru/perkembangan-anak', [DashboardGuruController::class, 'perkembangan'])
        ->name('guru.perkembangan');

    Route::post('/dashboard-guru/perkembangan-anak', [DashboardGuruController::class, 'storePerkembangan'])
        ->name('guru.perkembangan.store');

    Route::get('/dashboard-guru/perkembangan-anak/{id}/edit', [DashboardGuruController::class, 'editPerkembangan'])
        ->name('guru.perkembangan.edit');

    Route::put('/dashboard-guru/perkembangan-anak/{id}', [DashboardGuruController::class, 'updatePerkembangan'])
        ->name('guru.perkembangan.update');

    Route::delete('/dashboard-guru/perkembangan-anak/{id}', [DashboardGuruController::class, 'destroyPerkembangan'])
        ->name('guru.perkembangan.destroy');

    Route::get('/dashboard-guru/profil', [DashboardGuruController::class, 'profil'])
        ->name('guru.profil');

    Route::post('/dashboard-guru/profil', [DashboardGuruController::class, 'updateProfil'])
        ->name('guru.profil.update');

    Route::post('/dashboard-guru/absen-masuk', [AbsensiGuruController::class, 'masuk'])
        ->name('guru.absen.masuk');

    Route::post('/dashboard-guru/absen-pulang', [AbsensiGuruController::class, 'pulang'])
        ->name('guru.absen.pulang');
});

// ================= LOGIN GURU =================
Route::get('/login-guru', [AuthenticatedSessionController::class, 'createGuru'])
    ->middleware('guest')
    ->name('guru.login');

Route::post('/login-guru', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('guru.login.store');

// ================= LOGIN YAYASAN =================
Route::get('/login-yayasan', [AuthenticatedSessionController::class, 'createYayasan'])
    ->middleware('guest')
    ->name('yayasan.login');

Route::post('/login-yayasan', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('yayasan.login.store');
    
// Rekap Absensi Guru (Admin)
Route::get('/absensi-guru', [AbsensiGuruController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('absensi.guru.index');
// ================= INFORMASI =================
Route::resource('informasi', InformasiController::class)
    ->middleware(['auth', 'admin']);

// ================= ABSENSI =================
Route::resource('absensi', AbsensiController::class)
    ->middleware(['auth']);

// ================= ABSENSI ANAK =================
Route::get('/absensi-anak', function () {

    $absensi = \App\Models\Absensi::with('siswa')
        ->whereHas('siswa', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->latest()
        ->get();

    return view('orangtua.absensi', compact('absensi'));

})->middleware(['auth','orangtua'])
  ->name('orangtua.absensi');

// ================= JADWAL =================
Route::resource('jadwal', JadwalController::class)
    ->middleware(['auth', 'admin']);

// ================= PENDAFTARAN =================

// Form pendaftaran
Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])
    ->name('pendaftaran.create');

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
    ->name('pendaftaran.store');

// Admin
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])
    ->middleware(['auth','admin'])
    ->name('pendaftaran.index');

Route::get('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'show'])
    ->middleware(['auth','admin'])
    ->name('pendaftaran.show');

Route::get('/pendaftaran/{pendaftaran}/edit', [PendaftaranController::class, 'edit'])
    ->middleware(['auth','admin'])
    ->name('pendaftaran.edit');

Route::put('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'update'])
    ->middleware(['auth','admin'])
    ->name('pendaftaran.update');

Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy'])
    ->middleware(['auth','admin'])
    ->name('pendaftaran.destroy');

Route::put('/pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])
    ->middleware(['auth','admin'])
    ->name('pendaftaran.status');

// Publik
Route::get('/cek-pendaftaran', [PendaftaranController::class, 'cekForm']);
Route::post('/cek-pendaftaran', [PendaftaranController::class, 'cekStatus']);

// ================= CHAT =================
Route::resource('chat', ChatController::class)
    ->middleware(['auth', 'admin']);

// ================= LAPORAN =================
Route::resource('laporan', LaporanController::class)
    ->middleware(['auth', 'admin']);

// ================= PEMBAYARAN =================
Route::resource('pembayaran', PembayaranController::class)
    ->middleware(['auth', 'admin']);



// ================= ORANG TUA =================

Route::get('/orangtua/laporan', [LaporanController::class, 'laporanOrtu'])
    ->middleware(['auth','orangtua'])
    ->name('orangtua.laporan');

Route::get('/laporan-anak', function () {

    $siswa = \App\Models\Siswa::where('user_id', auth()->id())->first();

    if (!$siswa) {
        return view('orangtua.laporan', [
            'siswa' => null,
            'laporan' => collect(),
        ]);
    }

    $laporan = \App\Models\Laporan::with('guru')->where('siswa_id', $siswa->id)
                    ->latest()
                    ->get();

    return view('orangtua.laporan', compact('siswa', 'laporan'));

})->middleware(['auth','orangtua']);

// ================= PEMBAYARAN ORANG TUA =================
Route::get('/pembayaran-orangtua', function () {
    $siswa = \App\Models\Siswa::where('user_id', auth()->id())->first();

    if (!$siswa) {
        return view('orangtua.pembayaran', [
            'siswa' => null,
            'pembayaran' => collect(),
        ]);
    }

    $pembayaran = \App\Models\Pembayaran::where('siswa_id', $siswa->id)
                    ->latest()
                    ->get();

    return view('orangtua.pembayaran', compact('siswa', 'pembayaran'));

})->middleware(['auth','orangtua'])
  ->name('orangtua.pembayaran');

Route::get('/jadwal-orangtua', function () {

    $siswa = \App\Models\Siswa::where('user_id', auth()->id())->first();

    if (!$siswa) {
        return view('orangtua.jadwal', [
            'siswa' => null,
            'jadwal' => collect(),
        ]);
    }

    $jadwal = \App\Models\Jadwal::where('kelas', $siswa->kelas)
        ->orderBy('tanggal')
        ->get();

    return view('orangtua.jadwal', compact('siswa', 'jadwal'));

})->middleware(['auth','orangtua'])
  ->name('orangtua.jadwal');

// ================= ULASAN GURU =================
Route::get('/orangtua/ulasan', [\App\Http\Controllers\UlasanController::class, 'index'])
    ->middleware(['auth', 'orangtua'])
    ->name('orangtua.ulasan.index');
Route::post('/orangtua/ulasan', [\App\Http\Controllers\UlasanController::class, 'store'])
    ->middleware(['auth', 'orangtua'])
    ->name('orangtua.ulasan.store');

// ================= PROFILE =================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// ================= DASHBOARD YAYASAN =================
Route::middleware(['auth', 'yayasan'])->group(function () {
    Route::get('/dashboard-yayasan', [\App\Http\Controllers\YayasanController::class, 'index'])
        ->name('dashboard.yayasan');
    Route::get('/dashboard-yayasan/pdf', [\App\Http\Controllers\YayasanController::class, 'pdfDashboard'])
        ->name('yayasan.dashboard.pdf');

    Route::get('/dashboard-yayasan/laporan-guru', [\App\Http\Controllers\YayasanController::class, 'laporanGuru'])
        ->name('yayasan.laporan-guru');
    Route::get('/dashboard-yayasan/laporan-guru/pdf', [\App\Http\Controllers\YayasanController::class, 'pdfGuru'])
        ->name('yayasan.laporan-guru.pdf');
    Route::get('/dashboard-yayasan/laporan-guru/absensi/pdf', [\App\Http\Controllers\YayasanController::class, 'pdfAbsensiGuru'])
        ->name('yayasan.laporan-guru.absensi.pdf');

    Route::get('/dashboard-yayasan/laporan-siswa', [\App\Http\Controllers\YayasanController::class, 'laporanSiswa'])
        ->name('yayasan.laporan-siswa');
    Route::get('/dashboard-yayasan/laporan-siswa/pdf', [\App\Http\Controllers\YayasanController::class, 'pdfSiswa'])
        ->name('yayasan.laporan-siswa.pdf');
    Route::get('/dashboard-yayasan/laporan-siswa/absensi/pdf', [\App\Http\Controllers\YayasanController::class, 'pdfAbsensiSiswa'])
        ->name('yayasan.laporan-siswa.absensi.pdf');

    Route::get('/dashboard-yayasan/laporan-pembayaran', [\App\Http\Controllers\YayasanController::class, 'laporanPembayaran'])
        ->name('yayasan.laporan-pembayaran');
    Route::get('/dashboard-yayasan/laporan-pembayaran/pdf', [\App\Http\Controllers\YayasanController::class, 'pdfPembayaran'])
        ->name('yayasan.laporan-pembayaran.pdf');

    Route::get('/dashboard-yayasan/laporan-pendaftaran', [\App\Http\Controllers\YayasanController::class, 'laporanPendaftaran'])
        ->name('yayasan.laporan-pendaftaran');
    Route::get('/dashboard-yayasan/laporan-pendaftaran/pdf', [\App\Http\Controllers\YayasanController::class, 'pdfPendaftaran'])
        ->name('yayasan.laporan-pendaftaran.pdf');

    // Ulasan Guru
    Route::get('/dashboard-yayasan/ulasan-guru', [\App\Http\Controllers\UlasanController::class, 'laporanYayasan'])
        ->name('yayasan.laporan-ulasan');
});

require __DIR__.'/auth.php';