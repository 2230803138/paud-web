<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pendaftaran</title>

    <script src="{{ asset('js/tailwind.js') }}"></script>
</head>

<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-3xl p-8 w-full {{ request()->isMethod('post') ? 'max-w-4xl' : 'max-w-lg' }} transition-all duration-300">

        @if(request()->isMethod('post'))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kiri: Form Pencarian Ulang -->
                <div>
                    <h2 class="text-2xl font-bold text-pink-600 mb-6">Cek Status Pendaftaran</h2>
                    <form action="/cek-pendaftaran" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block mb-1.5 font-semibold text-gray-700 text-sm">Nama Anak</label>
                            <input type="text" name="nama_anak" value="{{ request('nama_anak') }}" 
                                class="w-full border-2 border-pink-200 rounded-xl p-3 text-sm focus:outline-none focus:border-pink-500" required>
                        </div>
                        <div>
                            <label class="block mb-1.5 font-semibold text-gray-700 text-sm">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full border-2 border-pink-200 rounded-xl p-3 text-sm focus:outline-none focus:border-pink-500 text-gray-700">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1.5 font-semibold text-gray-700 text-sm">No HP</label>
                            <input type="text" name="no_hp" value="{{ request('no_hp') }}" 
                                class="w-full border-2 border-pink-200 rounded-xl p-3 text-sm focus:outline-none focus:border-pink-500" required>
                        </div>
                        <button class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl shadow-lg font-semibold transition">
                            Cek Status Baru
                        </button>
                    </form>
                    <div class="mt-6 text-center">
                        <a href="/" class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-pink-600 transition font-bold">
                            ← Kembali ke Beranda
                        </a>
                    </div>
                </div>

                <!-- Kanan: Hasil Verifikasi -->
                <div class="border-t md:border-t-0 md:border-l border-slate-200 pt-6 md:pt-0 md:pl-8 flex flex-col justify-center">
                    @if(isset($data))
                        <h2 class="text-xl font-bold text-gray-700 mb-4 text-center md:text-left">Hasil Verifikasi Pendaftaran</h2>
                        
                        <div class="bg-slate-50 p-4 rounded-2xl mb-4 border border-slate-200">
                            <table class="w-full text-xs">
                                <tr class="border-b border-slate-200/50">
                                    <td class="py-2 text-gray-500 font-medium">Nama Anak</td>
                                    <td class="py-2 font-bold text-gray-800 text-right">{{ $data->nama_anak }}</td>
                                </tr>
                                <tr class="border-b border-slate-200/50">
                                    <td class="py-2 text-gray-500 font-medium">Nama Orang Tua</td>
                                    <td class="py-2 font-bold text-gray-800 text-right">{{ $data->nama_ortu }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-500 font-medium">No. HP Pendaftar</td>
                                    <td class="py-2 font-bold text-gray-800 text-right">{{ $data->no_hp }}</td>
                                </tr>
                            </table>
                        </div>

                        @if($data->status == 'diterima')
                            <div class="bg-green-50 border-l-4 border-green-500 p-5 rounded-2xl text-left shadow-sm">
                                <h3 class="font-extrabold text-green-800 text-sm">🎉 Selamat, Anak Anda Diterima!</h3>
                                <p class="text-xs text-green-700 mt-1 leading-relaxed">
                                    Pendaftaran anak Anda dinyatakan <span class="font-bold underline text-green-800">diterima</span> di Ebony Preschool.
                                </p>
                                <hr class="my-3 border-green-200">
                                <p class="text-[11px] text-green-800 font-bold">Langkah Selanjutnya:</p>
                                <p class="text-[10px] text-green-600 mt-0.5 leading-relaxed">
                                    Silakan buat akun Orang Tua agar Anda dapat memantau kehadiran harian, jadwal kegiatan, dan rekap perkembangan belajar anak.
                                </p>
                                <a href="{{ route('orangtua.register') }}?name={{ urlencode($data->nama_ortu) }}&no_hp={{ urlencode($data->no_hp) }}" 
                                   class="mt-3 block w-full bg-green-600 hover:bg-green-700 text-white text-center text-xs font-bold py-2.5 rounded-xl shadow transition">
                                    ➡️ Buat Akun Orang Tua Sekarang
                                </a>
                            </div>
                        @elseif($data->status == 'ditolak')
                            <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-2xl text-left shadow-sm">
                                <h3 class="font-extrabold text-red-800 text-sm">❌ Pendaftaran Belum Diterima</h3>
                                <p class="text-xs text-red-700 mt-1.5 leading-relaxed">
                                    Mohon maaf, pendaftaran anak Anda dinyatakan belum diterima saat ini. Silakan hubungi pihak sekolah untuk informasi lebih lanjut.
                                </p>
                            </div>
                        @else
                            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-5 rounded-2xl text-left shadow-sm">
                                <h3 class="font-extrabold text-yellow-800 text-sm">⏳ Sedang Dalam Proses</h3>
                                <p class="text-xs text-yellow-700 mt-1.5 leading-relaxed">
                                    Pendaftaran saat ini berstatus <strong>Menunggu Verifikasi</strong>. Mohon menunggu konfirmasi lebih lanjut dari pihak sekolah secara berkala.
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-2xl text-left">
                            <p class="text-sm font-bold text-red-700">⚠️ Data Tidak Ditemukan</p>
                            <p class="text-xs text-red-600 mt-1 leading-relaxed">
                                Data pendaftaran dengan nama anak <strong>{{ request('nama_anak') }}</strong> tidak ditemukan. Silakan periksa kembali data yang dimasukkan.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <!-- Tampilan GET Default (Form Saja) -->
            <h1 class="text-3xl font-bold text-center text-pink-600 mb-6">
                Cek Status Pendaftaran
            </h1>

            <form action="/cek-pendaftaran" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">Nama Anak</label>
                    <input type="text" name="nama_anak" class="w-full border-2 border-pink-200 rounded-xl p-3 focus:outline-none focus:border-pink-500" required>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border-2 border-pink-200 rounded-xl p-3 focus:outline-none focus:border-pink-500 text-gray-700" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">No HP</label>
                    <input type="text" name="no_hp" class="w-full border-2 border-pink-200 rounded-xl p-3 focus:outline-none focus:border-pink-500" required>
                </div>
                <button class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl shadow-lg font-semibold transition">
                    Cek Status
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-pink-600 transition font-bold">
                    ← Kembali ke Halaman Utama
                </a>
            </div>
        @endif

    </div>

    </div>

</body>
</html>