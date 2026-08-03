<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan Ebony Preschool - Monitoring System</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }

        .menu-active{
            background: linear-gradient(to right,#db2777,#7c3aed);
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
                    Sistem Yayasan
                </p>
            </div>
        </div>

        <nav class="flex-1 p-5 space-y-3">
            <a href="{{ route('dashboard.yayasan') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('dashboard.yayasan') ? 'menu-active' : 'text-gray-600 font-semibold' }}">
                🏠 Dashboard Monitoring
            </a>

            <a href="{{ route('yayasan.laporan-guru') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('yayasan.laporan-guru*') ? 'menu-active' : 'text-gray-600 font-semibold' }}">
                👥 Guru & Absensi
            </a>

            <a href="{{ route('yayasan.laporan-siswa') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('yayasan.laporan-siswa*') ? 'menu-active' : 'text-gray-600 font-semibold' }}">
                👶 Siswa & Absensi
            </a>

            <a href="{{ route('yayasan.laporan-pembayaran') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('yayasan.laporan-pembayaran*') ? 'menu-active' : 'text-gray-600 font-semibold' }}">
                💰 Laporan SPP
            </a>

            <a href="{{ route('yayasan.laporan-pendaftaran') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('yayasan.laporan-pendaftaran*') ? 'menu-active' : 'text-gray-600 font-semibold' }}">
                📝 Pendaftaran Baru
            </a>

            <a href="{{ route('yayasan.laporan-ulasan') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-pink-100 hover:text-pink-600 transition {{ request()->routeIs('yayasan.laporan-ulasan*') ? 'menu-active' : 'text-gray-600 font-semibold' }}">
                💬 Ulasan Guru
            </a>
        </nav>

        <div class="p-5 border-t">
            <!-- Profile Info Box -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 bg-gray-50 border border-slate-100 hover:bg-pink-50 hover:border-pink-200 rounded-2xl p-3 mb-4 transition block">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'Y', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] font-bold text-gray-405 uppercase tracking-wider mt-0.5 font-semibold">Yayasan ➔</p>
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
                <h2 class="text-2xl font-bold text-gray-800">
                    Ebony Preschool
                </h2>
            </div>

            <!-- Dropdown Switcher Cabang -->
            <div class="flex items-center gap-3 bg-pink-50/50 border border-pink-100 rounded-2xl px-4 py-2">
                <span class="text-xs font-bold text-pink-600 uppercase tracking-wider">Cabang:</span>
                <form method="GET" action="" id="cabang-switcher-form">
                    @php
                        $cabangs = \App\Models\Cabang::all();
                        $currentCabang = request('cabang_id');
                    @endphp
                    <select name="cabang_id" onchange="document.getElementById('cabang-switcher-form').submit()" 
                            class="bg-transparent border-0 text-sm font-semibold text-gray-700 focus:ring-0 focus:outline-none cursor-pointer">
                        <option value="">Semua Cabang (Global)</option>
                        @foreach($cabangs as $cb)
                            <option value="{{ $cb->id }}" {{ $currentCabang == $cb->id ? 'selected' : '' }}>
                                {{ $cb->nama_cabang }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <a href="{{ route('profile.edit') }}" class="text-right hover:opacity-80 transition block">
                <p class="font-semibold text-pink-600">
                    👤 {{ Auth::user()->name }}
                </p>
                <small class="text-gray-500 font-medium">
                    Kepala Yayasan
                </small>
            </a>
        </div>

        <div class="p-8">
            @yield('content')
        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
