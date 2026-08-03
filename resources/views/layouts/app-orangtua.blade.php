<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family:'Poppins',sans-serif;
        }
    </style>

</head>

<body class="bg-pink-100">

    <!-- Navbar -->
    <nav class="bg-white shadow p-5">

        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <h1 class="text-2xl font-bold text-pink-600">
                Ebony Preschool
            </h1>

            <div class="flex items-center gap-4">

                <span class="font-semibold">
                    {{ Auth::user()->name }}
                </span>

                <a href="{{ route('profile.edit') }}"
                   class="bg-pink-500 text-white px-4 py-2 rounded-lg">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </nav>

    <!-- Menu -->
    <div class="max-w-7xl mx-auto mt-8">

        <div class="flex gap-4 mb-8">

            <a href="{{ route('dashboard.orangtua') }}"
               class="bg-pink-500 text-white px-5 py-3 rounded-xl">
                Dashboard
            </a>

            <a href="/absensi-anak"
               class="bg-blue-500 text-white px-5 py-3 rounded-xl">
                Absensi
            </a>

            <a href="/jadwal-orangtua"
               class="bg-green-500 text-white px-5 py-3 rounded-xl">
                Jadwal
            </a>

            <a href="/laporan-anak"
               class="bg-purple-500 text-white px-5 py-3 rounded-xl">
                Laporan
            </a>

        </div>

        @yield('content')

    </div>

</body>
</html>