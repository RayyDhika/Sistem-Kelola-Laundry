<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Outlet - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

    <style>
        body {
            background: #e5f0ff;
            margin: 0;
            font-family: 'Hammersmith One', sans-serif;
            color: #0650d1;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            position: sticky;
            top: 0;
            z-index: 1060;
        }

        .logo-header {
            width: 240px;
            height: 70px;
            background: #1a4fbf !important;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
        }

        .header-right {
            flex: 1;
            height: 70px;
            background: white;
            padding: 0 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 5px -1px rgb(53, 119, 243);
        }

        /* SIDEBAR (DISAMAKAN DENGAN BERANDA) */
        .sidebar {
            width: 240px;
            position: fixed;
            top: 70px;
            left: 0;
            bottom: 0;
            background: linear-gradient(#2f80ed, #56ccf2);
            padding: 15px;
            z-index: 999;
        }

        .menu-title-main {
            font-size: 14px;
            margin: 15px 5px 5px;
            opacity: 0.8;
            color: white;
            letter-spacing: 1px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 4px;
            font-size: 15px;
            position: relative;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .active-menu {
            background: rgba(255,255,255,0.2);
        }

        .active-menu::before {
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 4px;
            background: white;
            border-radius: 2px;
        }

        .main {
            margin-left: 240px;
            padding: 25px;
        }

        /* STAT CARD */
        .stat-card {
            border-radius: 12px;
            padding: 10px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            font-family: 'Hammersmith One', sans-serif;

        }

        .bg-blue-1 {
            background: #6da8ff;
        }

        .bg-blue-2 {
            background: #3577f3;
        }

        .bg-blue-3 {
            background: #1a4fbf;
        }

        /* TABLE */
        .card-custom {
            border: 2px solid #c7d7ff;
            border-radius: 14px;
            background: white;
            box-shadow: 0 3px 10px rgba(53, 119, 243, 0.15);
            overflow: hidden;
        }

        .table-custom {
            margin-bottom: 0;
        }

        .table-custom thead th {
            background: #b9d5f7;
            color: #0050d7;
            padding: 16px;
            border: none;
            text-align: center;
            font-size: 16px;
            font-family: 'Hammersmith One', sans-serif;
        }

        .table-custom tbody td {
            vertical-align: middle;
            text-align: center;
            padding: 14px;
            border-bottom: 1px solid #edf4ff;
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: normal !important;
            color: #0650d1;

        }

        .table-responsive{
             padding: 0 18px;
        }
        

        .table-custom thead th.text-start,
        .table-custom tbody td.text-start {
            text-align: left !important;

        }

        .btn-add{
            background: linear-gradient(to right,#4f7dff,#2357eb);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,.15);
            font-family: 'Hammersmith One', sans-serif;
        }

        .btn-add:hover{
            opacity: .9;
            color: white;
        }

        .table-header{
            padding: 14px 20px;
            border-bottom: 1px solid #dbe7ff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title{
            font-size: 18px;
            color: #0050d7;
            font-weight: bold;
            margin: 0;
            font-family: 'Hammersmith One', sans-serif;
        }

        /* MODAL */
        .modal {
            z-index: 1070 !important;
        }

        .modal-backdrop {
            z-index: 1065 !important;
        }

        .modal-content {
            border-radius: 20px;
            border: none;
            padding: 20px;
        }

        .form-label-blue {
            color: #0650d1;
            font-weight: normal;
            font-size: 14px;
        }

        .form-control {
            border: 1px solid #aec6eb;
            border-radius: 8px;
            padding: 10px;
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: normal !important;
            color: #0650d1;
        }

        .btn-simpan {
            background: #1a4fbf;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            font-weight: bold;
        }

        .btn-batal {
            background: #2f80ed;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            font-weight: bold;
        }
    </style>
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

         <!-- Profile-->
        <div class="position-relative">
            <button id="profileBtn"
                class="btn border-0 bg-transparent d-flex align-items-center gap-2 text-primary">

                <i class="fa fa-user-circle fs-1"></i>
                <span>
                    {{ auth()->user()->name }}
                </span>
            </button>

            <!-- CARD PROFILE -->
            <div id="profileCard"
                class="shadow-lg rounded-4 bg-white p-3"
                style="
                    width: 320px;
                    position: absolute;
                    top: 70px;
                    right: 0;
                    display: none;
                    z-index: 9999;
                ">

             <!-- HEADER PROFILE -->
             <div class="d-flex align-items-center gap-3 p-3 rounded-4"
                  style="background: #eaf2ff;">

                  <i class="fa fa-user-circle text-primary"
                     style="font-size: 70px;"></i>

                  <div>
                        <h4 class="m-0 fw-bold text-primary text-uppercase">
                            {{ auth()->user()->name }}
                        </h4>

                        <small class="text-primary">
                            {{ auth()->user()->email }}
                        </small>
                  </div>

             </div>

             <!-- INFO -->
            <div class="border rounded-4 p-3 mt-3">

                <p class="mb-2 text-primary fw-bold">
                    <i class="fa fa-user me-2"></i>
                    Role: Admin
                </p>

                <p class="mb-0 fw-bold text-success">
                    <i class="fa fa-circle me-2"></i>
                    Status: Aktif
                </p>

            </div>

            <!-- LOGOUT -->
            <form id="logoutForm"
                 action="{{ route('logout') }}"
                 method="POST" 
                 class="mt-4">

                @csrf

                <button type="button"
                    id="logoutBtn"
                    class="btn btn-danger w-100 fw-bold py-2 rounded-3">

                    <i class="fa fa-power-off me-2"></i>
                    LOGOUT

                </button>
            </form>

        </div>

    </div>

</div>
</div>


<!-- SIDEBAR -->
<div class="sidebar text-white">

    <div class="menu-title-main">MENU UTAMA</div>

    <a href="{{ route('dashboard') }}">
        <i class="fa fa-home me-2"></i> Beranda
    </a>

    <div class="menu-title-main">TRANSAKSI</div>

    <a href="{{ route('pelanggan.index') }}">
        <i class="fa fa-user-plus me-2"></i> Register Pelanggan
    </a>

    <a href="{{ route('transaksi.index') }}">
        <i class="fa fa-cart-plus me-2"></i> Entri Transaksi
    </a>

    <div class="menu-title-main">DATA</div>

    <a href="{{ route('user.index') }}">
        <i class="fa fa-user me-2"></i> Data Pengguna
    </a>

    <a href="{{ route('outlet.index') }}" class="active-menu">
        <i class="fa fa-shop me-2"></i> Data Outlet
    </a>

    <a href="{{ route('paket.index') }}">
        <i class="fa fa-box me-2"></i> Data Paket
    </a>

    <div class="menu-title-main">LAINNYA</div>

    <a href="{{ route('laporan.index') }}">
        <i class="fa fa-file me-2"></i> Laporan
    </a>

</div>

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

            <button class="btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
            
                <i class="fa fa-plus me-2"></i> 
                TAMBAH OUTLET
            </button>

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

                    @foreach($outlets as $o)

                    <tr>

                        <td>UO0{{ $o->id }}</td>

                        <td>
                            {{ $o->nm_outlet }}
                        </td>

                        <td>
                            {{ $o->alamat }}
                        </td>

                        <td>
                            {{ $o->no_telp }}
                        </td>

                        <td>

                            <div class="d-flex justify-content-center gap-2">

                                <button class="btn btn-sm btn-primary text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $o->id }}"
                                    style="width:38px; height:35px;">


                                    <i class="fa fa-edit"></i>

                                </button>

                                <button class="btn btn-sm btn-danger"
                                    onclick="konfirmasiHapus({{ $o->id }})"
                                    style="width:38px; height:35px;">

                                    <i class="fa fa-trash"></i>

                                </button>

                                <form id="form-hapus-{{ $o->id }}"
                                    action="{{ route('outlet.destroy', $o->id) }}"
                                    method="POST"
                                    style="display:none;">

                                    @csrf
                                    @method('DELETE')

                                </form>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

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

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>
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
                                class="form-control"
                                placeholder="Masukan Nama Outlet"
                                required>
                        </div>

                    </div>

                    <div class="mb-3 row">

                        <label class="col-sm-3 form-label-blue mt-2">
                            No TLP :
                        </label>

                        <div class="col-sm-9">
                            <input type="text"
                                name="no_telp"
                                class="form-control"
                                placeholder="Masukan Nomor Telepon"
                                required>
                        </div>

                    </div>

                    <div class="mb-3 row">

                        <label class="col-sm-3 form-label-blue mt-2">
                            Alamat :
                        </label>

                        <div class="col-sm-9">
                            <textarea name="alamat"
                                class="form-control"
                                rows="3"
                                placeholder="Masukan Alamat Lengkap"
                                required></textarea>
                        </div>

                    </div>

                    <input type="hidden" name="owner" value="Admin">

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                        class="btn-batal"
                        data-bs-dismiss="modal">
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

<!-- MODAL EDIT -->
@foreach($outlets as $o)

<div class="modal fade" id="modalEdit{{ $o->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header border-0 pb-0">

                <h5 class="modal-title fw-bold">
                    EDIT OUTLET
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>

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
                            <input type="text"
                                name="nm_outlet"
                                value="{{ $o->nm_outlet }}"
                                class="form-control"
                                required>
                        </div>

                    </div>

                    <div class="mb-3 row">

                        <label class="col-sm-3 form-label-blue mt-2">
                            No TLP :
                        </label>

                        <div class="col-sm-9">
                            <input type="text"
                                name="no_telp"
                                value="{{ $o->no_telp }}"
                                class="form-control"
                                required>
                        </div>

                    </div>

                    <div class="mb-3 row">

                        <label class="col-sm-3 form-label-blue mt-2">
                            Alamat :
                        </label>

                        <div class="col-sm-9">
                            <textarea name="alamat"
                                class="form-control"
                                rows="3"
                                required>{{ $o->alamat }}</textarea>
                        </div>

                    </div>

                    <input type="hidden"
                        name="owner"
                        value="{{ $o->owner }}">

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                        class="btn-batal"
                        data-bs-dismiss="modal">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    function konfirmasiHapus(id) {
        Swal.fire({
            title: 'Hapus Data Outlet?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1a4fbf',
            cancelButtonColor: '#2f80ed',
            confirmButtonText: 'HAPUS',
            cancelButtonText: 'BATAL'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-hapus-' + id).submit();
            }
        });
    }
</script>

<!-- script profil -->
<script>

    const profileBtn = document.getElementById('profileBtn');
    const profileCard = document.getElementById('profileCard');

    profileBtn.addEventListener('click', function () {

        if (profileCard.style.display === 'block') {
            profileCard.style.display = 'none';
        } else {
            profileCard.style.display = 'block';
        }

    });

    document.addEventListener('click', function(e) {

        if (
            !profileBtn.contains(e.target) &&
            !profileCard.contains(e.target)
        ) {
            profileCard.style.display = 'none';
        }

    });

</script>

<!-- script notif  logout-->
 <script>

    const logoutBtn = document.getElementById('logoutBtn');
    const logoutForm = document.getElementById('logoutForm');

    logoutBtn.addEventListener('click', function () {

        Swal.fire({
            title: 'Yakin ingin logout?',
            text: 'Anda akan keluar dari halaman admin',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            background: '#ffffff',
            color: '#0650d1'
        }).then((result) => {

            if (result.isConfirmed) {

                logoutForm.submit();

            }

        });

    });

</script>

</body>
</html>