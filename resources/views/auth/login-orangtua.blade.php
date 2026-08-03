<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Orang Tua</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family:'Poppins',sans-serif;
        }

        body{
            background:linear-gradient(135deg,#ffd6ec,#d8e7ff);
        }
    </style>

</head>
<body>

<div class="min-h-screen flex justify-center items-center">

<div class="bg-white rounded-[35px] shadow-2xl overflow-hidden w-[1100px] flex">

    <!-- Kiri -->
    <div class="w-1/2 bg-gradient-to-br from-pink-500 to-purple-600 text-white p-12 flex flex-col justify-center">

        <h1 class="text-5xl font-bold mb-6">
            Selamat Datang 👋
        </h1>

        <p class="text-xl leading-9">
            Sistem Informasi Manajemen Ebony Preschool membantu orang tua memantau perkembangan anak, absensi harian, jadwal kegiatan, dan informasi sekolah dengan mudah.
        </p>

        <div class="text-center mt-12 text-8xl">
            👨‍👩‍👧
        </div>

    </div>

    <!-- Kanan -->
    <div class="w-1/2 p-12">

        <h2 class="text-4xl font-bold text-pink-600 text-center">
            Login Orang Tua
        </h2>

        <p class="text-center text-gray-500 mt-2 mb-10">
            Silakan masuk ke akun orang tua Anda
        </p>

        <form method="POST" action="/login-orangtua">

            @csrf

            <div class="mb-6">
                <label class="font-semibold">Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full mt-2 border rounded-xl p-4">
            </div>

            <div class="mb-6">

                <label class="font-semibold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full mt-2 border rounded-xl p-4">

            </div>

            <button
                class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white py-4 rounded-xl font-bold">
                LOGIN
            </button>

        </form>

        <div class="text-center mt-8">

            <p class="text-gray-500">
                Belum memiliki akun?
            </p>

            <a href="{{ route('register') }}"
               class="inline-block mt-4 border-2 border-pink-500 text-pink-500 px-8 py-3 rounded-xl hover:bg-pink-500 hover:text-white transition">

                Daftar Akun Orang Tua

            </a>

        </div>

    </div>

</div>

</div>

</body>
</html>