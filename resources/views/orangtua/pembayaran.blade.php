@extends('layouts.orangtua')

@section('title', 'Pembayaran SPP Anak')

@section('content')

<div class="space-y-6">

    @if(!$siswa)
        <div class="bg-red-50 border border-red-200 text-red-700 p-6 rounded-2xl text-center font-bold">
            <h2 class="text-2xl font-bold mb-2">Akun belum terhubung</h2>
            <p>Akun orang tua ini belum dikaitkan dengan data peserta didik. Silakan hubungi admin sekolah.</p>
        </div>
    @else
        <!-- Header Banner / Profile Card -->
        <div class="bg-gradient-to-r from-pink-500 via-fuchsia-500 to-purple-600 rounded-3xl p-8 shadow-xl shadow-pink-500/20 text-white relative overflow-hidden">
            <!-- Decorative circle overlay -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <span class="bg-white/20 text-white font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wider">
                        Administrasi & SPP Bulanan
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-tight mt-3">Pembayaran SPP Anak</h1>
                    
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 mt-4 text-sm text-pink-100 font-medium">
                        <span class="flex items-center gap-1.5">
                            👤 <strong>Nama:</strong> {{ $siswa->nama }}
                        </span>
                        <span class="hidden sm:inline text-pink-300">|</span>
                        <span class="flex items-center gap-1.5">
                            🏫 <strong>Kelas:</strong> {{ $siswa->kelas }}
                        </span>
                    </div>
                </div>
                
                <div class="bg-white/15 backdrop-blur-md border border-white/20 px-6 py-4 rounded-2xl shadow-inner text-center self-stretch sm:self-auto flex sm:flex-col justify-center items-center gap-1">
                    <span class="text-xs text-pink-200 font-bold uppercase tracking-wider">Tunggakan SPP</span>
                    <span class="text-3xl font-black text-white mt-1">{{ $pembayaran->where('status', 'Belum Lunas')->count() }} Tagihan</span>
                </div>
            </div>
        </div>

        <!-- Panduan Pembayaran SPP -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100 space-y-6">
            <div class="flex items-center gap-2">
                <div class="w-2 h-6 bg-pink-500 rounded-full"></div>
                <h3 class="text-xl font-bold text-gray-800">⚙️ Panduan Transfer Pembayaran SPP</h3>
            </div>
            
            <p class="text-sm text-gray-600 leading-relaxed">
                Untuk melunasi tagihan bulanan SPP anak Anda, silakan lakukan transfer bank ke rekening resmi Ebony Preschool berikut, kemudian kirim konfirmasi melalui WhatsApp Admin:
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Info Bank Card -->
                <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl flex items-center gap-4 hover:shadow-md transition duration-200">
                    <div class="text-4xl bg-white p-3 rounded-xl shadow-sm">🏦</div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Bank BCA</p>
                        <p class="font-black text-gray-800 text-xl tracking-wide">123-456-7890</p>
                        <p class="text-xs text-gray-500 mt-1 font-semibold">a.n. Yayasan Ebony Preschool</p>
                    </div>
                </div>
                
                <!-- Info WhatsApp Card -->
                <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl flex items-center gap-4 hover:shadow-md transition duration-200">
                    <div class="text-4xl bg-white p-3 rounded-xl shadow-sm">💬</div>
                    <div class="space-y-1">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Konfirmasi Pembayaran</p>
                        <p class="text-xs text-gray-500 font-medium">Kirimkan bukti bayar agar segera divalidasi oleh admin.</p>
                        <a href="https://wa.me/6283168627009?text=Halo%20Admin%20Ebony%20Preschool,%20saya%20ingin%20mengonfirmasi%20pembayaran%20SPP%20anak%20saya%20yang%20bernama%20{{ urlencode($siswa->nama) }}" 
                           target="_blank" 
                           class="inline-flex items-center gap-1.5 bg-green-500 hover:bg-green-600 text-white font-bold px-4 py-2 rounded-xl text-xs transition shadow-sm shadow-green-500/20 hover:scale-105 duration-200 mt-2">
                            <span>✅ Kirim Bukti Transfer (WhatsApp)</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-xs text-gray-500 bg-pink-50/40 p-4 rounded-2xl border border-pink-100/60 leading-relaxed">
                <strong>Catatan Penting:</strong> Harap mencantumkan nama anak pada kolom berita transfer. Bukti transfer wajib diunggah/dikirimkan ke nomor WhatsApp Admin di atas agar status tagihan anak dapat diperbarui menjadi <strong>Lunas</strong> di sistem.
            </div>
        </div>

        <!-- Tabel Log Transaksi SPP -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center gap-2 mb-6">
                <div class="w-2 h-6 bg-pink-500 rounded-full"></div>
                <h3 class="text-xl font-bold text-gray-800">Riwayat & Tagihan Pembayaran SPP</h3>
            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-pink-500 to-purple-500 text-white">
                            <th class="p-4 font-bold text-sm text-center w-16">No</th>
                            <th class="p-4 font-bold text-sm">Bulan / Tahun</th>
                            <th class="p-4 font-bold text-sm">Nominal SPP</th>
                            <th class="p-4 font-bold text-sm text-center">Tanggal Pembayaran</th>
                            <th class="p-4 font-bold text-sm text-center w-36">Status SPP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pembayaran as $index => $item)
                            <tr class="hover:bg-pink-50/20 transition">
                                <td class="p-4 text-center text-gray-400 font-bold text-sm">
                                    {{ $index + 1 }}
                                </td>
                                <td class="p-4 font-bold text-purple-700">
                                    🗓️ {{ $item->bulan }} / {{ $item->tahun }}
                                </td>
                                <td class="p-4 font-extrabold text-gray-800">
                                    Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-center">
                                    @if($item->tanggal_bayar)
                                        <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-700 px-3 py-1 rounded-full text-xs font-bold border border-purple-100">
                                            📅 {{ \Carbon\Carbon::parse($item->tanggal_bayar)->translatedFormat('d F Y') }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 font-medium">-</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    @if($item->status == 'Lunas')
                                        <span class="inline-flex items-center justify-center bg-green-100 text-green-700 font-extrabold px-3.5 py-1.5 rounded-xl text-xs shadow-sm border border-green-200">
                                            🟢 Lunas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center justify-center bg-red-100 text-red-700 font-extrabold px-3.5 py-1.5 rounded-xl text-xs shadow-sm border border-red-200">
                                            🔴 Belum Lunas
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-16 text-gray-400 font-medium">
                                    <div class="text-5xl mb-4">💰</div>
                                    <div class="text-lg font-bold text-gray-500">Belum Ada Riwayat SPP</div>
                                    <div class="text-sm text-gray-400 mt-1">Belum ada riwayat data transaksi pembayaran SPP anak terdaftar.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@endsection
