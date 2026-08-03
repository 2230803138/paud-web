<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f6ff;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
            margin-top:50px;
        }

        .card-header{
            background:linear-gradient(135deg,#8b5cf6,#ec4899);
            color:white;
            font-size:20px;
            font-weight:bold;
        }

        .btn-purple{
            background:#8b5cf6;
            color:white;
        }

        .btn-purple:hover{
            background:#7c3aed;
            color:white;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="card">

        <div class="card-header">
            Tambah Pembayaran SPP
        </div>

        <div class="card-body">

            <form action="{{ route('pembayaran.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>

                    <select name="siswa_id" class="form-select" required>

                        <option value="">-- Pilih Siswa --</option>

                        @foreach($siswa as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->nama }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">

                    <label class="form-label">Bulan</label>

                    <select name="bulan" class="form-select">

                        <option>Januari</option>
                        <option>Februari</option>
                        <option>Maret</option>
                        <option>April</option>
                        <option>Mei</option>
                        <option>Juni</option>
                        <option>Juli</option>
                        <option>Agustus</option>
                        <option>September</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Desember</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">Tahun</label>

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        value="{{ date('Y') }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Nominal</label>

                    <input
                        type="number"
                        name="nominal"
                        class="form-control"
                        placeholder="500000"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="Belum Lunas">Belum Lunas</option>
                        <option value="Lunas">Lunas</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">Tanggal Bayar</label>

                    <input
                        type="date"
                        name="tanggal_bayar"
                        class="form-control">

                </div>

                <button type="submit" class="btn btn-purple">
                    💾 Simpan Pembayaran
                </button>

                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>