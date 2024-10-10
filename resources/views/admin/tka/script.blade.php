@push('js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script>
        $(function() {
            $('#datatable-tka').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('tka-datatable', $perusahaan->id) }}',
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
                        render: function(data) {
                            return moment(data).format('DD MMMM YYYY');
                        }
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
                        data: 'kebangsaan',
                        name: 'kebangsaan'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'no_passport',
                        name: 'no_passport'
                    },
                    {
                        data: 'kitas',
                        name: 'kitas'
                    },
                    {
                        data: 'no_imta',
                        name: 'no_imta'
                    },
                    {
                        data: 'sponsor',
                        name: 'sponsor'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $('.create-new').click(function() {
                $('#create').modal('show');
            });
            $('.refresh').click(function() {
                $('#datatable-tka').DataTable().ajax.reload();
            });
            window.editCustomer = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/tka/edit/' + id,
                    success: function(response) {
                        $('#idData').val(response.id);
                        $('#updateIdPerusahaan').val(response.id_perusahaan);
                        $('#updateNama').val(response.nama);
                        $('#updateJenisKelamin').val(response.jenis_kelamin);
                        $('#updateKebangsaan').val(response.kebangsaan);
                        $('#updateJabatan').val(response.jabatan);
                        $('#updateNoPassport').val(response.no_passport);
                        $('#updateNoKitas').val(response.no_kitas);
                        $('#updateNoImta').val(response.no_imta);
                        $('#updateSponsor').val(response.sponsor);
                        $('#customersModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveCustomerBtn').click(function() {
                var formData = $('#updateTKAForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/tka/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-tka').DataTable().ajax.reload();
                        $('#customersModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createCustomerBtn').click(function() {
                var formData = $('#createTKAForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/tka/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#datatable-tka').DataTable().ajax.reload();
                        $('#createSponsor').val('');
                        $('#createTanggalKitas').val('');
                        $('#createNoKitas').val('');
                        $('#createNoPassport').val('');
                        $('#createJabatan').val('');
                        $('#createKebangsaan').val('');
                        $('#createNama').val('');
                        $('#createImta .input-group:gt(0)').remove();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteCustomers = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/tka/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-tka').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
        });
    </script>
    <script>
        $(document).ready(function() {
            // Tombol Tambah
            $('.btn-tambah').click(function() {
                var divParent = $(this).closest('#createImta');
                var newInput = divParent.find('.input-group:first').clone();
                newInput.find('input').val('');
                divParent.append(newInput);
                newInput.find('.btn-tambah').remove();
                divParent.find('.input-group').last().append(
                    '<button type="button" class="btn btn-sm btn-danger btn-hapus"><i class="bx bx-minus"></i></button>'
                );
            });

            // Tombol Hapus
            $(document).on('click', '.btn-hapus', function() {
                var divParent = $(this).closest('#createImta');
                if (divParent.find('.input-group').length > 1) {
                    $(this).closest('.input-group').remove();
                }
            });
        });
    </script>
@endpush
