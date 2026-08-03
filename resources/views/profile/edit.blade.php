@extends(
    auth()->user()->role == 'admin' ? 'layouts.app' : (
    auth()->user()->role == 'yayasan' ? 'layouts.yayasan' : (
    auth()->user()->role == 'guru' ? 'layouts.guru' : 'layouts.orangtua'
    ))
)

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-3xl shadow-xl p-10">

        <div class="flex items-center gap-6 mb-10">

            {{-- FOTO PROFILE --}}
            <div class="w-28 h-28 rounded-full bg-pink-100 flex items-center justify-center text-5xl shadow-lg">

                👤

            </div>

            <div>

                <h1 class="text-4xl font-bold text-pink-600">
                    @if(auth()->user()->role == 'admin')
                        Profil Admin
                    @elseif(auth()->user()->role == 'yayasan')
                        Profil Kepala Yayasan
                    @elseif(auth()->user()->role == 'guru')
                        Profil Guru
                    @else
                        Profil Orang Tua
                    @endif
                </h1>

                <p class="text-gray-500 mt-2">
                    Kelola informasi akun Ebony Preschool
                </p>

            </div>

        </div>


        {{-- UPDATE PROFILE --}}
        <form method="post"
            action="{{ route('profile.update') }}"
            class="space-y-6">

            @csrf
            @method('patch')

            <div>

                <label class="block font-semibold mb-2">
                    Nama
                </label>

                <input type="text"
                    name="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    class="w-full border rounded-2xl px-5 py-3 focus:ring-2 focus:ring-pink-400">

            </div>

            <div>

                <label class="block font-semibold mb-2">
                    Email
                </label>

                <input type="email"
                    name="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    class="w-full border rounded-2xl px-5 py-3 focus:ring-2 focus:ring-pink-400">

            </div>

            <button type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-2xl shadow-lg transition">

                Simpan Perubahan

            </button>

        </form>


        {{-- GANTI PASSWORD --}}
        <div class="mt-14 border-t pt-10">

            <h2 class="text-2xl font-bold text-purple-600 mb-6">
                Ganti Password
            </h2>

            <form method="post"
                action="{{ route('password.update') }}"
                class="space-y-6">

                @csrf
                @method('put')

                <div>

                    <label class="block font-semibold mb-2">
                        Password Lama
                    </label>

                    <input type="password"
                        name="current_password"
                        class="w-full border rounded-2xl px-5 py-3">

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Password Baru
                    </label>

                    <input type="password"
                        name="password"
                        class="w-full border rounded-2xl px-5 py-3">

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Konfirmasi Password
                    </label>

                    <input type="password"
                        name="password_confirmation"
                        class="w-full border rounded-2xl px-5 py-3">

                </div>

                <button type="submit"
                    class="bg-purple-500 hover:bg-purple-600 text-white px-8 py-3 rounded-2xl shadow-lg transition">

                    Update Password

                </button>

            </form>

        </div>

    </div>

</div>

@endsection