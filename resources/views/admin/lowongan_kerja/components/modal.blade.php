<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formUpdateCustomerId" name="id">
                    <input type="hidden" id="formUpdateCustomerIdPerusahaan" name="id_perusahaan">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Upload Brosur </label>
                        <input type="file" class="form-control" id="formCustomerName" name="brosur">
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Posisi/Jabatan </label>
                        <input type="text" class="form-control" id="formUpdateCustomerPosisi" name="posisi"
                            required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formCustomerName" class="form-label">Tanggal Pembukaan </label>
                                <input type="date" class="form-control" id="formUpdateCustomerTanggalBuka"
                                    name="tanggal_buka" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formCustomerName" class="form-label">Tanggal Penutupan </label>
                                <input type="date" class="form-control" id="formUpdateCustomerTanggalTutup"
                                    name="tanggal_tutup" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Kualifikasi</label>
                        <textarea class="form-control" id="formUpdateCustomerKualifikasi" name="kualifikasi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Persyaratan</label>
                        <textarea class="form-control" id="formUpdateCustomerPersyaratan" name="persyaratan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Pengiriman Berkas</label>
                        <textarea class="form-control" name="pengiriman_berkas" id="formUpdateCustomerPengrimanBerkas"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi Pekerjaan</label>
                        <textarea class="form-control" name="deskripsi_pekerjaan" id="formUpdateCustomerDeskripsiPekerjaan"></textarea>
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
                <h5 class="modal-title" id="userModalLabel">User Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <input type="hidden" name="id_perusahaan" value="{{ $perusahaan->id }}">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Upload Brosur </label>
                        <input type="file" class="form-control" id="formCustomerName" name="brosur">
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Posisi/Jabatan </label>
                        <input type="text" class="form-control" id="formCustomerName" name="posisi"
                            placeholder="Jabatan" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formCustomerName" class="form-label">Tanggal Pembukaan </label>
                                <input type="date" class="form-control" id="formCustomerName" name="tanggal_buka"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formCustomerName" class="form-label">Tanggal Penutupan </label>
                                <input type="date" class="form-control" id="formCustomerName"
                                    name="tanggal_tutup" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Kualifikasi</label>
                        <textarea class="form-control" name="kualifikasi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Persyaratan</label>
                        <textarea class="form-control" name="persyaratan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Pengiriman Berkas</label>
                        <textarea class="form-control" name="pengiriman_berkas"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi Pekerjaan</label>
                        <textarea class="form-control" name="deskripsi_pekerjaan"></textarea>
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
