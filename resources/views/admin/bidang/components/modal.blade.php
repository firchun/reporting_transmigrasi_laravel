<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Perbarui Pendidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formBidangId" name="id">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Name Bidang</label>
                        <input type="text" class="form-control" id="formCustomerNamaBidang" name="nama_bidang"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerPhone" class="form-label">Keterangan Bidang</label>
                        <input type="text" class="form-control" id="formCustomerKeteranganBidang"
                            name="keterangan_bidang" required>
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
                <form id="createUserForm">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Bidang</label>
                        <input type="text" class="form-control" id="formCustomerNamaBidang" name="nama_bidang"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerPhone" class="form-label">Keterangan Bidang</label>
                        <input type="text" class="form-control" id="formCustomerKeteranganBidang"
                            name="keterangan_bidang" value="-" required>
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
