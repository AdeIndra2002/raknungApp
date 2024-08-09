<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Pengadaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/logokalsel.png') }}">
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: Calibri, sans-serif;
        }

        .sheet {
            padding: 8mm;
        }

        .header {
            text-align: left;
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

    </style>

</head>

<body>
    <section class="sheet">
        <!-- Header/Kop Surat -->
        <div class="header">
            <!-- Logo -->
            <img src="{{ asset('images/logo-bawaslu.png') }}" alt="Logo" style="width: 90px; height: auto; float: left; margin-left: 10px; margin-right: 10px;">
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

        <h1 style="text-align: center;">LAPORAN PENGADAAN DIVISI</h1>
        @if ($pengajuan->isEmpty())
        <div class="no-data">
            <p>Data pengadaan tidak tersedia.</p>
        </div>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">No. Surat</th>
                    <th class="text-center align-middle">Nama Pengaju</th>
                    <th class="text-center align-middle">Tanggal Pengajuan</th>
                    <th class="text-center align-middle">Nama & Jumlah Barang</th>
                    <th class="text-center align-middle">Divisi Pengaju</th>
                    <th class="text-center align-middle">Status</th>
                    <th class="text-center align-middle">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($pengajuan as $data)
                <tr>
                    <td class="text-center align-middle">{{ $no }}</td>
                    <td class="text-center align-middle">{{ $data->no_surat }}</td>
                    <td class="text-center align-middle">{{ $data->nama_pengaju }}</td>
                    <td class="text-center align-middle">{{ $data->tanggal_pengajuan }}</td>
                    <td class="px-4 py-3">
                        @foreach ($data->pengajuanBarang as $barang)
                        {{ $barang->barang->barang }} - {{ $barang->jumlah }}
                        @if (!$loop->last)
                        @endif
                        @endforeach
                    </td>
                    <td class="text-center align-middle">{{ $data->divisi->nama_divisi }}</td>
                    <td class="text-center align-middle">{{ $data->status }}</td>
                    <td class="text-center align-middle">{{ $data->note }}</td>
                </tr>
                @php $no++; @endphp
                @endforeach
            </tbody>
        </table>
        @endif

        <div style="margin-top: 20px;">
            <div style="float: right; width: 40%;">
                <p>
                    Banjarmasin,
                    @php
                    // Array mapping English month names to Indonesian
                    $monthNames = [
                    'January' => 'Januari',
                    'February' => 'Februari',
                    'March' => 'Maret',
                    'April' => 'April',
                    'May' => 'Mei',
                    'June' => 'Juni',
                    'July' => 'Juli',
                    'August' => 'Agustus',
                    'September' => 'September',
                    'October' => 'Oktober',
                    'November' => 'November',
                    'December' => 'Desember',
                    ];
                    // Get current date and time
                    $currentDate = date('d F Y');
                    // Translate day and month names to Indonesian
                    foreach ($monthNames as $english => $indonesian) {
                    $currentDate = str_replace($english, $indonesian, $currentDate);
                    }
                    echo $currentDate;
                    @endphp
                    <br>Mengetahui
                </p>
                <br>
                <br>
                <p>
                    <b><u>Aries Mardiono, M.Sos</u></b>
                </p>
            </div>
        </div>

    </section>
</body>

</html>
