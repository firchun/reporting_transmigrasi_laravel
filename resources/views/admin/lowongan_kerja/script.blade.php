@push('js')
    <script>
        $(function() {
            $('#datatable-loker').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('lowongan-kerja-datatable', $perusahaan->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'brosur',
                        name: 'brosur'
                    },
                    {
                        data: 'tanggal_buka',
                        name: 'tanggal_buka'
                    },
                    {
                        data: 'tanggal_tutup',
                        name: 'tanggal_tutup'
                    },
                    {
                        data: 'posisi',
                        name: 'posisi'
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
                $('#datatable-loker').DataTable().ajax.reload();
            });
            window.editCustomer = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/lowongan-kerja/edit/' + id,
                    success: function(response) {
                        $('#formUpdateCustomerId').val(response.id);
                        $('#formUpdateCustomerIdPerusahaan').val(response.id);
                        $('#formUpdateCustomerPosisi').val(response.posisi);
                        $('#formUpdateCustomerTanggalBuka').val(response.tanggal_buka);
                        $('#formUpdateCustomerTanggalTutup').val(response.tanggal_tutup);
                        $('#formUpdateCustomerKualifikasi').val(response.kualifikasi);
                        $('#formUpdateCustomerPersyaratan').val(response.persyaratan);
                        $('#formUpdateCustomerPengrimanBerkas').val(response.pengiriman_berkas);
                        $('#formUpdateCustomerDeskripsiPekerjaan').val(response
                            .deskripsi_pekerjaan);
                        $('#customersModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveCustomerBtn').click(function() {
                var formData = $('#userForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/lowongan-kerja/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-loker').DataTable().ajax.reload();
                        $('#customersModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createCustomerBtn').click(function() {
                var formData = $('#createUserForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/lowongan-kerja/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#formCustomerName').val('');
                        $('#datatable-loker').DataTable().ajax.reload();
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
                        url: '/lowongan-kerja/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-loker').DataTable().ajax.reload();
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
