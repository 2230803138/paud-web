<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EBONY PRESCHOOL - Tempat Belajar & Bermain Terbaik Anak</title>

    {{-- Tailwind CSS & Google Fonts --}}
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .text-gradient {
            background: linear-gradient(135deg, #db2777, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #db2777, #7c3aed);
        }
        .premium-bg {
            background: linear-gradient(135deg, #fff0f6 0%, #f4eaff 35%, #e0f2fe 70%, #fff1f2 100%);
            background-image: 
                radial-gradient(rgba(219, 39, 119, 0.08) 1.5px, transparent 1.5px), 
                radial-gradient(rgba(124, 58, 237, 0.08) 1.5px, transparent 1.5px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>

<body class="premium-bg font-sans text-slate-800 antialiased overflow-x-hidden">

    <!-- Ambient Glowing Blobs -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-pink-400/20 rounded-full filter blur-[100px] pointer-events-none"></div>
    <div class="absolute top-[600px] right-20 w-96 h-96 bg-purple-400/20 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-40 left-20 w-80 h-80 bg-sky-400/20 rounded-full filter blur-[100px] pointer-events-none"></div>

    <!-- ================= NAVBAR ================= -->
    <nav class="glass-nav fixed w-full z-50 border-b border-pink-100/40 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 rounded-full shadow-md bg-white p-1">
                <span class="font-outfit font-extrabold text-xl sm:text-2xl tracking-tight text-gradient">
                    EBONY PRESCHOOL
                </span>
            </a>

            <!-- Menu Navigation Links -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="#tentang" class="text-slate-600 hover:text-pink-600 font-bold transition text-sm">Tentang</a>
                <a href="#program" class="text-slate-600 hover:text-pink-600 font-bold transition text-sm">Program</a>
                <a href="#informasi" class="text-slate-600 hover:text-pink-600 font-bold transition text-sm">Informasi</a>
                <a href="#kontak" class="text-slate-600 hover:text-pink-600 font-bold transition text-sm">Kontak</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-3">
                <!-- Dropdown Login Pilihan -->
                <div class="relative group">
                    <button class="bg-gradient-primary hover:opacity-90 text-white font-bold px-5 py-2.5 rounded-2xl shadow-lg shadow-pink-500/25 text-sm flex items-center gap-1 transition">
                        🔑 Masuk Panel <span class="text-xs">▼</span>
                    </button>
                    <!-- Wrapper tanpa gap hover -->
                    <div class="absolute right-0 top-full pt-2 w-48 hidden group-hover:block z-50">
                        <div class="bg-white border border-slate-100 rounded-2xl shadow-xl py-2">
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-pink-50 hover:text-pink-650 font-semibold">Login Admin</a>
                            <a href="{{ route('guru.login') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-pink-50 hover:text-pink-650 font-semibold">Login Guru</a>
                            <a href="{{ route('yayasan.login') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-pink-50 hover:text-pink-650 font-semibold">Login Yayasan</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('orangtua.register') }}"
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:opacity-95 text-white font-bold px-5 py-2.5 rounded-2xl text-sm shadow-md shadow-purple-500/25 transition">
                    Daftar Orang Tua
                </a>
            </div>

        </div>
    </nav>

    <!-- ================= HERO SECTION ================= -->
    <section class="pt-36 pb-20 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center">
            
            <!-- Text Content (Left) -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-1.5 bg-pink-100 text-pink-700 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-wider shadow-sm shadow-pink-200">
                    ✨ Play, Learn & Grow Together
                </span>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-outfit font-extrabold text-slate-900 leading-tight">
                    Tumbuh Kembang Anak Lebih Cerdas di <span class="text-gradient">EBONY PRESCHOOL</span>
                </h1>
                
                <p class="text-slate-650 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                    Menyediakan lingkungan belajar yang aman, menyenangkan, dan kreatif untuk membimbing generasi emas yang cerdas, mandiri, dan berkarakter mulia sejak usia dini.
                </p>

                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('pendaftaran.create') }}"
                       class="w-full sm:w-auto bg-gradient-primary hover:opacity-95 text-white font-extrabold px-8 py-4 rounded-2xl shadow-xl shadow-pink-500/30 text-center text-lg hover:scale-105 transition-all duration-200">
                        Daftarkan Anak Trail Class Sekarang ➔
                    </a>
                    
                    <a href="/cek-pendaftaran"
                       class="w-full sm:w-auto bg-gradient-to-r from-purple-600 to-indigo-600 hover:opacity-95 text-white font-extrabold px-6 py-4 rounded-2xl shadow-xl shadow-purple-500/30 text-center text-base hover:scale-105 transition-all duration-200">
                        🔍 Cek Status Pendaftaran
                    </a>
                </div>
            </div>

            <!-- Hero Image (Right) -->
            <div class="lg:col-span-5 flex justify-center float-animation">
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full opacity-20 blur-2xl"></div>
                    <img src="https://cdn-icons-png.flaticon.com/512/4207/4207247.png"
                         class="w-[300px] sm:w-[360px] lg:w-[380px] relative z-10 drop-shadow-2xl">
                </div>
            </div>

        </div>
    </section>

    <!-- ================= TENTANG KAMI ================= -->
    <section id="tentang" class="py-24 bg-transparent">
        <div class="max-w-6xl mx-auto px-6 text-center">
            
            <span class="text-xs font-bold uppercase tracking-widest text-pink-600">Tentang Sekolah</span>
            <h2 class="text-3xl sm:text-4xl font-outfit font-extrabold text-slate-900 mt-2 mb-6">
                Membangun Karakter Anak Sejak Dini
            </h2>
            
            <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-4xl mx-auto font-medium">
                <strong>EBONY PRESCHOOL</strong> berkomitmen mendampingi anak dalam fase emas pertumbuhannya melalui metode pembelajaran aktif berbasis bermain (*play-based learning*). Kami mengintegrasikan pengembangan kognitif, motorik halus/kasar, kreativitas seni, serta budi pekerti yang luhur.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-16">
                <!-- Tentang Cards with Colored Glow Shadows -->
                <div class="p-8 bg-white/80 backdrop-blur-md rounded-3xl border border-pink-100/60 shadow-xl shadow-pink-200/50 hover:shadow-pink-300/70 hover:-translate-y-1.5 transition duration-300 text-center">
                    <div class="text-5xl mb-5">🏆</div>
                    <h4 class="font-extrabold text-slate-800 text-xl mb-3">Terakreditasi Baik</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Standar pengajaran teruji untuk mendidik potensi anak secara optimal.</p>
                </div>
                <div class="p-8 bg-white/80 backdrop-blur-md rounded-3xl border border-purple-100/60 shadow-xl shadow-purple-200/50 hover:shadow-purple-300/70 hover:-translate-y-1.5 transition duration-300 text-center">
                    <div class="text-5xl mb-5">🛡️</div>
                    <h4 class="font-extrabold text-slate-800 text-xl mb-3">Lingkungan Aman</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Fasilitas bermain & belajar ramah anak yang dipantau penuh oleh staf pengajar.</p>
                </div>
                <div class="p-8 bg-white/80 backdrop-blur-md rounded-3xl border border-blue-100/60 shadow-xl shadow-blue-200/50 hover:shadow-blue-300/70 hover:-translate-y-1.5 transition duration-300 text-center">
                    <div class="text-5xl mb-5">👩‍🏫</div>
                    <h4 class="font-extrabold text-slate-800 text-xl mb-3">Guru Berpengalaman</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Tenaga pendidik penyayang yang terlatih mendampingi tumbuh kembang anak.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= PROGRAM BELAJAR ================= -->
    <section id="program" class="py-24 bg-transparent">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-2">
                <span class="text-xs font-bold uppercase tracking-widest text-purple-600">Program Kami</span>
                <h2 class="text-3xl sm:text-4xl font-outfit font-extrabold text-slate-900">
                    Metode Pembelajaran Interaktif
                </h2>
                <p class="text-slate-500 text-sm sm:text-base">Mempersiapkan anak menghadapi masa depan dengan kurikulum yang menyenangkan.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Program 1 (Pink Glow Shadow) -->
                <div class="bg-white/85 backdrop-blur-md rounded-3xl p-8 border border-pink-100/50 shadow-xl shadow-pink-200/40 hover:shadow-pink-300/60 hover:-translate-y-2 duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 bg-pink-100 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-md shadow-pink-200">🎨</div>
                        <h3 class="text-xl font-extrabold text-slate-850 mb-3">Kreativitas Seni</h3>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium">
                            Mengasah imajinasi anak melalui aktivitas menggambar, mewarnai, kerajinan tangan, dan kreasi musik edukatif.
                        </p>
                    </div>
                </div>

                <!-- Program 2 (Purple Glow Shadow) -->
                <div class="bg-white/85 backdrop-blur-md rounded-3xl p-8 border border-purple-100/50 shadow-xl shadow-purple-200/40 hover:shadow-purple-300/60 hover:-translate-y-2 duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-md shadow-purple-200">📚</div>
                        <h3 class="text-xl font-extrabold text-slate-850 mb-3">Belajar Dasar</h3>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium">
                            Mengenal konsep dasar membaca, berhitung sederhana, serta mengenal huruf & angka dengan cara yang interaktif.
                        </p>
                    </div>
                </div>

                <!-- Program 3 (Blue Glow Shadow) -->
                <div class="bg-white/85 backdrop-blur-md rounded-3xl p-8 border border-blue-100/50 shadow-xl shadow-blue-200/40 hover:shadow-blue-300/60 hover:-translate-y-2 duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-md shadow-blue-200">⚽</div>
                        <h3 class="text-xl font-extrabold text-slate-850 mb-3">Ketangkasan Motorik</h3>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium">
                            Melatih fisik dan koordinasi tubuh anak melalui permainan luar ruangan yang seru serta olahraga ringan.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= ANNOUNCEMENTS / INFORMASI (DYNAMIC) ================= -->
    @if($informasi->isNotEmpty())
    <section id="informasi" class="py-24 bg-transparent border-t border-pink-100/30">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-2">
                <span class="text-xs font-bold uppercase tracking-widest text-pink-600">Kabar Sekolah</span>
                <h2 class="text-3xl sm:text-4xl font-outfit font-extrabold text-slate-900">
                    Informasi & Pengumuman Terbaru
                </h2>
                <p class="text-slate-500 text-sm sm:text-base">Ikuti terus berita, agenda kegiatan, dan info terbaru seputar Ebony Preschool.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($informasi as $info)
                    <div class="bg-white/90 backdrop-blur-md border border-pink-100/40 rounded-3xl p-6 shadow-xl shadow-pink-100/60 hover:shadow-pink-200/80 hover:-translate-y-1.5 transition duration-300 flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-pink-600 bg-pink-100 px-3 py-1 rounded-full uppercase shadow-sm shadow-pink-200">
                                📅 {{ \Carbon\Carbon::parse($info->tanggal)->translatedFormat('d M Y') }}
                            </span>
                            <h4 class="font-extrabold text-lg text-slate-850 mt-4 mb-2">
                                {{ $info->judul }}
                            </h4>
                            <p class="text-slate-500 text-sm leading-relaxed whitespace-pre-line font-medium">
                                {{ Str::limit($info->isi, 120) }}
                            </p>
                        </div>
                        @if(strlen($info->isi) > 120)
                            <button onclick="showInfoModal('{{ addslashes($info->judul) }}', '{{ $info->tanggal }}', '{{ addslashes(str_replace(["\r", "\n"], ["", " "], $info->isi)) }}')" 
                                    class="text-pink-600 font-bold text-xs mt-4 hover:underline text-left block">
                                Baca Selengkapnya ➔
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif

    <!-- ================= CTA BANNER ================= -->
    <section class="py-16 px-6 bg-transparent">
        <div class="max-w-6xl mx-auto bg-gradient-primary rounded-3xl p-8 sm:p-12 text-white shadow-2xl shadow-pink-500/35 text-center relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-48 h-48 bg-white/10 rounded-full"></div>
            
            <div class="relative z-10 space-y-6">
                <h2 class="text-3xl sm:text-4xl font-outfit font-extrabold">
                    Ayo Daftarkan Anak Anda Sekarang!
                </h2>
                <p class="text-pink-100 text-sm sm:text-base max-w-2xl mx-auto font-medium">
                    Bersama EBONY PRESCHOOL, wujudkan masa depan anak yang lebih baik, cerdas, kreatif, dan mandiri.
                </p>
                <div class="pt-4">
                    <a href="{{ route('pendaftaran.create') }}"
                       class="inline-block bg-white text-pink-600 hover:bg-pink-50 font-extrabold px-8 py-4 rounded-2xl shadow-lg shadow-black/10 text-lg hover:scale-105 transition-all duration-200">
                        Daftarkan Anak Trail Class Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= KONTAK KAMI ================= -->
    <section id="kontak" class="py-24 bg-transparent border-t border-pink-100/30">
        <div class="max-w-6xl mx-auto px-6">
            
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-2">
                <span class="text-xs font-bold uppercase tracking-widest text-pink-600">Hubungi Kami</span>
                <h2 class="text-3xl font-outfit font-extrabold text-slate-900">Hubungi & Kunjungi Kami</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Alamat -->
                <div class="bg-white/90 backdrop-blur-md border border-pink-100/40 rounded-3xl p-6 shadow-xl shadow-pink-100/40 hover:shadow-pink-200/50 transition text-center">
                    <div class="text-4xl mb-4">📍</div>
                    <h3 class="font-extrabold text-slate-800 text-lg mb-2">Alamat</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">
                        Jl. Pendidikan No. 10, Palembang
                    </p>
                </div>

                <!-- Telepon -->
                <div class="bg-white/90 backdrop-blur-md border border-pink-100/40 rounded-3xl p-6 shadow-xl shadow-purple-100/40 hover:shadow-purple-200/50 transition text-center">
                    <div class="text-4xl mb-4">📞</div>
                    <h3 class="font-extrabold text-slate-800 text-lg mb-2">Telepon / WhatsApp</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">
                        0831-6862-7009
                    </p>
                </div>

                <!-- Email -->
                <div class="bg-white/90 backdrop-blur-md border border-pink-100/40 rounded-3xl p-6 shadow-xl shadow-blue-100/40 hover:shadow-blue-200/50 transition text-center">
                    <div class="text-4xl mb-4">✉️</div>
                    <h3 class="font-extrabold text-slate-800 text-lg mb-2">Email Resmi</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">
                        ebonypreschool@gmail.com
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-slate-900 text-slate-400 py-12 text-center border-t border-slate-850">
        <div class="max-w-7xl mx-auto px-6 space-y-6">
            <h3 class="font-outfit font-extrabold text-xl text-white tracking-wider">EBONY PRESCHOOL</h3>
            <p class="text-sm max-w-lg mx-auto">Membina generasi unggul yang cerdas, kreatif, dan mandiri sejak dini.</p>
            <div class="border-t border-slate-800 pt-6 text-xs">
                © {{ date('Y') }} EBONY PRESCHOOL — All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Modal Detail Informasi -->
    <div id="info-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-3xl p-8 w-full max-w-2xl mx-6 shadow-2xl relative">
            <button onclick="closeInfoModal()" class="absolute right-6 top-6 text-slate-450 hover:text-slate-650 text-2xl font-bold">&times;</button>
            <span id="modal-date" class="text-[10px] font-bold text-pink-650 bg-pink-100 px-3 py-1 rounded-full uppercase"></span>
            <h3 id="modal-title" class="text-2xl font-extrabold text-slate-900 mt-4 mb-4"></h3>
            <p id="modal-content" class="text-slate-600 leading-relaxed whitespace-pre-line text-sm"></p>
        </div>
    </div>

    <script>
        function showInfoModal(title, date, content) {
            const formattedDate = new Date(date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-date').innerText = "📅 " + formattedDate;
            document.getElementById('modal-content').innerText = content;
            document.getElementById('info-modal').classList.remove('hidden');
        }

        function closeInfoModal() {
            document.getElementById('info-modal').classList.add('hidden');
        }
    </script>

</body>
</html>
