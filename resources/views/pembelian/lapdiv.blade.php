<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Pembelian</title>
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
            font: normal 13px Arial, sans-serif;
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: none;
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
        }

        .table tbody tr:nth-child(odd) {
            background-color: rgba(221, 238, 239, 0.3);
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

        <h1 style="text-align: center;">LAPORAN PEMBELIAN
            @if (empty($divisiId))
            {{ strtoupper($divisiName) }} {{ strtoupper($statusNamae) }}
            @else
            DIVISI {{ strtoupper($divisiName) }} {{ strtoupper($statusNamae) }}
            @endif
        </h1>

        <div class="content">
            @if ($pembelian->isEmpty())
            <div class="no-data">
                <p>Data pengadaan tidak tersedia.</p>
            </div>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nama Pengaju</th>
                        <th class="text-center align-middle">Divisi Pengaju</th>
                        <th class="text-center align-middle">Total Harga</th>
                        <th class="text-center align-middle">Status</th>
                        @if($pembelian->contains ('status','Gagal'))
                        <th class="text-center align-middle">Catatan</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pembelian as $data)
                    <tr>
                        <td class="text-center align-middle">{{ $no }}</td>
                        <td class="text-center align-middle">{{ $data->pengajuan->nama_pengaju }}</td>
                        <td class="text-center align-middle">{{ $data->pengajuan->divisi->nama_divisi }}</td>
                        <td class="text-center align-middle">{{ $data->total_harga }}</td>
                        <td class="text-center align-middle">{{ $data->status }}</td>
                        @if($data->status === 'Gagal')
                        <td class="text-center align-middle">{{ $data->note }}</td>
                        @endif
                    </tr>
                    @php $no++; @endphp
                    @endforeach
                </tbody>
            </table>
            @if (empty($divisiId) && empty($selected_status))
            <div class="status-explanation">
                <h2>Keterangan:</h2>
                <p>Laporan pembelian ini diambil dari semua <strong>Divisi</strong> dan semua <strong>Status</strong> yang ada di database.</p>
            </div>
            @endif

            @if ($statusNamae === 'Selesai')
            <div class="status-explanation">
                <h2>Keterangan:</h2>
                <p>Pembelian dengan status <strong>Selesai</strong> berarti proses pengadaan telah selesai dan semua tahapan administrasi telah dilaksanakan dengan baik. Ini menunjukkan bahwa barang atau layanan yang dibeli telah diterima dan diselesaikan sesuai dengan rencana pengadaan.</p>
            </div>
            @endif

            @if ($statusNamae === 'Gagal')
            <div class="status-explanation">
                <h2>Keterangan:</h2>
                <p>Pembelian dengan status <strong>Gagal</strong> berarti proses pengadaan gagal. Ini menunjukkan bahwa proses pengadaan gagal dan harus dilakukan kembali atau mencari jalan alternatif lain.</p>
            </div>
            @endif

            @if($statusNamae === 'Proses')
            <div class="status-explanation">
                <h2>Keterangan:</h2>
                <p>Pembelian dengan status <strong>Proses</strong> berarti proses pengadaan sedang berlangsung. Ini menunjukkan bahwa proses pengadaan sedang berlangsung mohon tunggu status selanjutnya.</p>
                </p>
            </div>
            @endif

            @endif
        </div>
        <div style="margin-top: 20px;">
            <div style="float: right; width: 40%;">
                <p>
                    Banjarmasin,
                    @php
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
                    $currentDate = date('d F Y');
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
