@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        Form Pendaftaran Perusahaan
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $perusahaan->id }}">
                        <div class="mb-3">
                            <label for="">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="form-control" placeholder="Nama Perusahaan"
                                value="{{ $perusahaan->nama_perusahaan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Nomor HP/WA Perusahaan</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $perusahaan->no_hp }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Usaha / Sektor Perusahaan</label>
                            <input type="text" name="jenis_usaha" class="form-control"
                                placeholder="Jenis Usaha Perusahaan" value="{{ $perusahaan->jenis_usaha }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control" min="1900"
                                max="{{ date('Y') }}" placeholder="Masukkan tahun"
                                value="{{ $perusahaan->tahun_berdiri }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Alamat Perusahaan</label>
                            <textarea name="alamat_perusahaan" class="form-control" required>{{ $perusahaan->alamat_perusahaan }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Perbarui Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
