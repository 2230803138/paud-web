@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow-xl p-8">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold text-pink-600">
            Laporan Anak
        </h1>

        <a href="/laporan/create"
            class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-3 rounded-xl">

            + Tambah Laporan
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-150 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm font-bold shadow-sm">
            🎉 {{ session('success') }}
        </div>
    @endif

    <table class="w-full border">

        <thead class="bg-pink-500 text-white">

            <tr>
                <th class="p-3 border">Nama Anak</th>
                <th class="p-3 border">Tanggal</th>
                <th class="p-3 border">Perkembangan</th>
                <th class="p-3 border">Catatan</th>
                <th class="p-3 border">Aksi</th>
            </tr>

        </thead>

        <tbody>

            @foreach($laporan as $item)

            <tr>

                <td class="border p-3">
                    {{ $item->siswa?->nama ?? 'Siswa Tidak Ditemukan' }}
                </td>

                <td class="border p-3">
                    {{ $item->tanggal }}
                </td>

                <td class="border p-3">
                    {{ $item->perkembangan }}
                </td>

                <td class="border p-3">
                    {{ $item->catatan }}
                </td>

                <td class="border p-3">
                    <div class="flex gap-2">
                        <a href="{{ route('laporan.edit', $item->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                            Edit
                        </a>
                        <form action="{{ route('laporan.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan perkembangan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection