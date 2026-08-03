<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Orang Tua')</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f7f8fc;
        }

        .menu{
            transition:.3s;
        }

        .menu:hover{
            transform:translateX(6px);
        }

        .active-menu{
            background:linear-gradient(135deg,#ec4899,#8b5cf6);
            color:white !important;
            font-weight:600;
            box-shadow:0 12px 25px rgba(236,72,153,.25);
        }
    </style>

</head>

<body class="bg-gradient-to-br from-pink-50 via-white to-purple-50">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-white border-r border-gray-200 shadow">

        <div class="bg-gradient-to-br from-pink-500 via-fuchsia-500 to-purple-600 p-8 text-center">

            <img src="{{ asset('images/logo.png') }}"
                 class="w-24 h-24 rounded-full bg-white p-2 mx-auto shadow-lg">

            <h1 class="text-white text-3xl font-bold mt-5">
                EBONY PRESCHOOL
            </h1>

            <p class="text-pink-100 text-sm tracking-widest mt-2">
                DASHBOARD ORANG TUA
            </p>

        </div>

        <nav class="p-5 space-y-3">

            <a href="{{ route('dashboard.orangtua') }}"
               class="menu flex items-center gap-3 px-5 py-3 rounded-xl {{ request()->is('dashboard-orangtua') ? 'active-menu' : 'hover:bg-pink-50' }}">
                🏠 Dashboard
            </a>

            <a href="{{ url('/absensi-anak') }}"
               class="menu flex items-center gap-3 px-5 py-3 rounded-xl {{ request()->is('absensi-anak') ? 'active-menu' : 'hover:bg-pink-50' }}">
                📍 Absensi Anak
            </a>

            <a href="{{ url('/jadwal-orangtua') }}"
               class="menu flex items-center gap-3 px-5 py-3 rounded-xl {{ request()->is('jadwal-orangtua') ? 'active-menu' : 'hover:bg-pink-50' }}">
                📅 Jadwal
            </a>

            <a href="{{ url('/laporan-anak') }}"
               class="menu flex items-center gap-3 px-5 py-3 rounded-xl {{ request()->is('laporan-anak') ? 'active-menu' : 'hover:bg-pink-50' }}">
                📊 Laporan
            </a>

            <a href="{{ route('orangtua.pembayaran') }}"
               class="menu flex items-center gap-3 px-5 py-3 rounded-xl {{ request()->is('pembayaran-orangtua') ? 'active-menu' : 'hover:bg-pink-50' }}">
                💳 Pembayaran SPP
            </a>

            <a href="{{ route('orangtua.ulasan.index') }}"
               class="menu flex items-center gap-3 px-5 py-3 rounded-xl {{ request()->routeIs('orangtua.ulasan.index') ? 'active-menu' : 'hover:bg-pink-50' }}">
                💬 Ulasan Guru
            </a>

            <a href="{{ route('profile.edit') }}"
               class="menu flex items-center gap-3 px-5 py-3 rounded-xl {{ request()->is('profile') ? 'active-menu' : 'hover:bg-pink-50' }}">
                👤 Profil
            </a>

        </nav>

        <div class="p-5">

            <div class="bg-gray-100 hover:bg-gray-200/70 transition rounded-2xl p-4">

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(Auth::user()->name ?? 'O', 0, 1)) }}
                    </div>

                    <div>

                        <h3 class="font-bold text-gray-800">
                            {{ Auth::user()->name }}
                        </h3>

                        <p class="text-xs text-gray-500">
                            Orang Tua ➔
                        </p>

                    </div>

                </a>

                <form method="POST"
                      action="{{ route('logout') }}"
                      class="mt-5">

                    @csrf

                    <button
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl font-semibold">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </aside>

    <!-- Content -->
    <div class="flex-1 flex flex-col">

        <header class="bg-white border-b border-gray-200 p-6">

            <h1 class="text-3xl font-bold text-gray-700">

                @yield('title')

            </h1>

            <p class="text-gray-500 mt-1">

                Selamat datang di Sistem Informasi Manajemen Ebony Preschool

            </p>

        </header>

        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>