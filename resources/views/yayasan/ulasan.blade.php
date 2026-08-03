@extends('layouts.yayasan')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white">
        <h1 class="text-4xl font-bold">Laporan Ulasan Guru</h1>
        <p class="mt-3 text-pink-100">Daftar ulasan, saran, dan masukan dari Orang Tua murid terhadap kinerja Guru di setiap Cabang Ebony Preschool.</p>
    </div>

    <!-- Tabel Rekap Ulasan -->
    <div class="bg-white rounded-3xl shadow-lg p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Ulasan Orang Tua
                @if(request('cabang_id'))
                    @php
                        $selectedCabang = \App\Models\Cabang::find(request('cabang_id'));
                    @endphp
                    <span class="ml-2 bg-pink-100 text-pink-700 font-bold px-3 py-1 rounded-full text-xs">
                        📍 {{ $selectedCabang->nama_cabang ?? '-' }}
                    </span>
                @else
                    <span class="ml-2 bg-purple-100 text-purple-700 font-bold px-3 py-1 rounded-full text-xs">
                        🌍 Semua Cabang
                    </span>
                @endif
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-pink-50 text-pink-700 font-semibold text-sm">
                        <th class="p-4 rounded-l-xl">No</th>
                        <th class="p-4">Orang Tua Pengirim</th>
                        <th class="p-4">Cabang Sekolah</th>
                        <th class="p-4">Nama Guru</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4 rounded-r-xl">Catatan Ulasan / Masukan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($ulasans as $index => $item)
                        <tr class="hover:bg-pink-50/50 transition">
                            <td class="p-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 font-bold text-gray-800">
                                {{ $item->user?->name ?? 'Orang Tua' }}
                                <div class="text-xs text-gray-400 font-normal">
                                    {{ $item->user?->email }}
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="bg-indigo-50 text-indigo-700 font-bold px-2.5 py-1 rounded-lg text-xs">
                                    {{ $item->cabang?->nama_cabang ?? 'Cabang Pusat' }}
                                </span>
                            </td>
                            <td class="p-4 font-semibold text-gray-700">
                                {{ $item->guru?->nama ?? 'Guru Tidak Ditemukan' }}
                                <div class="text-xs text-gray-400 font-normal">
                                    {{ $item->guru?->jabatan }}
                                </div>
                            </td>
                            <td class="p-4 text-gray-550 text-sm whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="p-4 text-gray-600 text-sm font-medium leading-relaxed max-w-md">
                                "{{ $item->ulasan }}"
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-450 font-medium">
                                📭 Belum ada ulasan guru yang dikirimkan oleh orang tua untuk cabang ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
