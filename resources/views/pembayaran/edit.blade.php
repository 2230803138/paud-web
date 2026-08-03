<!DOCTYPE html>
<html>
<head>
    <title>Edit Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6ff;
        }

        .card {
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            margin-top: 50px;
        }

        .card-header {
            background: linear-gradient(135deg, #7f5af0, #a78bfa);
            color: white;
            font-weight: bold;
        }

        .btn-purple {
            background: #7f5af0;
            color: white;
        }

        .btn-purple:hover {
            background: #6a45e6;
            color: white;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">
        <div class="card-header">
            Edit Pembayaran
        </div>

        <div class="card-body">

            <form action="/pembayaran/{{ $pembayaran->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-control" required>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}"
                                {{ $pembayaran->siswa_id == $s->id ? 'selected' : '' }}>
                                {{ $s->nama_anak }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Bulan</label>
                    <select name="bulan" class="form-control">
                        @foreach([
                            'Januari','Februari','Maret','April','Mei','Juni',
                            'Juli','Agustus','September','Oktober','November','Desember'
                        ] as $bulan)
                            <option value="{{ $bulan }}"
                                {{ $pembayaran->bulan == $bulan ? 'selected' : '' }}>
                                {{ $bulan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control"
                           value="{{ $pembayaran->tahun }}" required>
                </div>

                <div class="mb-3">
                    <label>Nominal</label>
                    <input type="number" name="nominal" class="form-control"
                           value="{{ $pembayaran->nominal }}" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Belum Lunas"
                            {{ $pembayaran->status == 'Belum Lunas' ? 'selected' : '' }}>
                            Belum Lunas
                        </option>

                        <option value="Lunas"
                            {{ $pembayaran->status == 'Lunas' ? 'selected' : '' }}>
                            Lunas
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar"
                           value="{{ $pembayaran->tanggal_bayar }}"
                           class="form-control">
                </div>

                <button class="btn btn-purple">Update</button>
                <a href="/pembayaran" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>