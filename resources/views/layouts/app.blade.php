<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>EBONY PRESCHOOL</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

*{
    font-family:'Poppins',sans-serif;
}

body{
    background:#f7f8fc;
}

::-webkit-scrollbar{
    width:8px;
}

::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

::-webkit-scrollbar-thumb:hover{
    background:#9ca3af;
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

.active-menu:hover{

    color:white !important;

}

.shadow-soft{
    box-shadow:0 15px 35px rgba(0,0,0,.08);
}

.card{
    background:white;
    border-radius:25px;
    padding:25px;
    transition:.35s;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 25px 45px rgba(0,0,0,.12);
}

.table-card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

.btn-primary{
    background:linear-gradient(135deg,#ec4899,#8b5cf6);
    color:white;
    padding:12px 20px;
    border-radius:14px;
    font-weight:600;
    transition:.3s;
}

.btn-primary:hover{
    opacity:.9;
}

.input-modern{
    width:100%;
    padding:12px 18px;
    border-radius:14px;
    border:1px solid #e5e7eb;
    outline:none;
}

.input-modern:focus{
    border-color:#ec4899;
}

</style>

</head>

<body class="bg-gradient-to-br from-pink-50 via-white to-purple-50">

<div class="flex min-h-screen">

<!-- ================= SIDEBAR ================= -->

<aside class="w-72 bg-white border-r border-gray-200 flex flex-col shadow-sm">

    <!-- Logo -->

    <div class="bg-gradient-to-br from-pink-500 via-fuchsia-500 to-purple-600 p-8">

        <div class="flex justify-center">

            <img src="{{ asset('images/logo.png') }}"
                 class="w-24 h-24 rounded-full bg-white p-2 shadow-lg">

        </div>

        <h1 class="text-center text-white font-extrabold text-3xl mt-5 tracking-wide">

            EBONY PRESCHOOL

        </h1>

        <p class="text-center text-pink-100 uppercase tracking-[4px] text-xs mt-2">

            Sistem Informasi Manajemen

        </p>

    </div>

    <!-- MENU -->

    <nav class="flex-1 px-5 py-6 space-y-3 overflow-y-auto">

        <a href="/dashboard"
           class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('dashboard') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

            🏠

            Dashboard

        </a>

        <a href="/pendaftaran"
           class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('pendaftaran*') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

            📝

            Pendaftaran

        </a>

        <a href="/siswa"
           class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('siswa*') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

            👨‍🎓

            Data Peserta Didik

        </a>
                   <a href="{{ route('absensi.index') }}"
class="menu flex items-center gap-4 px-5 py-3 rounded-2xl
{{ request()->routeIs('absensi.index')
    || request()->routeIs('absensi.create')
    || request()->routeIs('absensi.edit')
    ? 'active-menu'
    : 'hover:bg-pink-50 hover:text-pink-600' }}">

    📅

    Absensi

</a>

<a href="{{ route('absensi.guru.index') }}"
class="menu flex items-center gap-4 px-5 py-3 rounded-2xl
{{ request()->routeIs('absensi.guru.index')
    ? 'active-menu'
    : 'hover:bg-pink-50 hover:text-pink-600' }}">

    👩‍🏫

    Absensi Guru

</a>
<a href="/guru"
    class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('guru*') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

    👩‍🏫

    Data Guru

</a>

        <a href="/kelas"
           class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('kelas*') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

            📚

            Data Kelas

        </a>

        <a href="/pembayaran"
           class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('pembayaran*') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

            💳

            Pembayaran

        </a>

           <a href="{{ route('jadwal.index') }}"
   class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('jadwal*') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

    📅

    Jadwal

</a>
        </li>

        <a href="/informasi"
           class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('informasi*') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

            📢

            Informasi Sekolah

        </a>

        <a href="/laporan"
           class="menu flex items-center gap-4 px-5 py-3 rounded-2xl {{ request()->is('laporan*') ? 'active-menu' : 'hover:bg-pink-50 hover:text-pink-600' }}">

            📄

            Laporan

        </a>

    </nav>

  <!-- USER -->

<div class="p-5">

    <div class="bg-gray-50 rounded-2xl border p-4">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl">
                {{ strtoupper(substr(Auth::user()->name ?? 'A',0,1)) }}
            </div>

            <div class="flex-1">

                <h3 class="font-bold text-gray-700">
                    {{ Auth::user()->name }}
                </h3>

                <p class="text-sm text-gray-500">
                    {{ ucfirst(Auth::user()->role) }}
                </p>

                <span class="text-xs text-green-500">
                    ● Online
                </span>

            </div>

        </div>

        <div class="mt-4 border-t pt-4">

            <a href="{{ route('profile.edit') }}"
               class="block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl mb-2">
                👤 Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl">
                    🚪 Logout
                </button>
            </form>

        </div>

    </div>

</div>

</aside>
<!-- Main Content -->

<div class="flex-1 flex flex-col">

<header class="bg-white/80 backdrop-blur-md border-b border-gray-200 px-8 py-5 flex items-center justify-between sticky top-0 z-50">

<div>
<p id="dashboard-greeting" class="text-sm text-gray-500 font-medium">👋</p>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hour = new Date().getHours();
        let greeting = 'Good Night';
        if (hour >= 5 && hour < 12) {
            greeting = 'Good Morning';
        } else if (hour >= 12 && hour < 17) {
            greeting = 'Good Afternoon';
        } else if (hour >= 17 && hour < 21) {
            greeting = 'Good Evening';
        }
        document.getElementById('dashboard-greeting').innerHTML = greeting + ' 👋';
    });
</script>

<h1 class="text-3xl font-extrabold text-gray-800 mt-1">

{{ Auth::user()->name ?? 'Admin' }}

</h1>

<p class="text-gray-500 mt-1">Selamat datang di Sistem Informasi Manajemen Ebony Preschool</p>

</div>

<div class="flex items-center gap-5">

<!-- Search -->
<div class="relative hidden md:block">
    <div class="flex items-center bg-gray-100 rounded-2xl px-4 py-3 w-80">
        <span class="text-gray-400 mr-3">🔍</span>
        <input type="text" id="global-search-input" placeholder="Cari menu, siswa, guru..."
               class="bg-transparent outline-none w-full text-sm">
    </div>
    <!-- Search Results Dropdown -->
    <div id="search-results-dropdown" 
         class="absolute left-0 mt-2 w-80 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 max-h-96 overflow-y-auto hidden">
    </div>
</div>

<!-- Notifikasi -->
<div class="relative">
    <button id="notification-bell-btn" class="relative bg-gray-100 hover:bg-gray-200 w-12 h-12 rounded-2xl flex items-center justify-center transition">
        🔔
        <span id="notification-badge" class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center hidden">0</span>
    </button>
    <!-- Notification Dropdown -->
    <div id="notification-dropdown" 
         class="absolute right-0 mt-2 w-80 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 max-h-96 overflow-y-auto hidden">
        <div class="p-4 border-b border-gray-150 flex justify-between items-center">
            <span class="font-bold text-gray-800 text-sm">Notifikasi</span>
            <span id="notification-count-text" class="text-xs bg-pink-100 text-pink-700 px-2 py-0.5 rounded-full font-bold">0 Baru</span>
        </div>
        <div id="notification-items-container" class="divide-y divide-gray-50">
            <!-- Loaded dynamically -->
        </div>
    </div>
</div>

<!-- Profil -->

<a href="{{ route('profile.edit') }}" class="flex items-center gap-3 bg-gray-100 hover:bg-gray-200 transition rounded-2xl px-4 py-2">

<div class="w-10 h-10 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow">
    {{ strtoupper(substr(Auth::user()->name ?? 'A',0,1)) }}
</div>

<div class="hidden md:block text-left">

<h3 class="font-semibold text-gray-700 leading-none">

{{ Auth::user()->name ?? 'Admin' }}

</h3>

<p class="text-xs text-gray-500 mt-1">Administrator</p>

</div>

</a>

</div>

</header>
    <!-- Isi Halaman -->
<main class="flex-1 overflow-y-auto p-8">

    <!-- Breadcrumb -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">

                @yield('title','Dashboard')

            </h2>

            <p class="text-gray-500 mt-1">

                Kelola seluruh data Ebony Preschool dengan mudah dan cepat.

            </p>

        </div>

        <div class="text-right">

            <p class="text-sm text-gray-500">

                {{ \Carbon\Carbon::now()->translatedFormat('l') }}

            </p>

            <h3 class="font-bold text-gray-700">

                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

            </h3>

        </div>

    </div>

    <!-- Content -->

    @yield('content')

</main>

<!-- Footer -->

<footer class="bg-white border-t border-gray-200 py-5 px-8">

    <div class="flex justify-between items-center">

        <div>

            <h3 class="font-semibold text-gray-700">

                EBONY PRESCHOOL

            </h3>

            <p class="text-sm text-gray-500">

                Sistem Informasi Manajemen Sekolah

            </p>

        </div>

        <div class="text-right">

            <p class="text-sm text-gray-500">

                © {{ date('Y') }} Ebony Preschool

            </p>

            <p class="text-xs text-gray-400">

                Version 1.0

            </p>

        </div>

    </div>

</footer>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Global Search & Notification Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- GLOBAL SEARCH ---
    const searchInput = document.getElementById('global-search-input');
    const searchDropdown = document.getElementById('search-results-dropdown');

    if (searchInput && searchDropdown) {
        let timeout = null;

        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            const query = searchInput.value.trim();

            if (query.length < 2) {
                searchDropdown.innerHTML = '';
                searchDropdown.classList.add('hidden');
                return;
            }

            timeout = setTimeout(() => {
                fetch(`/admin/search?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        searchDropdown.innerHTML = '';
                        let hasResults = false;

                        // Menus section
                        if (data.menus && data.menus.length > 0) {
                            hasResults = true;
                            searchDropdown.innerHTML += `<div class="p-3 font-bold text-xs text-pink-500 uppercase bg-pink-50/50">Menu</div>`;
                            data.menus.forEach(item => {
                                searchDropdown.innerHTML += `
                                    <a href="${item.url}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-pink-50/30 transition text-sm text-gray-700">
                                        <span>${item.icon}</span>
                                        <span class="font-semibold">${item.name}</span>
                                    </a>
                                `;
                            });
                        }

                        // Siswa section
                        if (data.siswa && data.siswa.length > 0) {
                            hasResults = true;
                            searchDropdown.innerHTML += `<div class="p-3 font-bold text-xs text-purple-500 uppercase bg-purple-50/50">Siswa</div>`;
                            data.siswa.forEach(item => {
                                searchDropdown.innerHTML += `
                                    <a href="${item.url}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-purple-50/30 transition text-sm text-gray-700">
                                        <span>${item.icon}</span>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-800">${item.name}</span>
                                            <span class="text-xs text-gray-400">${item.desc}</span>
                                        </div>
                                    </a>
                                `;
                            });
                        }

                        // Guru section
                        if (data.guru && data.guru.length > 0) {
                            hasResults = true;
                            searchDropdown.innerHTML += `<div class="p-3 font-bold text-xs text-blue-500 uppercase bg-blue-50/50">Guru</div>`;
                            data.guru.forEach(item => {
                                searchDropdown.innerHTML += `
                                    <a href="${item.url}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-blue-50/30 transition text-sm text-gray-700">
                                        <span>${item.icon}</span>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-800">${item.name}</span>
                                            <span class="text-xs text-gray-400">${item.desc}</span>
                                        </div>
                                    </a>
                                `;
                            });
                        }

                        if (hasResults) {
                            searchDropdown.classList.remove('hidden');
                        } else {
                            searchDropdown.innerHTML = `<div class="p-4 text-center text-sm text-gray-400">Tidak ada hasil ditemukan.</div>`;
                            searchDropdown.classList.remove('hidden');
                        }
                    })
                    .catch(err => {
                        console.error('Error fetching search results:', err);
                    });
            }, 300);
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                searchDropdown.classList.add('hidden');
            }
        });

        // Focus again
        searchInput.addEventListener('focus', function() {
            if (searchInput.value.trim().length >= 2) {
                searchDropdown.classList.remove('hidden');
            }
        });
    }

    // --- GLOBAL NOTIFICATIONS ---
    const bellBtn = document.getElementById('notification-bell-btn');
    const notifDropdown = document.getElementById('notification-dropdown');

    if (bellBtn && notifDropdown) {
        function loadNotifications() {
            fetch('/admin/notifications')
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById('notification-badge');
                    const countText = document.getElementById('notification-count-text');
                    const container = document.getElementById('notification-items-container');

                    if (data.count > 0) {
                        badge.innerText = data.count;
                        badge.classList.remove('hidden');
                        countText.innerText = `${data.count} Baru`;
                    } else {
                        badge.classList.add('hidden');
                        countText.innerText = `0 Baru`;
                    }

                    if (container) {
                        container.innerHTML = '';
                        if (data.items && data.items.length > 0) {
                            data.items.forEach(item => {
                                container.innerHTML += `
                                    <a href="${item.url}" class="block p-4 hover:bg-pink-50/20 transition border-b border-gray-50 last:border-0">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="font-semibold text-sm text-gray-800">${item.title}</span>
                                            <span class="text-[10px] text-gray-400 font-medium">${item.time}</span>
                                        </div>
                                        <p class="text-xs text-gray-600">${item.body}</p>
                                    </a>
                                `;
                            });
                        } else {
                            container.innerHTML = `<div class="p-8 text-center text-xs text-gray-400">Tidak ada notifikasi baru.</div>`;
                        }
                    }
                })
                .catch(err => console.error(err));
        }

        // Load initially
        loadNotifications();

        // Toggle on click
        bellBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notifDropdown.classList.toggle('hidden');
            if (searchDropdown) {
                searchDropdown.classList.add('hidden');
            }
        });

        // Close on clicking outside
        document.addEventListener('click', function(e) {
            if (!bellBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                notifDropdown.classList.add('hidden');
            }
        });
    }
});
</script>

@stack('scripts')

</body>
</html>
