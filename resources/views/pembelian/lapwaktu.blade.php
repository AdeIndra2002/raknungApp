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

        <h1 style="text-align: center;">LAPORAN PEMBELIAN {{ strtoupper($periode) }}</h1>

        <div class="content">
            @if ($pembelian->isEmpty())
            <div class="no-data">
                <p>Data pengadaan tidak tersedia.</p>
            </div>
            @else
            @if($periode == 'hari')
            <p>Kami ingin menyampaikan bahwa data yang saat ini ditampilkan adalah data pembelian yang terperinci berdasarkan tanggal pembelian per hari. Informasi ini mencerminkan seluruh transaksi pembelian yang terjadi pada hari-hari tertentu, memberikan gambaran yang jelas mengenai aktivitas pembelian yang berlangsung dalam periode waktu yang bersangkutan.</p>
            <p>Data ini disusun untuk mempermudah pemantauan dan analisis aktivitas pembelian sehari-hari, serta untuk memastikan transparansi dan akurasi informasi terkait transaksi pembelian. Dengan cara ini, diharapkan dapat memberikan insight yang lebih mendalam dan mendukung pengambilan keputusan yang lebih tepat dalam pengelolaan pembelian.</p>
            @endif
            @if($periode == 'minggu')
            <p>Kami ingin memberitahukan bahwa data yang saat ini ditampilkan adalah data pembelian yang terorganisir berdasarkan periode mingguan. Informasi ini mencakup seluruh transaksi pembelian yang terjadi dalam setiap minggu, memberikan gambaran komprehensif tentang aktivitas pembelian yang berlangsung selama periode waktu tersebut.</p>
            <p>Data ini disajikan dalam format mingguan untuk mempermudah analisis tren pembelian, memantau pola pengeluaran, serta meningkatkan efisiensi dalam perencanaan dan pengelolaan sumber daya. Dengan pendekatan ini, diharapkan dapat memperoleh wawasan yang lebih mendalam dan mendukung proses pengambilan keputusan yang lebih baik dalam pengelolaan pembelian.</p>
            @endif
            @if($periode == 'bulan')
            <p>Kami ingin menginformasikan bahwa data yang saat ini ditampilkan adalah data pembelian yang dikategorikan berdasarkan periode bulanan. Informasi ini mencakup semua transaksi pembelian yang terjadi selama setiap bulan, memberikan pandangan menyeluruh mengenai aktivitas pembelian yang terjadi pada periode waktu tersebut.</p>
            <p>Dengan penyajian data dalam format bulanan, diharapkan dapat mempermudah analisis terhadap tren dan pola pengeluaran yang terjadi setiap bulan. Pendekatan ini bertujuan untuk mendukung pemantauan yang lebih efektif dan perencanaan yang lebih terarah dalam pengelolaan pembelian.</p>
            @endif
            @if($periode == 'tahun')
            <p>Kami ingin menyampaikan bahwa data yang saat ini ditampilkan adalah data pembelian yang disusun berdasarkan periode tahunan. Informasi ini mencakup seluruh transaksi pembelian yang terjadi dalam setiap tahun, memberikan gambaran menyeluruh mengenai aktivitas pembelian yang berlangsung sepanjang tahun tersebut.</p>
            <p>Penyajian data dalam format tahunan bertujuan untuk mempermudah analisis terhadap tren jangka panjang, evaluasi kinerja, dan perencanaan strategis. Dengan pendekatan ini, diharapkan dapat memperoleh wawasan yang lebih mendalam mengenai pola pembelian serta mendukung keputusan yang lebih informasional dalam pengelolaan pembelian.</p>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nama Pengaju</th>
                        <th class="text-center align-middle">Divisi Pengaju</th>
                        <th class="text-center align-middle">Total Harga</th>
                        <th class="text-center align-middle">Status</th>
                        <th class="text-center align-middle">Catatan</th>
                        <th class="text-center align-middle">Waktu Pembelian</th>
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
                        <td class="text-center align-middle">{{ $data->note }}</td>
                        <td class="text-center align-middle">{{ $data->created_at }}</td>
                    </tr>
                    @php $no++; @endphp
                    @endforeach
                </tbody>
            </table>
            @if($periode == 'tahun')
            <p>Kami siap memberikan penjelasan lebih lanjut atau menjawab pertanyaan yang mungkin timbul sehubungan dengan data yang disajikan.</p>
            @endif
            @if($periode == 'bulan')
            <p>Kami siap memberikan penjelasan lebih lanjut atau menjawab pertanyaan terkait data yang disajikan.</p>
            @endif
            @if($periode == 'minggu')
            <p>Kami siap memberikan penjelasan lebih lanjut atau menjawab pertanyaan yang mungkin timbul terkait data yang disajikan.</p>
            @endif
            @if($periode == 'hari')
            <p>Kami siap memberikan penjelasan lebih lanjut atau menjawab pertanyaan yang mungkin timbul sehubungan dengan data yang disajikan.</p>
            @endif
            @endif
        </div>

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
