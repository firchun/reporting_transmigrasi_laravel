@php
    $perusahaan = App\Models\Perusahaan::where('id_user', Auth::id());
@endphp
@if ($perusahaan->count() != 0)
    <div class="row justify-content-center">

        @include('admin.dashboard_component.card1', [
            'count' => $tka,
            'title' => 'TKA',
            'subtitle' => 'Tenaga Kerja Asing',
            'color' => 'warning',
            'icon' => 'user',
        ])
        @include('admin.dashboard_component.card1', [
            'count' => $tkl,
            'title' => 'TKL',
            'subtitle' => 'Tenaga Kerja Lokal',
            'color' => 'success',
            'icon' => 'user',
        ])
    </div>
@else
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        Form Pendaftaran Perusahaan
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="form-control"
                                placeholder="Nama Perusahaan" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Usaha / Sektor Perusahaan</label>
                            <input type="text" name="jenis_usaha" class="form-control"
                                placeholder="Jenis Usaha Perusahaan" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control" min="1900"
                                max="{{ date('Y') }}" placeholder="Masukkan tahun" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Alamat Perusahaan</label>
                            <textarea name="alamat_perusahaan" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
