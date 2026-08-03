@extends('layouts.orangtua')

@section('title','Dashboard Orang Tua')

@section('content')

@if(!$siswa)

<div class="bg-red-100 text-red-700 p-6 rounded-2xl">

    <h2 class="text-2xl font-bold mb-2">
        Akun belum terhubung
    </h2>

    <p>
        Akun orang tua ini belum dikaitkan dengan data peserta didik.
        Silakan hubungi admin sekolah.
    </p>

</div>

@else

<div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-3xl p-8 text-white shadow-lg">

    <h1 class="text-4xl font-bold">
        Selamat Datang 👋
    </h1>

    <p class="text-xl mt-2">
        {{ Auth::user()->name }}
    </p>

    <p class="mt-3 text-pink-100">
        Pantau perkembangan putra/putri Anda melalui sistem Ebony Preschool.
    </p>

</div>

@if($belumLunasCount > 0)
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-6 rounded-3xl mt-6 shadow-md flex justify-between items-center flex-wrap gap-4">
        <div>
            <h3 class="font-bold text-lg flex items-center gap-2">⚠️ Tagihan Pembayaran SPP Belum Lunas</h3>
            <p class="text-sm mt-1 text-red-600 font-medium">
                Putra/putri Anda <strong>{{ $siswa->nama }}</strong> memiliki {{ $belumLunasCount }} tagihan SPP yang belum diselesaikan:
                <span class="font-bold text-red-800">
                    @foreach($belumLunasItems as $tagihan)
                        {{ $tagihan->bulan }} {{ $tagihan->tahun }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </span>.
            </p>
        </div>
        <a href="{{ route('orangtua.pembayaran') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition">
            Detail Tagihan ➔
        </a>
    </div>
@endif


<div class="grid md:grid-cols-2 gap-6 mt-8">

    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-pink-600 mb-4">
            Data Anak
        </h2>

        <table class="w-full">

            <tr>
                <td class="py-2 font-semibold">
                    Nama Anak
                </td>

                <td>
                    {{ $siswa->nama }}
                </td>
            </tr>

            <tr>
                <td class="py-2 font-semibold">
                    Kelas
                </td>

                <td>
                    {{ $siswa->kelas }}
                </td>
            </tr>

            <tr>
                <td class="py-2 font-semibold">
                    Cabang Sekolah
                </td>

                <td>
                    <span class="bg-purple-100 text-purple-700 font-bold px-2.5 py-1 rounded-lg text-xs">
                        {{ $siswa->cabang?->nama_cabang ?? 'Cabang Pusat' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td class="py-2 font-semibold">
                    Orang Tua
                </td>

                <td>
                    {{ Auth::user()->name }}
                </td>
            </tr>

            <tr>
                <td class="py-2 font-semibold">
                    Pembayaran Terakhir
                </td>

                <td>
                    @if($lastPaymentDate)
                        <span class="bg-green-100 text-green-700 font-bold px-2.5 py-1 rounded-lg text-xs">
                            {{ \Carbon\Carbon::parse($lastPaymentDate)->translatedFormat('d F Y') }}
                        </span>
                    @else
                        <span class="text-gray-400 italic text-xs">Belum ada pembayaran</span>
                    @endif
                </td>
            </tr>

        </table>

    </div>


    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-pink-600 mb-4">

            Ringkasan Absensi

        </h2>

        <div class="grid grid-cols-2 gap-4">

            <div class="bg-green-100 rounded-xl p-4 text-center">

                <h3 class="text-3xl font-bold text-green-700">
                    {{ $hadir }}
                </h3>

                <p>Hadir</p>

            </div>

            <div class="bg-yellow-100 rounded-xl p-4 text-center">

                <h3 class="text-3xl font-bold text-yellow-700">
                    {{ $izin }}
                </h3>

                <p>Izin</p>

            </div>

            <div class="bg-blue-100 rounded-xl p-4 text-center">

                <h3 class="text-3xl font-bold text-blue-700">
                    {{ $sakit }}
                </h3>

                <p>Sakit</p>

            </div>

            <div class="bg-red-100 rounded-xl p-4 text-center">

                <h3 class="text-3xl font-bold text-red-700">
                    {{ $alfa }}
                </h3>

                <p>Alfa</p>

            </div>

        </div>

    </div>

</div>

<!-- Grafik Perkembangan (Toddler & Nursery) / Galeri Foto (Baby Class) -->
<div class="mt-8 bg-white rounded-3xl shadow-lg p-6">
    @if($siswa->kelas === 'Toddler' || $siswa->kelas === 'Nursery')
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-pink-600 flex items-center gap-2">
                📈 Grafik Perkembangan Anak
            </h2>
            <span class="bg-pink-100 text-pink-700 font-bold px-3 py-1 rounded-xl text-xs">
                Kelas: {{ $siswa->kelas }}
            </span>
        </div>
        
        @if($laporanPerkembangan->count() > 0)
            <div class="h-96 relative">
                <canvas id="perkembanganChart"></canvas>
            </div>
        @else
            <div class="py-12 text-center text-gray-400">
                📈 Belum ada data penilaian perkembangan yang diinput oleh guru.
            </div>
        @endif
        
    @elseif($siswa->kelas === 'Baby Class')
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-purple-600 flex items-center gap-2">
                📷 Foto Kegiatan Harian Anak
            </h2>
            <span class="bg-purple-100 text-purple-700 font-bold px-3 py-1 rounded-xl text-xs">
                Kelas: {{ $siswa->kelas }}
            </span>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @forelse($fotoKegiatan as $item)
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition border border-gray-100 bg-white">
                    <a href="{{ asset($item->foto) }}" target="_blank">
                        <img src="{{ asset($item->foto) }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/75 to-transparent p-4 text-white">
                            <p class="text-xs font-bold">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                            @if($item->catatan)
                                <p class="text-[10px] text-gray-200 truncate mt-1">{{ $item->catatan }}</p>
                            @endif
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-400">
                    📷 Belum ada foto kegiatan anak yang diunggah oleh guru.
                </div>
            @endforelse
        </div>
    @endif
</div>

@if(($siswa->kelas === 'Toddler' || $siswa->kelas === 'Nursery') && $laporanPerkembangan->count() > 0)
    <script src="{{ asset('js/chart.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('perkembanganChart').getContext('2d');
            
            const rawData = @json($laporanPerkembangan);
            
            const filteredData = rawData.filter(item => 
                (item.kognitif !== null && item.kognitif !== '') || 
                (item.motorik !== null && item.motorik !== '') || 
                (item.bahasa !== null && item.bahasa !== '') || 
                (item.sosial_emosional !== null && item.sosial_emosional !== '') || 
                (item.agama_moral !== null && item.agama_moral !== '')
            );
            
            if (filteredData.length === 0) {
                const parent = document.getElementById('perkembanganChart').parentNode;
                parent.innerHTML = '<div class="py-12 text-center text-gray-400">📈 Belum ada data kriteria nilai perkembangan yang diinput oleh guru.</div>';
                return;
            }
            
            const labels = filteredData.map(item => {
                const date = new Date(item.tanggal);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
            });
            
            const aspects = {
                kognitif: { label: 'Kognitif', color: '#db2777' },
                motorik: { label: 'Motorik', color: '#2563eb' },
                bahasa: { label: 'Bahasa', color: '#16a34a' },
                sosial_emosional: { label: 'Sosial Emosional', color: '#7c3aed' },
                agama_moral: { label: 'Agama & Moral', color: '#ea580c' }
            };
            
            const datasets = Object.keys(aspects).map(key => {
                return {
                    label: aspects[key].label,
                    data: filteredData.map(item => item[key] !== null && item[key] !== '' ? parseInt(item[key]) : null),
                    borderColor: aspects[key].color,
                    backgroundColor: aspects[key].color + 'c0',
                    borderWidth: 1,
                    borderRadius: 6
                };
            });
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            min: 0,
                            max: 100,
                            ticks: {
                                stepSize: 20,
                                callback: function(value) {
                                    return value;
                                }
                             }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    size: 11,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const val = context.parsed.y;
                                    if (val === null || val === undefined) return context.dataset.label + ': Belum dinilai';
                                    let cat = 'Kurang 🔴';
                                    if (val >= 90) cat = 'Sangat Baik 🟢';
                                    else if (val >= 75) cat = 'Baik 🔵';
                                    else if (val >= 60) cat = 'Cukup 🟡';
                                    return context.dataset.label + ': ' + val + ' (' + cat + ')';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endif

<div class="grid md:grid-cols-4 gap-6 mt-8">

    <a href="{{ route('orangtua.absensi') }}"
       class="bg-pink-500 rounded-2xl p-6 text-white shadow-lg hover:scale-105 transition">

        <div class="text-5xl">
            📍
        </div>

        <h2 class="text-2xl font-bold mt-4">
            Absensi Anak
        </h2>

        <p class="mt-2 text-pink-100">
            Lihat riwayat kehadiran anak.
        </p>

    </a>


    <a href="{{ url('/jadwal-orangtua') }}"
       class="bg-blue-500 rounded-2xl p-6 text-white shadow-lg hover:scale-105 transition">

        <div class="text-5xl">
            📅
        </div>

        <h2 class="text-2xl font-bold mt-4">
            Jadwal
        </h2>

        <p class="mt-2 text-blue-100">
            Jadwal kegiatan sesuai kelas anak.
        </p>

    </a>


    <a href="{{ url('/laporan-anak') }}"
       class="bg-purple-500 rounded-2xl p-6 text-white shadow-lg hover:scale-105 transition">

        <div class="text-5xl">
            📖
        </div>

        <h2 class="text-2xl font-bold mt-4">
            Laporan
        </h2>

        <p class="mt-2 text-purple-100">
            Perkembangan belajar anak.
        </p>

    </a>

    <a href="{{ route('orangtua.pembayaran') }}"
       class="bg-green-500 rounded-2xl p-6 text-white shadow-lg hover:scale-105 transition">

        <div class="text-5xl">
            💳
        </div>

        <h2 class="text-2xl font-bold mt-4">
            Pembayaran SPP
        </h2>

        <p class="mt-2 text-green-100">
            Riwayat dan tagihan SPP anak.
        </p>

    </a>

</div>

@endif

@endsection