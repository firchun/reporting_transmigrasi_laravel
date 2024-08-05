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
            ;
            border: none;
            border-top: 2px dashed #000;
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
                        PEMERINTAH KABUPATEN MERAUKE<br>
                        <h4>DINAS TRANSMIGRASI DAN PEKERJAAN UMUM</h4>

                    </b>
                    Jl. Ermasu no. 1, Merauke, 99613

                </td>
                <td style="width: 20%"></td>
            </tr>
        </table>
        <hr>
        <center>
            <h4>
                Laporan Data Tenaga Asing
            </h4>
        </center>
        <hr>
        <br>
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 100px;">Tanggal</th>
                    <th>Perusahaan</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Kebangsaan</th>
                    <th>Jabatan</th>
                    <th>No. Passport</th>
                    <th>No. Kitas</th>
                    <th>No. Imta</th>
                    <th>Sponsor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->kebangsaan }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->no_passport }}</td>
                        <td>{{ $item->no_kitas }}</td>
                        <td>
                            <ol>
                                @foreach (App\Models\Imta::where('id_tenaga_asing', $item->id)->get() as $item)
                                    <li>{{ $item->no_imta }}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td>{{ $item->sponsor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </main>

</body>

</html>
