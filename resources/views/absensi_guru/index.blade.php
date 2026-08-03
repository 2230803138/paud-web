@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">
                Absensi Guru
            </h1>

            <p class="text-gray-500 mt-2">
                Rekap kehadiran seluruh guru.
            </p>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-4 gap-6">

        <div class="bg-blue-500 rounded-3xl p-6 text-white shadow-lg">

            <h2 class="text-lg font-semibold">
                Total Absensi
            </h2>

            <h1 class="text-5xl font-bold mt-3">

                {{ $data->count() }}

            </h1>

        </div>

        <div class="bg-green-500 rounded-3xl p-6 text-white shadow-lg">

            <h2 class="text-lg font-semibold">
                Hadir
            </h2>

            <h1 class="text-5xl font-bold mt-3">

                {{ $data->where('status','Hadir')->count() }}

            </h1>

        </div>

        <div class="bg-yellow-500 rounded-3xl p-6 text-white shadow-lg">

            <h2 class="text-lg font-semibold">
                Izin
            </h2>

            <h1 class="text-5xl font-bold mt-3">

                {{ $data->where('status','Izin')->count() }}

            </h1>

        </div>

        <div class="bg-red-500 rounded-3xl p-6 text-white shadow-lg">

            <h2 class="text-lg font-semibold">
                Sakit / Alfa
            </h2>

            <h1 class="text-5xl font-bold mt-3">

                {{ $data->whereIn('status',['Sakit','Alfa'])->count() }}

            </h1>

        </div>

    </div>

    {{-- Pesan --}}
    @if(session('success'))

        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl">

            {{ session('error') }}

        </div>

    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-3xl shadow-lg p-6">

        <h2 class="text-2xl font-bold mb-6">

            Data Absensi Guru

        </h2>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-purple-100">

                        <th class="p-4">No</th>
                        <th>Nama Guru</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th>Keterangan</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($data as $item)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4 text-center">

                            {{ $loop->iteration }}

                        </td>

                        <td class="p-4">

                            {{ $item->guru->nama }}

                        </td>

                        <td class="p-4">

                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}

                        </td>

                        <td class="p-4">

                            {{ $item->jam_masuk ?? '-' }}

                        </td>

                        <td class="p-4">

                            {{ $item->jam_pulang ?? '-' }}

                        </td>

                        <td class="p-4">

                            @if($item->status=='Hadir')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                    Hadir

                                </span>

                            @elseif($item->status=='Izin')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                                    Izin

                                </span>

                            @elseif($item->status=='Sakit')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">

                                    Sakit

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                                    Alfa

                                </span>

                            @endif

                        </td>

                        <td class="p-4">

                            {{ $item->keterangan ?? '-' }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center py-10 text-gray-500">

                            Belum ada data absensi guru.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection