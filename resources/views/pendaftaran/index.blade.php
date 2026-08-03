@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">
                Verifikasi Pendaftaran
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola data calon peserta didik Ebony Preschool.
            </p>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-4 gap-6">

        <div class="bg-blue-500 rounded-3xl p-6 text-white shadow-lg">

            <h2 class="text-lg font-semibold">
                Total Pendaftar
            </h2>

            <h1 class="text-5xl font-bold mt-3">
                {{ $data->count() }}
            </h1>

        </div>

        <div class="bg-yellow-500 rounded-3xl p-6 text-white shadow-lg">

            <h2 class="text-lg font-semibold">
                Menunggu
            </h2>

            <h1 class="text-5xl font-bold mt-3">
                {{ $data->where('status','menunggu')->count() }}
            </h1>

        </div>

        <div class="bg-green-500 rounded-3xl p-6 text-white shadow-lg">

            <h2 class="text-lg font-semibold">
                Diterima
            </h2>

            <h1 class="text-5xl font-bold mt-3">
                {{ $data->where('status','diterima')->count() }}
            </h1>

        </div>

        <div class="bg-red-500 rounded-3xl p-6 text-white shadow-lg">

            <h2 class="text-lg font-semibold">
                Ditolak
            </h2>

            <h1 class="text-5xl font-bold mt-3">
                {{ $data->where('status','ditolak')->count() }}
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

            Data Pendaftaran

        </h2>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-purple-100">

                        <th class="p-4">No</th>
                        <th>Nama Anak</th>
                        <th>Orang Tua</th>
                        <th>No HP</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>
                    @forelse($data as $item)

<tr class="border-b hover:bg-gray-50">

    <td class="p-4 text-center">
        {{ $loop->iteration }}
    </td>

    <td class="p-4">
        <div class="font-semibold">
            {{ $item->nama_anak }}
        </div>

        <div class="text-sm text-gray-500">
            {{ \Carbon\Carbon::parse($item->tgl_lahir)->format('d-m-Y') }}
        </div>
    </td>

    <td class="p-4">
        {{ $item->nama_ortu }}
    </td>

    <td class="p-4">
        {{ $item->no_hp }}
    </td>

    <td class="p-4 text-center">

        @if($item->kelas)

            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                {{ $item->kelas }}
            </span>

        @else

            <span class="text-gray-400 italic">
                Belum Dipilih
            </span>

        @endif

    </td>

    <td class="p-4 text-center">

        @if($item->status=='menunggu')

            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                Menunggu
            </span>

        @elseif($item->status=='diterima')

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                Diterima
            </span>

        @else

            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                Ditolak
            </span>

        @endif

    </td>

    <td class="p-4">

        <form action="{{ route('pendaftaran.status', $item->id) }}"
              method="POST"
              class="space-y-2">

            @csrf
            @method('PUT')

            <select
                name="status"
                class="status-select w-full border rounded-lg px-3 py-2">

                <option value="menunggu" {{ $item->status=='menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diterima" {{ $item->status=='diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $item->status=='ditolak' ? 'selected' : '' }}>Ditolak</option>

            </select>

            <div class="kelas-wrapper {{ $item->status=='diterima' ? '' : 'hidden' }}">

                <select
                    name="kelas"
                    class="w-full border rounded-lg px-3 py-2">

                    <option value="">-- Pilih Kelas --</option>
                    <option value="Baby Class" {{ $item->kelas=='Baby Class' ? 'selected' : '' }}>Baby Class</option>
                    <option value="Toddler" {{ $item->kelas=='Toddler' ? 'selected' : '' }}>Toddler</option>
                    <option value="Nursery" {{ $item->kelas=='Nursery' ? 'selected' : '' }}>Nursery</option>

                </select>

            </div>

            <button
                type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2 rounded-lg font-semibold transition">
                Simpan
            </button>

        </form>

        <form action="{{ route('pendaftaran.destroy', $item->id) }}"
              method="POST"
              class="mt-2"
              onsubmit="return confirm('Yakin ingin menghapus data pendaftaran ini?')">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg font-semibold transition">
                Hapus
            </button>

        </form>

    </td>

</tr>

@empty

<tr>

    <td colspan="7" class="text-center py-10 text-gray-500">

        Belum ada data pendaftaran.

    </td>

</tr>

@endforelse
                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.status-select').forEach(function(select){

        function toggleKelas(){

            const wrapper = select.closest('form').querySelector('.kelas-wrapper');

            if(select.value === 'diterima'){
                wrapper.classList.remove('hidden');
            }else{
                wrapper.classList.add('hidden');
            }

        }

        toggleKelas();

        select.addEventListener('change', toggleKelas);

    });

});

</script>

@endsection