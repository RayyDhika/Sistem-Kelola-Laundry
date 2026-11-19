 <!-- MODAL EDIT -->
    @foreach($outlets as $o)

        <div class="modal fade" id="modalEdit{{ $o->id }}" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header border-0 pb-0">

                        <h5 class="modal-title fw-bold">
                            EDIT OUTLET
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                    </div>

                    <hr class="mx-2" style="color: #aec6eb">

                    <form action="{{ route('outlet.update', $o->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="modal-body px-4">

                            <div class="mb-3 row">

                                <label class="col-sm-3 form-label-blue mt-2">
                                    Nama Outlet :
                                </label>

                                <div class="col-sm-9">
                                    <input type="text" name="nm_outlet" value="{{ $o->nm_outlet }}" class="form-control"
                                        required>
                                </div>

                            </div>

                            <div class="mb-3 row">

                                <label class="col-sm-3 form-label-blue mt-2">
                                    No TLP :
                                </label>

                                <div class="col-sm-9 d-flex gap-2">
                                    <!-- nomor -->
                                    <input type="text" 
                                            name="no_telp" 
                                            value="{{ $o->no_telp }}" 
                                            class="form-control telepon-edit" 
                                            required>

                                </div>

                            </div>

                            <div class="mb-3 row">

                                <label class="col-sm-3 form-label-blue mt-2">
                                    Alamat :
                                </label>

                                <div class="col-sm-9">
                                    <textarea name="alamat" class="form-control" rows="3"
                                        required>{{ $o->alamat }}</textarea>
                                </div>

                            </div>

                            <input type="hidden" name="owner" value="{{ $o->owner }}">

                        </div>

                        <div class="modal-footer border-0">

                            <button type="button" class="btn-batal" data-bs-dismiss="modal">
                                BATAL
                            </button>

                            <button type="submit" class="btn-simpan">
                                SIMPAN
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    @endforeach