@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label ">
                        <h5 class="card-title mb-0">{{ $title ?? 'Title' }}</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class=" btn-group " role="group">
                            <button class="btn btn-secondary refresh btn-default" type="button">
                                <span>
                                    <i class="bx bx-sync me-sm-1"> </i>
                                    <span class="d-none d-sm-inline-block">Refresh Data</span>
                                </span>
                            </button>

                        </div>
                    </div>
                </div>
                <hr>
                <div style="margin-left:24px; margin-right: 24px;">
                    <strong>Filter Data</strong>
                    <div class="d-flex justify-content-center align-items-center row gap-3 gap-md-0">
                        <div class="col-md-8 col-12">
                            <div class="input-group">
                                <span class="input-group-text">Perusahaan</span>
                                <select id="selectPerusahaan" name="id_perusahaan" class="form-select">
                                    <option value="">Semua</option>
                                    @foreach (App\Models\Perusahaan::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_perusahaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 ">
                            <button type="button" id="filter" class="btn btn-primary"><i class="bx bx-filter"></i>
                                Filter</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-datatable table-responsive">
                    <table id="datatable-tkl" class="table table-hover table-bordered display table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Perusahaan</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>mulai kerja</th>
                                <th>status Karyawan</th>
                                <th>jabatan</th>
                                <th>No Kartu Kuning</th>
                                <th>Tenaga Kerja</th>
                                <th>Tempat lahir</th>
                                <th>tanggal lahir</th>
                                <th>Pendidikan</th>
                                <th>LPTKS</th>

                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Perusahaan</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>mulai kerja</th>
                                <th>status Karyawan</th>
                                <th>jabatan</th>
                                <th>No Kartu Kuning</th>
                                <th>Tenaga Kerja</th>
                                <th>Tempat lahir</th>
                                <th>tanggal lahir</th>
                                <th>Pendidikan</th>
                                <th>LPTKS</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            @if (Auth::user()->role = 'Admin')
                var table = $('#datatable-tkl').DataTable({
                    processing: true,
                    serverSide: false,
                    responsive: true,
                    ajax: '{{ url('all-tkl-datatable') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data, type, full, meta) {
                                return moment(data).format('DD MMMM YYYY');
                            }
                        },
                        {
                            data: 'perusahaan.nama_perusahaan',
                            name: 'perusahaan.nama_perusahaan'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },

                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
                        },
                        {
                            data: 'mulai_kerja',
                            name: 'mulai_kerja'
                        },
                        {
                            data: 'status_karyawan',
                            name: 'status_karyawan'
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan'
                        },
                        {
                            data: 'no_kartu_kuning',
                            name: 'no_kartu_kuning'
                        },
                        {
                            data: 'tenaga_kerja',
                            name: 'tenaga_kerja'
                        },
                        {
                            data: 'tempat_lahir',
                            name: 'tempat_lahir'
                        },
                        {
                            data: 'tanggal_lahir',
                            name: 'tanggal_lahir'
                        },
                        {
                            data: 'pendidikan.nama_pendidikan',
                            name: 'pendidikan.nama_pendidikan'
                        },
                        {
                            data: 'LPTKS',
                            name: 'LPTKS'
                        },

                    ],
                    dom: 'lBfrtip',
                    buttons: [{
                            extend: 'pdf',
                            text: '<i class="bx bxs-file-pdf"></i> PDF',
                            className: 'btn-danger mx-3',
                            orientation: 'potrait',
                            title: '{{ $title }}',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: ':visible'
                            },
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8;
                                doc.styles.tableHeader.fontSize = 8;
                                doc.styles.tableHeader.fillColor = '#2a6908';


                            },
                            header: true
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="bx bxs-file-export"></i> Excel',
                            className: 'btn-success',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                    ]
                });
            @else
                var table = $('#datatable-tkl').DataTable({
                    processing: true,
                    serverSide: false,
                    responsive: true,
                    ajax: '{{ url('all-tkl-datatable') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },

                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data, type, full, meta) {
                                return moment(data).format('DD MMMM YYYY');
                            }
                        },
                        {
                            data: 'perusahaan.nama_perusahaan',
                            name: 'perusahaan.nama_perusahaan'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },

                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
                        },
                        {
                            data: 'mulai_kerja',
                            name: 'mulai_kerja'
                        },
                        {
                            data: 'status_karyawan',
                            name: 'status_karyawan'
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan'
                        },
                        {
                            data: 'no_kartu_kuning',
                            name: 'no_kartu_kuning'
                        },
                        {
                            data: 'tenaga_kerja',
                            name: 'tenaga_kerja'
                        },
                        {
                            data: 'tempat_lahir',
                            name: 'tempat_lahir'
                        },
                        {
                            data: 'tanggal_lahir',
                            name: 'tanggal_lahir'
                        },
                        {
                            data: 'pendidikan.nama_pendidikan',
                            name: 'pendidikan.nama_pendidikan'
                        },
                        {
                            data: 'LPTKS',
                            name: 'LPTKS'
                        },

                    ]
                });
            @endif
            $('.refresh').click(function() {
                $('#datatable-tkl').DataTable().ajax.reload();
            });
            $('#filter').click(function() {
                table.ajax.url('{{ url('all-tkl-datatable') }}?perusahaan=' + $(
                        '#selectPerusahaan')
                    .val()).load();
            });
        })
    </script>
    <!-- JS DataTables Buttons -->
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
@endpush
