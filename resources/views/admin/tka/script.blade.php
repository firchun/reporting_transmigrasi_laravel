@push('js')
    <script>
        $(function() {
            $('#datatable-tka').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('tka-datatable', $perusahaan->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        data: 'no_kitas',
                        name: 'no_kitas'
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
@endpush
