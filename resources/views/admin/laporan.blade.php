<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 8px 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        @media print {
            body {
                margin: 0;
            }

            table {
                page-break-after: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            th {
                background-color: #f2f2f2 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <h2>Laporan Peminjaman Perpustakaan</h2>
    <a href="{{ url('/peminjaman') }}" class="btn btn-primary">Kembali</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Nama Anggota</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Dikembalikan</th>
                <th>Status</th>
                <th>Petugas</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->buku->judul }}</td>
                    <td>{{ $p->anggota->nama }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_kembali }}</td>
                    <td>{{ $p->tanggal_dikembalikan ?? '-' }}</td>
                    <td>{{ ucfirst($p->status) }}</td>
                    <td>{{ $p->petugasUser->username ?? '-' }}</td>
                    <td>Rp {{ number_format($p->denda, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align: center;">Dicetak pada: {{ date('d-m-Y H:i') }}</p>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>

</body>

</html>