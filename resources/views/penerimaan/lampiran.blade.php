<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lampiran Penerimaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/logokalsel.png') }}">
    <style>
        body {
            font-family: Calibri, sans-serif;
        }

        .sheet {
            padding: 8mm;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 18px;
            margin-top: 20px;
        }

        .table {
            background-color: transparent;
            /* Membuat latar belakang tabel menjadi transparan */
            font: normal 13px Arial, sans-serif;
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            /* Menghilangkan batas antar sel */
        }

        .table th,
        .table td {
            border: none;
            /* Menghilangkan batas pada sel */
            padding: 5px;
            text-align: center;
            text-shadow: 1px 1px 1px #fff;
        }

        .table thead th {
            padding: 5px;
            background-color: #DDEFEF;
            color: #336B6B;
        }

        .table tbody tr:nth-child(even) {
            background-color: rgba(221, 238, 239, 0.5);
            /* Memberi warna latar belakang transparan untuk baris-genap */
        }

        .table tbody tr:nth-child(odd) {
            background-color: rgba(221, 238, 239, 0.3);
            /* Memberi warna latar belakang transparan untuk baris-ganjil */
        }

        .left-align {
            text-align: left;
        }

        .page-break {
            page-break-before: always;
        }

    </style>

</head>

<body>
    <section class="sheet">
        <!-- Header/Kop Surat -->
        <div class="header">
            <!-- Logo -->
            <img src="{{ asset('images/logo-bawaslu.png') }}" alt="Logo" style="width: 90px; height: auto; float: left; margin-right: 1px;">
            <!-- Informasi Organisasi -->
            <div style="float: left;">
                <h2 style="margin: 0; font-size: 18px;"><b>Badan Pengawas Pemilihan Umum Provinsi Kalimantan Selatan</b></h2>
                <p style="margin: 5px 0;">Jl. RE Martadinata No.3, Kertak Baru Ilir, Kec. Banjarmasin Tengah,</p>
                <p style="margin: 5px 0;">Kota Banjarmasin, Kalimantan Selatan 70231</p>
                <p style="margin: 5px 0;">Telepon: (0511) 6726 437 | Email: set.kalsel@gmail.go.id</p>
            </div>
            <!-- Clearfix untuk mengatasi float -->
            <div class="clearfix"></div>
            <hr style="border-top: 3px solid black; margin-top: 10px; margin-bottom: 10px;">
        </div>

        <h1 class="text-center">LAMPIRAN PENERIMAAN BARANG</h1>

        <div class="content">
            <p>Dokumen ini berisi informasi mengenai barang yang diterima berdasarkan permintaan dari pengaju. Berikut adalah rincian penerimaan barang yang telah diajukan oleh {{ $penerimaan->pembelian->pengajuan->nama_pengaju }}:</p>

            <p>Tanggal Penerimaan : {{ \Carbon\Carbon::parse($penerimaan->created_at)->translatedFormat('d F Y') }}</p>
            <p>Nama Pengaju : {{ $penerimaan->pembelian->pengajuan->nama_pengaju }}</p>
            <p>Divisi : {{ $penerimaan->pembelian->pengajuan->divisi->nama_divisi }}</p>
            <p>Supplier & Alamat :
                <table>
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gambarPembelian as $gp)
                        <tr>
                            <td> {{ $gp->supplier->nama_supplier }}</td>
                            <td>{{$gp->supplier->alamat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuanBarang as $p)
                    <tr>
                        <td>{{ $p->barang->barang }}</td>
                        <td>{{ $p->jumlah }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p>dengan total harga : <b>Rp {{ number_format($penerimaan->pembelian->total_harga, 0, ',', '.') }}</b></p>
            <p>Demikian lampiran penerimaan barang ini dibuat.</p>
        </div>

        <div style="margin-top: 20px;">
            <div style="float: right; width: 40%;">
                <p class="text-center align-middle">
                    Banjarmasin, {{ \Carbon\Carbon::parse($penerimaan->created_at)->translatedFormat('d F Y') }}
                    <br>Mengetahui
                </p>
                <br>
                <br>
                <p class="text-center align-middle">
                    <b><u>{{ $user }}</u></b>
                    <br><b>Pimpinan</b>
                </p>
            </div>
        </div>
    </section>
</body>

</html>
