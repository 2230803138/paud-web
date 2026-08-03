<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - Ebony Preschool</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }

        .menu-active{
            background: linear-gradient(to right,#ec4899,#8b5cf6);
            color:white;
        }
    </style>

</head>

<body class="bg-pink-50">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-white shadow-xl flex flex-col">

        <div class="p-6 border-b flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 rounded-full shadow-md bg-white p-1">
            <div>
                <h1 class="text-lg font-bold text-pink-600 leading-none">
                    EBONY PRESCHOOL
                </h1>
                <p class="text-gray-500 text-[10px] mt-1 font-semibold uppercase tracking-wider">
                    Dashboard Guru
                </p>
            </div>
        </div>

        <nav class="flex-1 p-5 space-y-3">

    <a href="{{ route('dashboard.guru') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('dashboard.guru') ? 'menu-active' : '' }}">
        🏠 Dashboard
    </a>

    <a href="{{ route('guru.absensi') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('guru.absensi') ? 'menu-active' : '' }}">
        ✅ Absen Diri
    </a>

    <a href="{{ route('guru.absensi-anak') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('guru.absensi-anak') ? 'menu-active' : '' }}">
        👶 Absensi Anak
    </a>

    <a href="{{ route('guru.perkembangan') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('guru.perkembangan') ? 'menu-active' : '' }}">
        📝 Perkembangan Anak
    </a>

    <a href="{{ route('guru.profil') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('guru.profil') ? 'menu-active' : '' }}">
        👤 Profil Guru
    </a>

</nav>

        <div class="p-5 border-t">
            <!-- Profile Info Box -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 bg-gray-50 border border-slate-100 hover:bg-pink-50 hover:border-pink-200 rounded-2xl p-3 mb-4 transition block">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'G', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] font-bold text-gray-405 uppercase tracking-wider mt-0.5 font-semibold">Guru ➔</p>
                </div>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-xl font-bold text-sm transition">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Content -->
    <main class="flex-1 overflow-y-auto">

        <!-- Topbar -->
        <div class="bg-white shadow p-5 flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold">

                    Dashboard Guru

                </h2>

            </div>

            <div class="text-right">

                <p class="font-semibold">

                    {{ Auth::user()->name }}

                </p>

                <small class="text-gray-500">

                    Guru

                </small>

            </div>

        </div>

        <div class="p-8">

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>