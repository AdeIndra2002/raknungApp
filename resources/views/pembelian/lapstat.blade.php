<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $fileName }}</title>
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

        <h1 style="text-align: center;">LAPORAN PENGADAAN
            @if ($selected_status == 'Selesai')
            SELESAI
            @elseif ($selected_status == 'Gagal')
            GAGAL
            @elseif ($selected_status == 'Proses')
            PROSES
            @endif</h1>


        @if ($pembelian->isEmpty())
        <div class="no-data">
            <p>Data pengadaan tidak tersedia.</p>
        </div>
        @else
        <div class="content">
            @if($pembelian->contains('status', 'Selesai'))
            <p>Kami sampaikan bahwa data pembelian yang ditampilkan saat ini merupakan data dengan status "Selesai." Data ini mencakup pembelian-pembelian yang telah disetujui dan selesai setelah melalui proses evaluasi dan penilaian yang cermat.</p>
            @endif
            @if($pembelian->contains('status', 'Gagal'))
            <p>Kami informasikan bahwa data pembelian yang ditampilkan saat ini merupakan data dengan status "Gagal." Data ini mencakup pembelian yang Gagal berdasarkan evaluasi dan pertimbangan yang telah dilakukan.</p>
            @endif
            @if($pembelian->contains('status', 'Proses'))
            <p>Kami sampaikan bahwa data pembelian yang ditampilkan saat ini adalah data dengan status "Proses." Data ini mencakup pembelian-pembelian yang saat ini masih dalam proses pembelian lebih lanjut.</p>
            <p>Status "Proses" menunjukkan bahwa pembelian tersebut belum selesai diproses dan masih memerlukan tindak lanjut atau verifikasi lebih lanjut sesuai dengan prosedur yang berlaku. Kami akan terus memantau dan mengupdate status pembelian ini hingga keputusan akhir diambil.</p>
            @endif
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
            @if($pembelian->contains('status', 'selesai'))
            <p>Informasi ini menunjukkan bahwa semua pembelian dalam laporan ini telah memenuhi kriteria dan persyaratan yang ditetapkan, dan selanjutnya akan diproses sesuai dengan prosedur dan kebijakan yang berlaku. Kami mengharapkan agar data ini digunakan sebagai acuan untuk pelaksanaan atau tindak lanjut yang diperlukan.</p>
            @endif
            @if($pembelian->contains('status', 'Gagal'))
            <p>Harap diperhatikan bahwa setiap penolakan disertai dengan catatan atau alasan yang relevan, yang dapat digunakan sebagai acuan untuk perbaikan atau tindakan lebih lanjut. Kami mendorong agar catatan tersebut diperhatikan dengan seksama guna memastikan kualitas dan kelengkapan pembelian di masa mendatang.</p>
            @endif
            @if($pembelian->contains('status', 'Proses'))
            <p>Kami menghargai kesabaran Anda dalam menunggu proses ini dan akan memberikan informasi lebih lanjut segera setelah pembelian diproses.</p>
            @endif
        </div>
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
