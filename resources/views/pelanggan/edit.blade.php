<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="text-primary fw-bold mb-4">EDIT PELANGGAN</h5>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-box">
                            <label class="form-label-blue">Nama Pelanggan</label>
                            <input type="text" id="edit_nama" name="nm_pelanggan" class="form-control" required>
                        </div>
                        <div class="section-box">
                            <label class="form-label-blue">No Telepon</label>
                            <input type="text" id="edit_telp" name="no_telp" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-box">
                            <label class="form-label-blue mb-2">Jenis Kelamin</label>
                            <div class="radio-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="edit_jk_l" name="jenis_kelamin"
                                        value="L">
                                    <label class="form-check-label">Laki-Laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="edit_jk_p" name="jenis_kelamin"
                                        value="P">
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="section-box">
                            <label class="form-label-blue">Alamat</label>
                            <textarea id="edit_alamat" name="alamat" class="form-control" rows="4" required></textarea>
                        </div>
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'owner')
                            <div class="section-box">
                                <label class="form-label-blue">Outlet</label>

                                <select id="edit_outlet" name="id_outlet" class="form-control" required>
                                    <option value="">Pilih Outlet</option>

                                    @foreach($outlets as $outlet)
                                        <option value="{{ $outlet->id }}">
                                            {{ $outlet->nm_outlet }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="button" class="btn-batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>