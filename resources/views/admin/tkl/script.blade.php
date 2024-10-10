@push('js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script>
        $(function() {
            $('#datatable-tkl').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('tkl-datatable', $perusahaan->id) }}',
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
                        data: 'pendidikan.nama_pendidikan',
                        name: 'pendidikan.nama_pendidikan'
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
                $('#datatable-tkl').DataTable().ajax.reload();
            });
            window.editCustomer = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/tkl/edit/' + id,
                    success: function(response) {
                        $('#updateId').val(response.id);
                        $('#updateIdPerusahaan').val(response.id_perusahaan);
                        $('#updateIdPendidikan').val(response.id_pendidikan);
                        $('#updateNama').val(response.nama);
                        $('#updateJenisKelamin').val(response.jenis_kelamin);
                        $('#updateMulaiKerja').val(response.mulai_kerja);
                        $('#updateNoKartuKuning').val(response.no_kartu_kuning);
                        $('#updateTanagaKerja').val(response.tenaga_kerja);
                        $('#updateStatusKaryawan').val(response.status_karyawan);
                        $('#updateTempatLahir').val(response.tempat_lahir);
                        $('#updateTanggalLahir').val(response.tanggal_lahir);
                        $('#updateJabatan').val(response.jabatan);
                        $('#updateLPTKS').val(response.LPTKS);
                        $('#customersModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveCustomerBtn').click(function() {
                var formData = $('#updateTKLForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/tkl/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-tkl').DataTable().ajax.reload();
                        $('#customersModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createCustomerBtn').click(function() {
                var formData = $('#createTKLForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/tkl/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#datatable-tkl').DataTable().ajax.reload();
                        $('#createNama').val('');
                        $('#createMulaiKerja').val('');
                        $('#createNoKartuKuning').val('');
                        $('#createNoKartuKuning').val('');
                        $('#createTempatLahir').val('');
                        $('#createTanggalLahir').val('');
                        $('#createJabatan').val('');
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
                        url: '/tkl/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-tkl').DataTable().ajax.reload();
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
