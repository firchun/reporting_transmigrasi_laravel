<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Data Perusahaan</title>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" href="{{ public_path('css') }}/pdf/bootstrap.min.css" media="all" />
    <style>
        body {
            font-family: 'times new roman';
            font-size: 12px;
        }

        hr {
            margin: 1px;

            border: none;
            border-top: 2px solid #000;
        }

        tr {
            margin: 0 !important;
            padding: 0 !important;
        }

        .table-custom {
            border-collapse: collapse;
            width: 100%;
        }

        .table-custom tr,
        .table-custom th,
        .table-custom td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
    <link href="{{ public_path('img/logo.png') }}" rel="icon" type="image/png">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> --}}
</head>

<body>
    <main>
        <table style="font-size: 11px; width:100%; margin-bottom:10px;">
            <tr>
                <td style="width: 20%" class="text-center">
                    <img style="width: 80px;" src="{{ public_path('img') }}/merauke.png">
                </td>
                <td class="text-center" style="width: 80%">
                    <b>
                        <h6 class="m-0">PEMERINTAH KABUPATEN MERAUKE</h6>
                        <h4 class="m-0">DINAS TENAGA KERJA DAN TRANSMIGRASI</h4>
                        <i>Jalan Mayor Wiranto Merauke - Papua Selatan, Telpon (0971)321485, 321897</i><br>
                        <i>pos-el <a href="">disnakertrans.kabmerauke@gmail.com</a></i> Kode Pos 99613

                    </b>
                </td>
                <td style="width: 20%"></td>
            </tr>
        </table>
        <hr>
        <center>
            <h4>
                Laporan Data Perusahaan
            </h4>
        </center>
        <br>
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 100px;">Tanggal</th>
                    <th>Nama Perusahaan</th>
                    <th>Alamat Perusahaan</th>
                    <th>Tahun Berdiri</th>
                    <th>Jenis Usaha</th>
                    <th>Tenaga Kerja Asing</th>
                    <th>Tenaga Kerja Lokal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ $item->nama_perusahaan }}</td>
                        <td>{{ $item->alamat_perusahaan }}</td>
                        <td>{{ $item->tahun_berdiri }}</td>
                        <td>{{ $item->jenis_usaha }}</td>
                        <td>{{ App\Models\TenagaAsing::where('id_perusahaan', $item->id)->count() }}</td>
                        <td>{{ App\Models\TenagaLokal::where('id_perusahaan', $item->id)->count() }}</td>
                        <td>{{ $item->aktif == 1 ? 'Aktif' : 'Non-aktif' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </main>

</body>

</html>
