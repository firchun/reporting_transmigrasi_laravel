@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $title }}</h3>
                    <hr>
                    <table class="table table-hover">
                        <tr>
                            <td><strong>Perusahaan</strong></td>
                            <td>{{ $loker->perusahaan->nama_perusahaan }}<br><small>{{ $loker->perusahaan->alamat_perusahaan }}</small>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Pendaftaran</strong></td>
                            <td>{{ $loker->tanggal_buka }} sampai {{ $loker->tanggal_tutup }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Posisi</strong></td>
                            <td>{{ $loker->posisi }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Deksripsi Pekerjaan</strong></td>
                            <td>{{ $loker->deskripsi_pekerjaan }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Kualifikasi Pekerja</strong></td>
                            <td>{{ $loker->kualifikasi }}
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Pengiriman Berkas</strong></td>
                            <td>{{ $loker->pengiriman_berkas }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Brosur Lowongan perkerjaan</strong></td>
                            <td>
                                <img src="{{ Storage::url($loker->brosur) }}" alt="brosur" style="width: 80%;">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
