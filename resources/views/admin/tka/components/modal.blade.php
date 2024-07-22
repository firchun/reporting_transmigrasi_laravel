<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Perbarui Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="updateTKAForm">
                    <input type="hidden" name="id" id="idData">
                    <input type="hidden" name="id_perusahaan" id="updateIdPerusahaan">
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="updateNama" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="updateJenisKelamin" name="jenis_kelamin">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Kebangsaan</label>
                        <input type="text" class="form-control" name="kebangsaan" id="updateKebangsaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" id="updateJabatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">No. Passport</label>
                        <input type="text" class="form-control" name="no_passport" id="updateNoPassport" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">No. KITAS</label>
                        <input type="text" class="form-control" name="no_kitas" id="updateNoKitas" required>
                    </div>
                    <div class="mb-3" id="updateImta">
                        <label for="formTKANama" class="form-label">No. IMTA</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="no_imta[]" id="updateNoImta" required>
                            <button type="button" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Sponsor</label>
                        <input type="text" class="form-control" name="sponsor" id="updateSponsor" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createTKAForm">
                    <input type="hidden" name="id_perusahaan" value="{{ $perusahaan->id ?? '' }}">
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Nama</label>
                        <input type="text" class="form-control " name="nama" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formTKANama" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formTKANama" class="form-label">Kebangsaan</label>
                                <input type="text" class="form-control" name="kebangsaan" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">No. Passport</label>
                        <input type="text" class="form-control" name="no_passport" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">No. KITAS</label>
                        <input type="text" class="form-control" name="no_kitas" required>
                    </div>
                    <div class="mb-3" id="createImta">
                        <label for="updateNoImta" class="form-label">No. IMTA</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="no_imta[]" required>
                            <button type="button" class="btn btn-sm btn-primary btn-tambah"><i
                                    class="bx bx-plus"></i></button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Sponsor</label>
                        <input type="text" class="form-control" name="sponsor" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
