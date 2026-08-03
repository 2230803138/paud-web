<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Yayasan - Ebony Preschool</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-200 via-purple-200 to-blue-200">

    <div class="bg-white/80 backdrop-blur-lg shadow-2xl rounded-3xl overflow-hidden flex w-[900px]">

        {{-- Kiri --}}
        <div class="w-1/2 bg-gradient-to-br from-pink-500 to-purple-500 text-white p-10 flex flex-col justify-center">

            <h1 class="text-4xl font-bold mb-4">
                Yayasan Ebony 👋
            </h1>

            <p class="text-lg leading-relaxed">
                Akses panel pemantauan dan laporan Kepala Yayasan untuk monitoring operasional, kepegawaian, kesiswaan, keuangan SPP, dan pendaftaran baru.
            </p>

            <div class="mt-8">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                    class="w-40 mx-auto">
            </div>
        </div>

        {{-- Kanan --}}
        <div class="w-1/2 p-10">

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-pink-600">
                    Login Yayasan
                </h2>

                <p class="text-gray-500 mt-2">
                    Silakan masuk ke panel yayasan
                </p>
            </div>

           <form method="POST" action="{{ route('yayasan.login.store') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block mb-2 text-gray-700 font-semibold">
                        Email Yayasan
                    </label>

                    <input type="email"
                        name="email"
                        required
                        autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-4 focus:ring-pink-300 outline-none"
                        placeholder="yayasan@gmail.com">
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
                        placeholder="••••••••">
                </div>

                {{-- Remember --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                </div>

                {{-- Button --}}
                <button type="submit"
                    class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:scale-105 transition text-white py-3 rounded-xl font-bold shadow-lg">
                    MASUK PANEL YAYASAN
                </button>
            </form>

        </div>
    </div>

</body>
</html>
