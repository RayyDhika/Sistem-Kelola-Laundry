<div class="modal fade" id="modalEditUser{{ $u->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <!-- HEADER -->
            <div class="modal-header">

                <h5 class="modal-title fw-bold text-primary">

                    <i></i>
                    Edit Pengguna

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <!-- FORM -->
            <form action="{{ route('user.update', $u->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <!-- NAMA -->
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Lengkap
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ $u->name }}"
                               required>

                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $u->email }}"
                               required>

                    </div>

                    <!-- TELEPON -->
                    <div class="mb-3">

                        <label class="form-label">
                            Nomor Telepon
                        </label>

                        <input type="text"
                               name="telepon"
                               class="form-control"
                               value="{{ $u->telepon }}">

                    </div>

                    <!-- JK -->
                    <div class="mb-3">

                        <label class="form-label">
                            Jenis Kelamin
                        </label>

                        <select name="jk"
                                class="form-select">

                            <option value="Laki - Laki"
                                {{ $u->jk == 'Laki - Laki' ? 'selected' : '' }}>

                                Laki - Laki

                            </option>

                            <option value="Perempuan"
                                {{ $u->jk == 'Perempuan' ? 'selected' : '' }}>

                                Perempuan

                            </option>

                        </select>

                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">

                        <label class="form-label">
                            Password Baru
                        </label>

                        <div class="input-group">

                            <input type="password"
                                   name="password"
                                   id="passwordEdit{{ $u->id }}"
                                   class="form-control"
                                   placeholder="Kosongkan jika tidak diubah">

                            <span class="input-group-text"
                                  onclick="toggleEditPassword({{ $u->id }})"
                                  style="cursor:pointer;">

                                <i class="fa fa-eye"
                                   id="eyeEdit{{ $u->id }}"></i>

                            </span>

                        </div>

                    </div>


                    <!-- OUTLET -->
                    <div class="mb-3">

                        <label class="form-label">
                            Outlet
                        </label>

                        <select name="id_outlet"
                                class="form-select"
                                required>

                            @foreach($outlets as $outlet)

                            <option value="{{ $outlet->id }}"
                                {{ $u->id_outlet == $outlet->id ? 'selected' : '' }}>

                                {{ $outlet->nm_outlet }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- ROLE -->
                    <div class="mb-3">

                        <label class="form-label">
                            Role
                        </label>

                        <select name="role"
                                class="form-select">

                            <option value="admin"
                                {{ $u->role == 'admin' ? 'selected' : '' }}>

                                Admin

                            </option>

                            <option value="kasir"
                                {{ $u->role == 'kasir' ? 'selected' : '' }}>

                                Kasir

                            </option>

                            <option value="owner"
                                {{ $u->role == 'owner' ? 'selected' : '' }}>

                                Owner

                            </option>

                        </select>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

function toggleEditPassword(id){

    let input = document.getElementById('passwordEdit' + id);

    let icon = document.getElementById('eyeEdit' + id);

    if(input.type === "password"){

        input.type = "text";

        icon.classList.remove('fa-eye');

        icon.classList.add('fa-eye-slash');

    }else{

        input.type = "password";

        icon.classList.remove('fa-eye-slash');

        icon.classList.add('fa-eye');

    }

}

</script>