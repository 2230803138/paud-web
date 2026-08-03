<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>
</head>

<body class="bg-gradient-to-r from-pink-200 via-purple-200 to-blue-200 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-3xl overflow-hidden flex w-[950px]">

        {{-- KIRI --}}
        <div class="w-1/2 bg-gradient-to-br from-pink-500 to-purple-500 text-white p-10">

            <h1 class="text-5xl font-bold mb-6">
                Admin Baru 👩‍💻
            </h1>

            <p class="text-lg leading-9">
                Tambahkan akun admin baru untuk mengelola sistem informasi PAUD.
            </p>

            <div class="mt-12 text-center text-9xl">
                🏫
            </div>

        </div>

        {{-- KANAN --}}
        <div class="w-1/2 p-10">

            <h2 class="text-4xl font-bold text-pink-500 mb-2">
                Register
            </h2>

            <p class="text-gray-500 mb-8">
                Buat akun admin baru
            </p>

            <form method="POST" action="{{ route('register') }}">

                @csrf

                {{-- NAMA --}}
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Nama
                    </label>

                    <input type="text"
                        name="name"
                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        placeholder="Masukkan nama">

                </div>

                {{-- EMAIL --}}
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Email
                    </label>

                    <input type="email"
                        name="email"
                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        placeholder="Masukkan email">

                </div>

                {{-- PASSWORD --}}
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Password
                    </label>

                    <input type="password"
                        name="password"
                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        placeholder="Masukkan password">

                </div>

                {{-- KONFIRMASI --}}
                <div class="mb-7">

                    <label class="block font-semibold mb-2">
                        Konfirmasi Password
                    </label>

                    <input type="password"
                        name="password_confirmation"
                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        placeholder="Konfirmasi password">

                </div>

                {{-- BUTTON --}}
                <button
                    class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:scale-105 transition text-white font-bold py-4 rounded-xl shadow-xl">

                    REGISTER

                </button>

            </form>

        </div>

    </div>

</body>
</html>