<div class="modal fade" id="modalEditUser{{ $u->id }}" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->
            <div class="modal-header">

                <h5 class="modal-title fw-bold text-primary">
                    Edit Pengguna
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <!-- FORM -->
            <form action="{{ route('user.update', $u->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row">

                        <!-- NAMA -->
                        <div class="col-md-6 mb-3" style="font-family: Arial, Helvetica, sans-serif">

                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input type="text" name="name" class="form-control" value="{{ $u->name }}" required>

                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 mb-3" style="font-family: Arial, Helvetica, sans-serif">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email" name="email" class="form-control" value="{{ $u->email }}" required>

                        </div>

                        <!-- TELEPON -->
                        <div class="col-md-12 mb-3" style="font-family: Arial, Helvetica, sans-serif">

                            <label class="form-label">
                                Nomor Telepon
                            </label>

                            <div class="d-flex gap-2">
                                <!-- nomor -->
                                <input type="text" name="telepon" id="telepon_edit{{ $u->id }}" class="form-control"
                                    value="{{ $u->telepon }}" placeholder="Masukan Nomor Telepon">

                            </div>

                        </div>

                        <!-- JK -->
                        <div class="col-md-6 mb-3" style="font-family: Arial, Helvetica, sans-serif">

                            <label class="form-label">
                                Jenis Kelamin
                            </label>

                            <select name="jk" class="form-select">

                                <option value="Laki - Laki" {{ $u->jk == 'Laki - Laki' ? 'selected' : '' }}>
                                    Laki - Laki
                                </option>

                                <option value="Perempuan" {{ $u->jk == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>

                            </select>

                        </div>

                        <!-- PASSWORD -->
                        <div class="col-md-6 mb-3" style="font-family: Arial, Helvetica, sans-serif">

                            <label class="form-label">
                                Password Baru
                            </label>

                            <div class="input-group">

                                <input type="password" name="password" id="passwordEdit{{ $u->id }}"
                                    class="form-control" placeholder="Kosongkan jika tidak diubah">

                                <span class="input-group-text" onclick="toggleEditPassword({{ $u->id }})"
                                    style="cursor:pointer;">

                                    <i class="fa fa-eye" id="eyeEdit{{ $u->id }}"></i>

                                </span>

                            </div>

                        </div>

                        <!-- OUTLET -->
                        <div class="col-md-6 mb-3" style="font-family: Arial, Helvetica, sans-serif">

                            <label class="form-label">Outlet</label>

                            @if($u->role == 'admin')

                                <input type="text" class="form-control" value="-" disabled>

                                <input type="hidden" name="id_outlet" value="">

                            @else

                                <select name="id_outlet" class="form-select">

                                    @foreach($outlets as $outlet)

                                        <option value="{{ $outlet->id }}" {{ $u->id_outlet == $outlet->id ? 'selected' : '' }}>

                                            {{ $outlet->nm_outlet }}

                                        </option>

                                    @endforeach

                                </select>

                            @endif

                        </div>

                        <!-- ROLE -->
                        <div class="col-md-6 mb-3" style="font-family: Arial, Helvetica, sans-serif">

                            <label class="form-label">Role</label>

                            @if($u->role == 'admin')

                                <input type="text" class="form-control" value="Admin" disabled>

                            @else

                                <select name="role" class="form-select">

                                    <option value="kasir" {{ $u->role == 'kasir' ? 'selected' : '' }}>
                                        Kasir
                                    </option>

                                    <option value="owner" {{ $u->role == 'owner' ? 'selected' : '' }}>
                                        Owner
                                    </option>

                                </select>

                            @endif

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit" class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>