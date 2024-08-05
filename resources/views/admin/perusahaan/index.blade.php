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
                <div class="card-datatable table-responsive">
                    <table id="datatable-perusahaan" class="table table-hover table-bordered display table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Perusahaan</th>
                                <th>Tahun Berdiri</th>
                                <th>Jenis Usaha</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Perusahaan</th>
                                <th>Tahun Berdiri</th>
                                <th>Jenis Usaha</th>
                                <th>Action</th>
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
            $('#datatable-perusahaan').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('perusahaan-datatable') }}',
                columns: [{
                        // Menampilkan nomor urut
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // +1 karena meta.row mulai dari 0
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, full, meta) {
                            return moment(data).format('DD MMMM YYYY');
                        }
                    },
                    {
                        data: 'nama_perusahaan',
                        name: 'nama_perusahaan'
                    },
                    {
                        data: 'alamat_perusahaan',
                        name: 'alamat_perusahaan'
                    },
                    {
                        data: 'tahun_berdiri',
                        name: 'tahun_berdiri'
                    },
                    {
                        data: 'jenis_usaha',
                        name: 'jenis_usaha'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },


                ],

            });

            $('.refresh').click(function() {
                $('#datatable-perusahaan').DataTable().ajax.reload();
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
