<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Data Perusahaan</title>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" href="{{ public_path('css') }}/pdf/bootstrap.min.css" media="all" />
    <style>
        body {
            font-family: Arial, sans-serif;
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
        <table style=" width:100%; margin-bottom:10px;">
            <tr>
                <td style="width: 20%" class="text-center">
                    <img style="width: 80px;" src="{{ public_path('img') }}/merauke.png">
                </td>
                <td class="text-center" style="width: 80%">
                    <b>
                        <p class="m-0" style="font-size: 12px;"><b>PEMERINTAH KABUPATEN MERAUKE</b></p>
                        <p class="m-0" style="font-size: 14px;"><b>DINAS TENAGA KERJA DAN TRANSMIGRASI</b></p>
                        <i style="font-size: 10px;">Jalan Mayor Wiranto Merauke - Papua Selatan, Telpon
                            (0971)321485,
                            321897</i><br>
                        <span style="font-size: 10px;"><i>pos-el <a
                                    href="">disnakertrans.kabmerauke@gmail.com</a></i>
                            Kode Pos 99613</span>

                    </b>
                </td>
                <td style="width: 20%"></td>
            </tr>
        </table>
        <hr>
        <center>
            <p class="font-weight:bold;">
                Detail Lowongan Pekerjaan pada {{ $data->perusahaan->nama_perusahaan }}
            </p>
        </center>
        <br>
        <table class="table-custom">
            <tr>
                <td><strong>Perusahaan</strong></td>
                <td>{{ $data->perusahaan->nama_perusahaan }}<br><small>{{ $data->perusahaan->alamat_perusahaan }}</small>
                </td>
            </tr>
            <tr>
                <td><strong>Tanggal Pendaftaran</strong></td>
                <td>{{ $data->tanggal_buka }} sampai {{ $data->tanggal_tutup }}
                </td>
            </tr>
            <tr>
                <td><strong>Posisi</strong></td>
                <td>{{ $data->posisi }}
                </td>
            </tr>
            <tr>
                <td><strong>Deksripsi Pekerjaan</strong></td>
                <td>{{ $data->deskripsi_pekerjaan }}
                </td>
            </tr>
            <tr>
                <td><strong>Kualifikasi Pekerja</strong></td>
                <td>{{ $data->kualifikasi }}
                </td>
            </tr>

            <tr>
                <td><strong>Pengiriman Berkas</strong></td>
                <td>{{ $data->pengiriman_berkas }}
                </td>
            </tr>
            <tr>
                <td><strong>Brosur Lowongan perkerjaan</strong></td>
                <td>
                    <img src="{{ $data->brosur != null || $data->bsosur != '' ? storage_path('app/public/' . $data->brosur) : '' }}"
                        alt="brosur" style="width: 80%;">
                </td>
            </tr>
        </table>


    </main>

</body>

</html>
