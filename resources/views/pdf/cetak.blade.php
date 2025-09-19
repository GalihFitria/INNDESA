<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Produk Terjual / Tahun</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: black;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Semua blok utama agar center */
        .header,
        .header-line,
        .content,
        .signature {
            width: 80%;
            /* lebar konten */
            max-width: 180mm;
            /* batasi biar proporsional di A4 */
            margin: 0 auto;
            /* selalu center */
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 5mm;
            justify-content: flex-start;
        }

        .header img {
            width: 60mm;
            height: auto;
            margin-right: 3mm;
        }

        .header-line {
            border-bottom: 1px solid #000000;
            margin-bottom: 3mm;
        }

        h1 {
            text-align: center;
            font-size: 14px;
            margin: 0 0 5mm 0;
            font-weight: bold;
        }

        .content {
            margin-top: 5mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            border: 1px solid #000000;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 4px;
            text-align: center;
        }

        th {
            background-color: #D3D3D3;
            font-weight: bold;
            text-transform: uppercase;
        }

        .signature {
            border: none;
            margin-top: 15mm;
            text-align: right;
        }

        .signature td {
            border: none;
            text-align: right;
            color: #000000;
        }

        .signature p {
            margin: 1px 0;
            font-size: 12px;
        }

        @media print {
            body {
                margin: 0;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/LOGO INNDESA.png') }}" alt="Logo INNDESA">
    </div>

    <div class="header-line"></div>

    <h1>Laporan Penjualan Produk Per-Tahun</h1>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun</th>
                    <th>Nama Kelompok</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Produk Terjual</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produks_pertahun as $index => $produk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $produk->tahun }}</td>
                    <td>{{ $produk->nama_kelompok }}</td>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>{{ $produk->produk_terjual }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Tidak ada data tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <table class="signature">
        <tr>
            <td>
                <p>Cilacap, {{ now()->format('d F Y') }}</p>
                <p>Menyetujui,</p>
                <br><br><br><br><br><br><br>
                <p>(___________________________)</p>
            </td>
        </tr>
    </table>
</body>

</html>