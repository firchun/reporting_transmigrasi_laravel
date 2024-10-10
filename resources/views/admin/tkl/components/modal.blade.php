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
                <form id="updateTKLForm">
                    <input type="hidden" id="updateId" name="id">
                    <input type="hidden" name="id_perusahaan" id="updateIdPerusahaan">
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="updateNama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="updateJenisKelamin">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Pendidikan Terakhir</label>
                        <select class="form-select" name="id_pendidikan" id="updateIdPendidikan">
                            @foreach (App\Models\Pendidikan::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_pendidikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Mulai Kerja</label>
                        <input type="date" class="form-control" name="mulai_kerja" id="updateMulaiKerja" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">No. Kartu Kuning</label>
                        <input type="text" class="form-control" name="no_kartu_kuning" id="updateNoKartuKuning"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Tenaga Kerja</label>
                        <select class="form-select" name="tenaga_kerja" id="updateTenagaKerja">
                            <option value="OAP">Orang Asli Papua</option>
                            <option value="NON-OAP">non-Orang Asli Papua</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Status Karyawan</label>
                        <select class="form-select" name="status_karyawan" id="updateStatusKaryawan">
                            <option value="Karyawan Tetap">Karyawan Tetap</option>
                            <option value="Karyawan Kontrak">Karyawan Kontrak</option>
                            <option value="Tenaga Ahli">Tenaga Ahli</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="formTKANama" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="updateTempatLahir"
                                    required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="formTKANama" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="updateTanggalLahir" name="tanggal_lahir"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" id="updateJabatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">LPTKS</label>
                        <select class="form-select" name="LPTKS" id="updateLPTKS">
                            <option value="Ada">Ada</option>
                            <option value="Tidak">Tidak</option>
                        </select>
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
                <form id="createTKLForm">
                    <input type="hidden" name="id_perusahaan" value="{{ $perusahaan->id ?? '' }}">
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required id="createNama">
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Pendidikan Terakhir</label>
                        <select class="form-select" name="id_pendidikan">
                            @foreach (App\Models\Pendidikan::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_pendidikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Mulai Kerja</label>
                        <input type="date" class="form-control" name="mulai_kerja" required
                            id="createMulaiKerja">
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">No. Kartu Kuning</label>
                        <input type="text" class="form-control" name="no_kartu_kuning" required
                            id="createNoKartuKuning">
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Tenaga Kerja</label>
                        <select class="form-select" name="tenaga_kerja">
                            <option value="OAP">Orang Asli Papua</option>
                            <option value="NON-OAP">non-Orang Asli Papua</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Status Karyawan</label>
                        <select class="form-select" name="status_karyawan">
                            <option value="Karyawan Tetap">Karyawan Tetap</option>
                            <option value="Karyawan Kontrak">Karyawan Kontrak</option>
                            <option value="Tenaga Ahli">Tenaga Ahli</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="formTKANama" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" required
                                    id="createTempatLahir">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="formTKANama" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" required
                                    id="createTanggalLahir">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" required id="createJabatan">
                    </div>
                    <div class="mb-3">
                        <label for="formTKANama" class="form-label">LPTKS</label>
                        <select class="form-select" name="LPTKS">
                            <option value="Ada">Ada</option>
                            <option value="Tidak">Tidak</option>
                        </select>
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
