<div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content shadow-lg p-3">

            <div class="modal-header border-0 pb-0">

                <h5 class="modal-title fw-bold">
                    <i class="fa fa-edit me-2"></i>
                    EDIT DATA PAKET
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('paket.update', $p->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <!-- OUTLET -->
                    <div class="mb-3">

                        <label class="form-label">
                            Pilih Outlet
                        </label>

                        <select name="id_outlet"
                                class="form-select"
                                required>

                            @foreach($outlets as $outlet)

                            <option value="{{ $outlet->id }}"
                                {{ $p->id_outlet == $outlet->id ? 'selected' : '' }}>

                                {{ $outlet->nm_outlet }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- JENIS -->
                    <div class="mb-3">

                        <label class="form-label">
                            Jenis Paket
                        </label>

                        <select name="jenis"
                                class="form-select"
                                required>

                            <option value="kiloan"
                                {{ $p->jenis == 'kiloan' ? 'selected' : '' }}>
                                Kiloan
                            </option>

                            <option value="satuan"
                                {{ $p->jenis == 'satuan' ? 'selected' : '' }}>
                                Satuan
                            </option>

                        </select>

                    </div>

                    <!-- NAMA -->
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Paket
                        </label>

                        <input type="text"
                               name="nm_paket"
                               class="form-control"
                               value="{{ $p->nm_paket }}"
                               required>

                    </div>

                    <!-- HARGA -->
                    <div class="mb-3">

                        <label class="form-label">
                            Harga
                        </label>

                        <input type="number"
                               name="harga"
                               class="form-control"
                               value="{{ $p->harga }}"
                               required>

                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        BATAL

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        SIMPAN

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>