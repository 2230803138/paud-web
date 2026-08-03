<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Orang Tua</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>
</head>

<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 min-h-screen flex items-center justify-center">

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-5xl w-full grid md:grid-cols-2">

    <!-- KIRI -->
    <div class="bg-gradient-to-br from-pink-500 to-purple-600 text-white p-10 flex flex-col justify-center">

        <h1 class="text-5xl font-bold mb-6">
            Orang Tua 👨‍👩‍👧
        </h1>

        <p class="text-xl leading-relaxed">
            Silakan membuat akun sebagai Orang Tua untuk memantau perkembangan anak di Ebony Preschool.
        </p>

        <div class="text-center mt-12 text-8xl">
            🏫
        </div>

    </div>

    <!-- KANAN -->
    <div class="p-10">

        <h2 class="text-4xl font-bold text-pink-600">
            Register
        </h2>

        <p class="text-gray-500 mt-2 mb-8">
            Buat akun Orang Tua
        </p>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-5">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('orangtua.register.store') }}">

            @csrf

            <div class="mb-5">
                <label class="font-semibold block mb-2">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ request('name', old('name')) }}"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400">
            </div>

            <div class="mb-5">
                <label class="font-semibold block mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400">
            </div>

            <div class="mt-4">
                <label class="block font-semibold mb-2">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ request('no_hp', old('no_hp')) }}"
                    class="w-full border rounded-xl px-4 py-3"
                    required>
            </div>
            
            <div class="mb-5">
                <label class="font-semibold block mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400">
            </div>

            <div class="mb-8">
                <label class="font-semibold block mb-2">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400">
            </div>

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:opacity-90 text-white py-3 rounded-xl font-bold text-lg">

                REGISTER ORANG TUA

            </button>

        </form>

        <div class="text-center mt-6">

            <a href="{{ route('orangtua.login') }}"
               class="text-pink-600 hover:underline">

                Sudah punya akun? Login Orang Tua

            </a>

        </div>

    </div>

</div>

</body>
</html>