<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Outlet - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/outlet.css') }}">
</head>

<body>

    <div class="topbar">

        <div class="logo-header">
            <img src="{{ asset('images/logoputih.png') }}" width="45">
            <span style="font-size:26px">BubbleBliss</span>
        </div>

        <div class="header-right px-4">

            <div>
                <h4 class="mb-0" style="color: #0650d1; font-size: 28px;">
                    DATA OUTLET
                </h4>

                <small style="color: #5691f6; font-size: 17px;">
                    Kelola Data Outlet Laundry Anda
                </small>
            </div>
            @include('partials.profile')
        </div>

    </div>
    </div>

    @include('partials.sidebar')

    <div class="main">

        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="stat-card bg-blue-1">
                    <div>
                        <small>JUMLAH PENGGUNA</small>
                        <h3>{{ $users->count() }}</h3>
                    </div>

                    <i class="fa fa-user fs-1 opacity-50"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-blue-2">
                    <div>
                        <small>JUMLAH OUTLET</small>
                        <h3>{{ $outlets->count() }}</h3>
                    </div>

                    <i class="fa fa-store fs-1 opacity-50"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-blue-3">
                    <div>
                        <small>JUMLAH PAKET</small>
                        <h3>{{ $pakets->count() }}</h3>
                    </div>

                    <i class="fa fa-box fs-1 opacity-50"></i>
                </div>
            </div>

        </div>

        <div class="card-custom">

            <div class="table-header">

                <h4 class="table-title">
                    DATA OUTLET
                </h4>

                @if(auth()->user()->role == 'admin')

                    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">

                        <i class="fa fa-plus me-2"></i>
                        TAMBAH OUTLET

                    </button>

                @endif

            </div>

            <div class="table-responsive">

                <table class="table table-custom">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Outlet</th>
                            <th>Alamat</th>
                            <th>No Tlp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($outlets as $o)

                            <tr>

                                <td>UO0{{ $o->id }}</td>

                                <td>{{ $o->nm_outlet }}</td>

                                <td>{{ $o->alamat }}</td>

                                <td>{{ $o->no_telp }}</td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <button class="btn btn-sm btn-primary text-white" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $o->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger" onclick="konfirmasiHapus({{ $o->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form id="form-hapus-{{ $o->id }}" action="{{ route('outlet.destroy', $o->id) }}"
                                            method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-3">
                                    Belum ada data outlet
                                </td>
                            </tr>

                        @endforelse


                </table>

            </div>

        </div>

    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">TAMBAH OUTLET</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <hr class="mx-2" style="color: #aec6eb">

                <form action="{{ route('outlet.store') }}" method="POST">

                    @csrf

                    <div class="modal-body px-4">

                        <div class="mb-3 row">

    <label class="col-sm-3 form-label-blue mt-2">
        Nama Outlet :
    </label>

    <div class="col-sm-9">
        <input type="text"
       name="nm_outlet"
       class="form-control @error('nm_outlet') is-invalid @enderror"
       placeholder="Masukan Nama Outlet"
       value="{{ old('nm_outlet') }}"
       required>

@error('nm_outlet')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
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
       id="telepon"
       class="form-control @error('no_telp') is-invalid @enderror"
       value="{{ old('no_telp') }}"
       placeholder="Masukan Nomor Telepon"
       required>

@error('no_telp')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
                            </div>

                        </div>

                        <div class="mb-3 row">

                            <label class="col-sm-3 form-label-blue mt-2">
                                Alamat :
                            </label>

                            <div class="col-sm-9">
                                <textarea name="alamat" class="form-control" rows="3"
                                    placeholder="Masukan Alamat Lengkap" required></textarea>
                            </div>

                        </div>

                        <input type="hidden" name="owner" value="Admin">

                    </div>

                    <div class="modal-footer border-0">

                        <button type="button" class="btn-batal" data-bs-dismiss="modal">
                            BATAL
                        </button>

                        <button type="submit" class="btn-simpan">
                            TAMBAH
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    @include('outlet.edit')
    @include('outlet.script')
</body>

</html>