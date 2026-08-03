@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-8">

    <!-- 1. RINGKASAN STATISTIK UTAMA -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Total Siswa -->
        <a href="{{ route('siswa.index') }}" class="card bg-gradient-to-br from-pink-500 to-pink-400 text-white relative overflow-hidden block">
            <div>
                <p class="text-pink-100 text-sm font-semibold uppercase tracking-wider">Total Siswa</p>
                <h2 class="text-4xl font-extrabold mt-3">{{ $totalSiswa }}</h2>
                <p class="text-pink-200 text-xs mt-2">Kelola peserta didik aktif</p>
            </div>
            <div class="absolute right-4 bottom-4 text-5xl opacity-20">👨‍🎓</div>
        </a>

        <!-- Total Guru -->
        <a href="{{ route('guru.index') }}" class="card bg-gradient-to-br from-purple-500 to-indigo-500 text-white relative overflow-hidden block">
            <div>
                <p class="text-purple-100 text-sm font-semibold uppercase tracking-wider">Total Guru</p>
                <h2 class="text-4xl font-extrabold mt-3">{{ $totalGuru }}</h2>
                <p class="text-purple-200 text-xs mt-2">Kelola tenaga pendidik</p>
            </div>
            <div class="absolute right-4 bottom-4 text-5xl opacity-20">👩‍🏫</div>
        </a>

        <!-- Verifikasi Pendaftaran -->
        <a href="{{ route('pendaftaran.index') }}" class="card bg-gradient-to-br from-blue-500 to-cyan-500 text-white relative overflow-hidden block">
            <div>
                <p class="text-blue-100 text-sm font-semibold uppercase tracking-wider">Pendaftaran</p>
                <h2 class="text-4xl font-extrabold mt-3">{{ $totalPendaftaran }}</h2>
                <p class="text-blue-200 text-xs mt-2">{{ $totalPendaftaran - $jumlahDiterima }} berkas pending</p>
            </div>
            <div class="absolute right-4 bottom-4 text-5xl opacity-20">📝</div>
        </a>

        <!-- Total Pemasukan SPP -->
        <a href="/pembayaran" class="card bg-gradient-to-br from-green-500 to-emerald-500 text-white relative overflow-hidden block">
            <div>
                <p class="text-green-100 text-sm font-semibold uppercase tracking-wider">Total Uang Masuk</p>
                <h2 class="text-2xl font-extrabold mt-4">Rp {{ number_format($totalNominal, 0, ',', '.') }}</h2>
                <p class="text-green-200 text-xs mt-2">{{ $jumlahLunas }} transaksi lunas</p>
            </div>
            <div class="absolute right-4 bottom-4 text-5xl opacity-20">💰</div>
        </a>

    </div>

    <!-- 2. GRAFIK ANALISIS (SEJAJAR / SIDE-BY-SIDE) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Grafik Pendaftaran -->
        <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Grafik Pendaftaran Bulanan</h3>
                    <p class="text-xs text-gray-400 mt-1">Distribusi pendaftaran anak per bulan</p>
                </div>
                <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-xs font-bold">Tahun {{ date('Y') }}</span>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="chartPendaftaran"></canvas>
            </div>
        </div>

        <!-- Grafik Pemasukan -->
        <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Grafik Pemasukan Keuangan SPP</h3>
                    <p class="text-xs text-gray-400 mt-1">Tren penerimaan SPP lunas</p>
                </div>
                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">Tahun {{ date('Y') }}</span>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="chartPembayaran"></canvas>
            </div>
        </div>

    </div>

    <!-- 3. MENU CEPAT (QUICK NAVIGATION WIDGET) -->
    <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Navigasi Menu Cepat</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4">
            
            <a href="{{ route('siswa.index') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl hover:bg-pink-50 transition border border-gray-50 text-gray-700 hover:text-pink-600">
                <span class="text-3xl mb-2">👨‍🎓</span>
                <span class="text-xs font-bold">Data Siswa</span>
            </a>

            <a href="{{ route('guru.index') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl hover:bg-purple-50 transition border border-gray-50 text-gray-700 hover:text-purple-600">
                <span class="text-3xl mb-2">👩‍🏫</span>
                <span class="text-xs font-bold">Data Guru</span>
            </a>

            <a href="/kelas" class="flex flex-col items-center justify-center p-4 rounded-2xl hover:bg-blue-50 transition border border-gray-50 text-gray-700 hover:text-blue-600">
                <span class="text-3xl mb-2">📚</span>
                <span class="text-xs font-bold">Data Kelas</span>
            </a>

            <a href="/pembayaran" class="flex flex-col items-center justify-center p-4 rounded-2xl hover:bg-green-50 transition border border-gray-50 text-gray-700 hover:text-green-600">
                <span class="text-3xl mb-2">💳</span>
                <span class="text-xs font-bold">Pembayaran</span>
            </a>

            <a href="{{ route('pendaftaran.index') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl hover:bg-pink-50 transition border border-gray-50 text-gray-700 hover:text-pink-600">
                <span class="text-3xl mb-2">📝</span>
                <span class="text-xs font-bold">Pendaftaran</span>
            </a>

            <a href="/informasi" class="flex flex-col items-center justify-center p-4 rounded-2xl hover:bg-yellow-50 transition border border-gray-50 text-gray-700 hover:text-yellow-600">
                <span class="text-3xl mb-2">📢</span>
                <span class="text-xs font-bold">Informasi</span>
            </a>

            <a href="/laporan" class="flex flex-col items-center justify-center p-4 rounded-2xl hover:bg-indigo-50 transition border border-gray-50 text-gray-700 hover:text-indigo-600">
                <span class="text-3xl mb-2">📄</span>
                <span class="text-xs font-bold">Laporan</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl hover:bg-gray-150 transition border border-gray-50 text-gray-700 hover:text-gray-900">
                <span class="text-3xl mb-2">⚙️</span>
                <span class="text-xs font-bold">Pengaturan</span>
            </a>

        </div>
    </div>

    <!-- 4. LOG AKTIVITAS & PENDAFTARAN TERBARU -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Tabel Pendaftaran Terbaru (2/3 width) -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Calon Siswa Baru Terdaftar</h3>
                    <p class="text-xs text-gray-400 mt-1">5 pendaftar paling baru masuk ke sistem</p>
                </div>
                <a href="{{ route('pendaftaran.index') }}" class="text-pink-600 hover:text-pink-700 text-sm font-bold flex items-center gap-1">
                    Lihat Semua ➔
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-pink-50/50 text-pink-700 font-semibold text-xs uppercase tracking-wider border-b border-pink-100">
                            <th class="p-4 rounded-l-xl">No</th>
                            <th class="p-4">Nama Calon Siswa</th>
                            <th class="p-4">Orang Tua</th>
                            <th class="p-4">Tanggal Masuk</th>
                            <th class="p-4 rounded-r-xl">Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pendaftaranTerbaru as $index => $item)
                            <tr class="hover:bg-pink-50/20 transition text-sm">
                                <td class="p-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                                <td class="p-4 font-bold text-gray-800">{{ $item->nama_anak }}</td>
                                <td class="p-4 text-gray-600 font-semibold">{{ $item->nama_ortu }}</td>
                                <td class="p-4 text-gray-500">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full font-bold text-xs
                                        {{ $item->status == 'diterima' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $item->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $item->status == 'menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    ">
                                        {{ $item->status == 'menunggu' ? 'Pending' : ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400 text-sm">Belum ada data pendaftaran masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Log Aktivitas Terbaru (1/3 width) -->
        <div class="lg:col-span-1 bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-1">Aktivitas Sistem</h3>
            <p class="text-xs text-gray-400 mb-6">Log aktivitas pendaftaran terkini</p>

            <div class="space-y-6">
                @forelse($aktivitas as $item)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-lg flex-shrink-0">
                            📝
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">{{ $item->nama_anak }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Pendaftaran baru dikirim oleh {{ $item->nama_ortu }}</p>
                            <span class="text-[10px] text-gray-400 font-medium block mt-1">{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-gray-400 text-sm">Belum ada aktivitas terekam.</div>
                @endforelse
            </div>
        </div>

    </div>

</div>

<!-- Chart Script -->
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // --- 1. GRAFIK PENDAFTARAN ---
    const grafikPendaftaranData = @json($grafik);
    const pendaftaranLabels = grafikPendaftaranData.map(item => {
        const bulan = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        return bulan[item.bulan];
    });
    const pendaftaranValues = grafikPendaftaranData.map(item => item.total);

    const ctxPendaftaran = document.getElementById('chartPendaftaran').getContext('2d');
    new Chart(ctxPendaftaran, {
        type: 'bar',
        data: {
            labels: pendaftaranLabels,
            datasets: [{
                label: 'Jumlah Pendaftar',
                data: pendaftaranValues,
                backgroundColor: 'rgba(236, 72, 153, 0.85)', // Pink-500
                borderColor: '#ec4899',
                borderWidth: 1,
                borderRadius: 8,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { color: '#f1f5f9' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // --- 2. GRAFIK PEMASUKAN KEUANGAN ---
    const ctxPembayaran = document.getElementById('chartPembayaran').getContext('2d');
    new Chart(ctxPembayaran, {
        type: 'line',
        data: {
            labels: @json($labelBulan),
            datasets: [{
                label: 'Uang Masuk',
                data: @json($dataPemasukan),
                borderColor: '#8b5cf6', // Purple-500
                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#8b5cf6',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    },
                    grid: { color: '#f1f5f9' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>
@endpush
@endsection