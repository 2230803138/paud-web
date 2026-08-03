<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Anak</title>

    {{-- Tailwind CSS --}}
    <script src="{{ asset('js/tailwind.js') }}"></script>
</head>
<body class="bg-gradient-to-r from-pink-100 to-blue-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-4xl">

        <!-- Tombol Kembali ke Halaman Utama -->
        <div class="mb-6">
            <a href="/" class="inline-flex items-center gap-2 text-sm font-bold text-pink-600 hover:text-purple-700 transition bg-pink-50/60 hover:bg-pink-100/50 px-4 py-2.5 rounded-xl border border-pink-100/40 shadow-sm">
                ← Kembali ke Halaman Utama
            </a>
        </div>

        <h1 class="text-3xl font-bold text-center text-pink-600 mb-8">
            Form Pendaftaran Anak
        </h1>

        @if(session('success'))
            <div class="bg-green-150 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm text-center font-bold">
                🎉 {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                <ul class="list-disc list-inside font-semibold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- Nama Anak --}}
            <div>
                <label class="block mb-2 font-bold text-gray-700 text-sm">
                    Nama Anak
                </label>
                <input type="text" name="nama_anak" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-800 placeholder-gray-400"
                    placeholder="Masukkan nama anak">
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label class="block mb-2 font-bold text-gray-700 text-sm">
                    Jenis Kelamin
                </label>
                <select name="jenis_kelamin" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-700">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            {{-- Nama Orang Tua --}}
            <div>
                <label class="block mb-2 font-bold text-gray-700 text-sm">
                    Nama Orang Tua
                </label>
                <input type="text" name="nama_ortu" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-800 placeholder-gray-400"
                    placeholder="Masukkan nama orang tua">
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block mb-2 font-bold text-gray-700 text-sm">
                    Alamat
                </label>
                <textarea name="alamat" rows="2" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-800 placeholder-gray-400"
                    placeholder="Masukkan alamat"></textarea>
            </div>

            {{-- No HP --}}
            <div>
                <label class="block mb-2 font-bold text-gray-700 text-sm">
                    No HP
                </label>
                <input type="text" name="no_hp" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-800 placeholder-gray-400"
                    placeholder="08xxxxxxxxx">
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label class="block mb-2 font-bold text-gray-700 text-sm">
                    Tanggal Lahir
                </label>
                <input type="date" name="tgl_lahir" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-800">
            </div>

            {{-- Cabang --}}
            <div class="md:col-span-2">
                <label class="block mb-2 font-bold text-gray-700 text-sm">
                    Cabang Ebony Preschool
                </label>
                <select name="cabang_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-700">
                    <option value="">-- Pilih Cabang Terdekat --</option>
                    @foreach(\App\Models\Cabang::all() as $cb)
                        <option value="{{ $cb->id }}">{{ $cb->nama_cabang }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol --}}
            <div class="md:col-span-2 mt-2">
                <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 rounded-lg transition duration-300 text-sm tracking-wide">
                    Daftar
                </button>
            </div>

        </form>
    </div>

</body>
</html>