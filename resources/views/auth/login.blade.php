<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PAUD</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-200 via-purple-200 to-blue-200">

    <div class="bg-white/80 backdrop-blur-lg shadow-2xl rounded-3xl overflow-hidden flex w-[900px]">

        {{-- Kiri --}}
        <div class="w-1/2 bg-gradient-to-br from-pink-500 to-purple-500 text-white p-10 flex flex-col justify-center">

            <h1 class="text-4xl font-bold mb-4">
                Selamat Datang 👋
            </h1>

            <p class="text-lg leading-relaxed">
                Sistem Informasi Manajemen PAUD untuk membantu pengelolaan data siswa,
                guru, absensi, dan pendaftaran secara modern dan efisien.
            </p>

            <div class="mt-8">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png"
                    class="w-40 mx-auto">
            </div>
        </div>

        {{-- Kanan --}}
        <div class="w-1/2 p-10">

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-pink-600">
                    Login Admin
                </h2>

                <p class="text-gray-500 mt-2">
                    Silakan masuk ke akun anda
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block mb-2 text-gray-700 font-semibold">
                        Email
                    </label>

                    <input type="email"
                        name="email"
                        required
                        autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-4 focus:ring-pink-300 outline-none"
                        placeholder="Masukkan email">
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <label class="block mb-2 text-gray-700 font-semibold">
                        Password
                    </label>

                    <input type="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-4 focus:ring-pink-300 outline-none"
                        placeholder="Masukkan password">
                </div>

                {{-- Remember --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-pink-500 hover:underline">
                            Lupa password?
                        </a>
                    @endif
                </div>

                {{-- Button --}}
                <button type="submit"
                    class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:scale-105 transition text-white py-3 rounded-xl font-bold shadow-lg">
                    LOGIN
                </button>
                {{-- Register --}}
<div class="text-center mt-6">

    <p class="text-gray-500">
        Belum punya akun?
    </p>

    <a href="{{ route('register') }}"
        class="inline-block mt-2 bg-white border-2 border-pink-500 text-pink-500 hover:bg-pink-500 hover:text-white transition px-6 py-2 rounded-xl font-semibold shadow">

        Register Admin Baru

    </a>

</div>
            </form>

        </div>
    </div>

</body>
</html>