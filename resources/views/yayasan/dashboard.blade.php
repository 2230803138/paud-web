@extends('layouts.yayasan')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-pink-500 via-fuchsia-500 to-purple-600 rounded-3xl p-8 shadow-xl shadow-pink-500/20 text-white relative overflow-hidden">
        <!-- Abstract decorative blob inside banner -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="space-y-2">
                <span class="bg-white/20 text-white font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wider">
                    Monitoring Portal
                </span>
                <h1 class="text-4xl font-extrabold tracking-tight">Dashboard Monitoring Yayasan</h1>
                <p class="text-pink-100 text-sm font-medium">
                    Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>. Berikut rangkuman perkembangan data Ebony Preschool hari ini.
                </p>
            </div>
            <a href="{{ route('yayasan.dashboard.pdf', request()->query()) }}" class="bg-white text-pink-600 font-bold px-6 py-3.5 rounded-xl shadow-lg hover:scale-105 transition duration-200 text-sm flex items-center gap-2">
                🖨️ Cetak Laporan Menyeluruh
            </a>
        </div>
    </div>

    <!-- Statistik Ringkasan dengan Glowing Colored Shadows -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Total Guru -->
        <div class="bg-white rounded-3xl shadow-xl shadow-pink-100/50 border border-pink-50/50 p-6 flex items-center gap-4 hover:scale-[1.02] transition duration-200">
            <div class="w-14 h-14 bg-pink-50 rounded-2xl flex items-center justify-center text-3xl shadow-sm shadow-pink-100">
                👩‍🏫
            </div>
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Guru</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalGuru }}</h3>
            </div>
        </div>

        <!-- Total Siswa -->
        <div class="bg-white rounded-3xl shadow-xl shadow-purple-100/50 border border-purple-50/50 p-6 flex items-center gap-4 hover:scale-[1.02] transition duration-200">
            <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-3xl shadow-sm shadow-purple-100">
                👶
            </div>
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Siswa</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalSiswa }}</h3>
            </div>
        </div>

        <!-- Pendapatan SPP Lunas -->
        <div class="bg-white rounded-3xl shadow-xl shadow-green-100/50 border border-green-50/50 p-6 flex items-center gap-4 hover:scale-[1.02] transition duration-200">
            <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-3xl shadow-sm shadow-green-100">
                💰
            </div>
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">SPP Lunas</p>
                <h3 class="text-xl font-extrabold text-gray-800 mt-1">Rp {{ number_format($totalPembayaranLunas, 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Total Pendaftaran -->
        <div class="bg-white rounded-3xl shadow-xl shadow-yellow-100/50 border border-yellow-50/50 p-6 flex items-center gap-4 hover:scale-[1.02] transition duration-200">
            <div class="w-14 h-14 bg-yellow-50 rounded-2xl flex items-center justify-center text-3xl shadow-sm shadow-yellow-100">
                📝
            </div>
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Pendaftar Baru</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalPendaftaran }}</h3>
            </div>
        </div>

    </div>

    <!-- Grafik Visualisasi (Chart.js) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Grafik Pemasukan SPP (Line Chart styled like Admin) -->
        <div class="bg-white rounded-3xl shadow-xl shadow-purple-100/40 border border-purple-50/50 p-6 lg:col-span-2">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-850">Grafik Pemasukan Keuangan SPP</h3>
                    <p class="text-xs text-gray-400 mt-1">Tren penerimaan SPP lunas</p>
                </div>
                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">Tahun {{ $currentYear }}</span>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="chartPembayaran"></canvas>
            </div>
        </div>

        <!-- Grafik Absensi Siswa (Doughnut Chart) -->
        <div class="bg-white rounded-3xl shadow-xl shadow-pink-100/40 border border-pink-50/50 p-6 lg:col-span-1">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-850">Kehadiran Siswa</h3>
                    <p class="text-xs text-gray-400 mt-1">Status hari ini</p>
                </div>
                <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-xs font-bold">Hari Ini</span>
            </div>
            <div class="relative flex justify-center items-center" style="height: 300px;">
                <canvas id="chartAbsensiSiswa"></canvas>
            </div>
        </div>

    </div>

    <!-- Grafik dan Log -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Distribusi Kelas -->
        <div class="bg-white rounded-3xl shadow-xl shadow-pink-100/40 border border-pink-50/50 p-6 lg:col-span-1">
            <h3 class="text-lg font-bold text-gray-850 mb-6">Distribusi Kelas Siswa</h3>
            
            <div class="space-y-5">
                @foreach($kelasStats as $namaKelas => $jumlah)
                    @php
                        $percentage = $totalSiswa > 0 ? ($jumlah / $totalSiswa) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-500 mb-1.5 uppercase tracking-wider">
                            <span>{{ $namaKelas }}</span>
                            <span>{{ $jumlah }} Siswa ({{ round($percentage) }}%)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-gradient-to-r from-pink-500 to-purple-500 h-3 rounded-full shadow-sm" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pendaftaran Terbaru -->
        <div class="bg-white rounded-3xl shadow-xl shadow-purple-100/40 border border-purple-50/50 p-6 lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-850 mb-6">Pendaftaran Siswa Terbaru</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-pink-50 text-pink-700 font-semibold text-sm">
                            <th class="p-4 rounded-l-xl">Nama Anak</th>
                            <th class="p-4">Orang Tua</th>
                            <th class="p-4">Tanggal Daftar</th>
                            <th class="p-4 rounded-r-xl">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPendaftaran as $p)
                            <tr class="hover:bg-pink-50/30 transition">
                                <td class="p-4 font-bold text-gray-700">{{ $p->nama_anak }}</td>
                                <td class="p-4 text-gray-600 font-medium">{{ $p->nama_ortu }}</td>
                                <td class="p-4 text-gray-500">{{ $p->created_at->translatedFormat('d F Y') }}</td>
                                <td class="p-4">
                                    <span class="px-3.5 py-1.5 rounded-full font-bold text-xs shadow-sm
                                        {{ $p->status == 'diterima' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $p->status == 'menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $p->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}
                                    ">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-400">Belum ada pendaftaran baru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<!-- Chart initialization using Chart.js -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. GRAFIK PEMASUKAN KEUANGAN SPP ---
        var sppMonthlyOrdered = @json($sppMonthlyOrdered);
        var sppDataValues = Object.values(sppMonthlyOrdered);
        var sppDataKeys = Object.keys(sppMonthlyOrdered);

        const ctxPembayaran = document.getElementById('chartPembayaran').getContext('2d');
        new Chart(ctxPembayaran, {
            type: 'line',
            data: {
                labels: sppDataKeys,
                datasets: [{
                    label: 'Uang Masuk',
                    data: sppDataValues,
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

        // --- 2. GRAFIK KEHADIRAN SISWA (Doughnut Chart) ---
        var attendanceStats = @json($studentAttendanceData);
        var attendanceValues = Object.values(attendanceStats);
        var attendanceLabels = Object.keys(attendanceStats).map(function(word) {
            return word.charAt(0).toUpperCase() + word.slice(1);
        });

        // Ensure we only render the chart if there is data
        var hasAttendance = attendanceValues.reduce((a, b) => a + b, 0) > 0;

        if (hasAttendance) {
            const ctxAbsensi = document.getElementById('chartAbsensiSiswa').getContext('2d');
            new Chart(ctxAbsensi, {
                type: 'doughnut',
                data: {
                    labels: attendanceLabels,
                    datasets: [{
                        data: attendanceValues,
                        backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#ef4444'], // Hadir, Izin, Sakit, Alfa
                        borderWidth: 2,
                        borderColor: '#ffffff',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    family: 'Poppins',
                                    weight: 600,
                                    size: 11
                                }
                            }
                        }
                    },
                    cutout: '70%' // Thin elegant doughnut cutout
                }
            });
        } else {
            document.getElementById('chartAbsensiSiswa').parentElement.innerHTML = 
                '<div class="flex flex-col items-center justify-center py-16 text-gray-400 text-sm">📭 Belum ada data absensi siswa hari ini.</div>';
        }
    });
</script>
@endsection
