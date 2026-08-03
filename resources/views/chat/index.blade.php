@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8">

    <h1 class="text-3xl font-bold text-pink-600 mb-6">
        Chat Orang Tua & Guru
    </h1>

    {{-- FORM CHAT --}}
    <form action="{{ route('chat.store') }}" method="POST">

        @csrf

        <div class="mb-4">

            <input type="text"
                   name="nama_pengirim"
                   placeholder="Nama Pengirim"
                   class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-4">

            <select name="role"
                    class="w-full border rounded-lg px-4 py-2">

                <option value="Orang Tua">Orang Tua</option>
                <option value="Guru">Guru</option>

            </select>

        </div>

        <div class="mb-4">

            <textarea name="pesan"
                placeholder="Tulis pesan..."
                class="w-full border rounded-lg px-4 py-2"></textarea>

        </div>

        <button type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg">

            Kirim Pesan

        </button>

    </form>

    {{-- LIST CHAT --}}
    <div class="mt-10 space-y-4">

        @foreach($chat as $item)

        <div class="bg-gray-100 p-4 rounded-xl">

            <div class="flex justify-between">

                <h2 class="font-bold text-pink-600">
                    {{ $item->nama_pengirim }}
                </h2>

                <span class="text-sm text-gray-500">
                    {{ $item->role }}
                </span>

            </div>

            <p class="mt-2 text-gray-700">
                {{ $item->pesan }}
            </p>

        </div>

        @endforeach

    </div>

</div>

@endsection