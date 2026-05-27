<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - BubbleBliss</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

    <style>

        body{
            background: #e5f0ff;
            margin: 0;
            color: #0650d1;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* HEADER */
        .topbar{
            display: flex;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-header{
            width: 240px;
            height: 70px;
            background: #1a4fbf;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
        }

        .logo-header span{
            font-family: 'Hammersmith One', sans-serif;
        }

        .header-right{
            flex: 1;
            height: 70px;
            background: white;
            padding: 0 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 5px -1px rgb(53, 119, 243);
        }

        .header-right h4,
        .header-right small{
            font-family: 'Hammersmith One', sans-serif;
        }

        /* SIDEBAR */
        .sidebar{
            width: 240px;
            position: fixed;
            top: 70px;
            left: 0;
            bottom: 0;
            background: linear-gradient(#2f80ed, #56ccf2);
            padding: 15px;
            z-index: 999;
            font-family: 'Hammersmith One', sans-serif;
        }

        .menu-title-main{
            font-size: 14px;
            margin: 15px 5px 5px;
            opacity: 0.8;
            color: white;
            letter-spacing: 1px;
        }

        .sidebar a{
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
        .active-menu{
            background: rgba(255,255,255,0.2);
        }

        .active-menu::before{
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 4px;
            background: white;
            border-radius: 2px;
        }

        /* MAIN */
        .main{
            margin-left: 240px;
            padding: 25px;
        }

        /* CARD */
        .card-custom{
            border: 2px solid #c7d7ff;
            border-radius: 14px;
            background: white;
            box-shadow: 0 3px 10px rgba(53,119,243,0.15);
            overflow: hidden;
        }

        /* HEADER TABLE */
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

        /* BUTTON TAMBAH */
        .btn-add{
            background: linear-gradient(to right,#4f7dff,#2357eb);
            border: none;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,.15);
            font-family: 'Hammersmith One', sans-serif;
        }

        .btn-add:hover{
            opacity: .9;
            color: white;
        }

        /* TABLE */
        .table-user-custom{
            margin-bottom: 0;
        }

        .table-user-custom thead th{
            background: #b9d5f7;
            color: #0050d7;
            padding: 16px;
            text-align: center;
            border: none;
            font-size: 16px;
            font-family: 'Hammersmith One', sans-serif;
        }

        .table-user-custom tbody td{
            padding: 14px;
            vertical-align: middle;
            border-bottom: 1px solid #edf4ff;
            font-weight: normal !important;
            font-family: Arial, Helvetica, sans-serif !important;
            color: #0650d1;
        }

        .table-responsive{
             padding: 0 18px;
        }

        /* form */

        .modal-dialog{
            max-width: 500px;
        }

        .modal-content{
            padding: 5px;
        }

        .form-control,
        .form-select{
            height: 42px;
            font-size: 14px;
        }

        .form-label{
            font-size: 14px;
            margin-bottom: 5px;
        }

        /* AVATAR */
        .avatar-user{
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #9dc5ff;
            color: #1c5dd9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        /* TEXT */
        .nama-user{
            font-size: 18px;
            color: #0050d7;
        }

        .email-user,
        .jk-user,
        .id-user{
            color: #0050d7;
        }

        /* ROLE */
        .badge-role-custom{
            padding: 8px 15px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: normal;
        }

        /* BUTTON */
        .btn-edit-custom{
            background: #2d9cff;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
        }

        .btn-edit-custom:hover{
            background: #198df3;
            color: white;
        }

        .btn-delete-custom{
            background: red;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
        }

        .btn-delete-custom:hover{
            background: #dc0000;
            color: white;
        }

        /* STAT CARD */
        .stat-card{
            border-radius: 12px;
            padding: 10px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            font-family: 'Hammersmith One', sans-serif;
            
        }

        .bg-blue-1{
        background: #6da8ff;
        }

        .bg-blue-2{
        background: #3577f3;
        }

        .bg-blue-3{
        background: #1a4fbf;
        }

    </style>
</head>

<body>

<!-- HEADER -->
<div class="topbar">

    <div class="logo-header">
        <img src="{{ asset('images/logoputih.png') }}" width="45">
        <span style="font-size:26px">BubbleBliss</span>
    </div>

    <div class="header-right px-4">

        <div>
            <h4 class="mb-0" style="color:#0650d1; font-size:28px;">
                DATA PENGGUNA
            </h4>

            <small style="color:#5691f6; font-size:17px;">
                Kelola Data Akses Pengguna
            </small>
        </div>

         <!-- Profile-->
        <div class="position-relative">
            <button id="profileBtn"
                class="btn border-0 bg-transparent d-flex align-items-center gap-2 text-primary">

                <i class="fa fa-user-circle fs-1"></i>
                <span style="font-family: 'Hammersmith One', sans-serif;">
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

    <a href="{{ route('user.index') }}" class="active-menu">
        <i class="fa fa-user me-2"></i> Data Pengguna
    </a>

    <a href="{{ route('outlet.index') }}">
        <i class="fa fa-shop me-2"></i> Data Outlet
    </a>

    <a href="{{ route('paket.index') }}">
        <i class="fa fa-box me-2"></i> Data Paket
    </a>

    <div class="menu-title-main">LAINNYA</div>

    <a href="{{ route('laporan.index') }}">
        <i class="fa fa-file-invoice me-2"></i> Laporan
    </a>

</div>

<!-- MAIN -->
<div class="main">

   <!-- STATISTIK -->
<div class="row g-3 mb-4">

    <!-- JUMLAH PENGGUNA -->
    <div class="col-md-4">

        <div class="stat-card bg-blue-1">

            <div>

                <small>JUMLAH PENGGUNA</small>

                <h3>{{ $users->count() }}</h3>

            </div>

            <i class="fa fa-user fs-1 opacity-50"></i>

        </div>

    </div>

    <!-- JUMLAH OUTLET -->
    <div class="col-md-4">

        <div class="stat-card bg-blue-2">

            <div>

                <small>JUMLAH OUTLET</small>

                <h3>{{ $outlets->count() }}</h3>

            </div>

            <i class="fa fa-store fs-1 opacity-50"></i>

        </div>

    </div>

    <!-- JUMLAH PAKET -->
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

     <!-- CARD TABEL -->
    <div class="card-custom">

        <!-- HEADER -->
        <div class="table-header">

            <h4 class="table-title">
                DATA PENGGUNA
            </h4>

            <button class="btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahUser">

                <i class="fa fa-plus me-2"></i>
                TAMBAH PENGGUNA

            </button>

        </div>

        <!-- TABLE -->
        <div class="table-responsive">

            <table class="table align-middle table-user-custom">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>L/P</th>
                        <th>Email</th>
                        <th>Outlet</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $u)

                    <tr>

                        <!-- ID -->
                        <td class="id-user">
                            P00{{ $u->id }}
                        </td>

                        <!-- NAMA -->
                        <td>

                            <div class="d-flex align-items-center gap-3">

                                <div class="avatar-user">
                                    {{ strtoupper(substr($u->name,0,1)) }}
                                </div>

                                <div class="text-start">

                                    <div class="nama-user">
                                        {{ $u->name }}
                                    </div>

                                    <small style="color:#7aa6ff;">
                                        {{ $u->telepon }}
                                    </small>

                                </div>

                            </div>

                        </td>

                        <!-- JK -->
                        <td class="text-center">

                            @if($u->jk == 'Laki - Laki')

                                <span class="badge bg-primary">
                                     L
                                </span>

                            @else

                                <span class="badge bg-pink text-white"
                                      style="background:#ff69b4;">
                                    P
                                </span>

                            @endif

                        </td>

                        <!-- EMAIL -->
                        <td class="email-user">
                            {{ $u->email }}
                        </td>

                        <!-- OUTLET -->
                        <td>
                            {{ $u->outlet->nm_outlet ?? '-' }}
                        </td>

                        <!-- PASSWORD -->
                        <td class="text-center">
                            ••••••••
                        </td>

                        <!-- ROLE -->
                        <td>

                            <span class="
                                badge-role-custom

                                @if($u->role == 'admin')
                                    bg-success-subtle text-success

                                @elseif($u->role == 'kasir')
                                    bg-info-subtle text-info

                                @else
                                    bg-warning-subtle text-warning
                                @endif
                            ">

                                {{ ucfirst($u->role) }}

                            </span>

                        </td>

                        <!-- AKSI -->
                        <td>

                            <div class="d-flex justify-content-center gap-2">

                                <button class="btn btn-sm btn-primary text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditUser{{ $u->id }}"
                                        style="width:38px; height: 35px;">

                                    <i class="fa fa-edit"></i

                                </button>

                                <button class="btn btn-sm btn-danger"
                                onclick="konfirmasiHapus({{ $u->id }})"
                                style="width:38px; height: 35px;">

                                    <i class="fa fa-trash"></i>

                                </button>

                                <form id="form-hapus-{{ $u->id }}"
                                      action="{{ route('user.destroy', $u->id) }}"
                                      method="POST"
                                      style="display:none;">

                                    @csrf
                                    @method('DELETE')

                                </form>

                            </div>

                        </td>

                    </tr>

                    @include('user.edit', ['u' => $u, 'outlets' => $outlets])

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL TAMBAH USER -->
<div class="modal fade" id="modalTambahUser" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">

                <h5 class="modal-title fw-bold text-primary">
                    Tambah Pengguna
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form action="{{ route('user.store') }}" method="POST">

                @csrf

                <div class="modal-body">

                    <div class="row">

                    <!-- NAMA -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nama Lengkap
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               required>
                    </div>

                    <!-- EMAIL -->
                    <div class=" col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               required>
                    </div>

                    <!-- TELEPON -->
                    <div class="col-md-0 mb-3">

                        <label class="form-label">
                            Nomor Telepon
                        </label>

                        <input type="text"
                               name="telepon"
                               class="form-control">
                    </div>

                    <!-- JK -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Jenis Kelamin
                        </label>

                        <select name="jk"
                                class="form-select">

                            <option value="Laki - Laki">
                                Laki - Laki
                            </option>

                            <option value="Perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>

                    <!-- PASSWORD -->
                    <div class=" col-md-6 mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <div class="input-group">

                            <input type="password"
                                   name="password"
                                   id="passwordInput"
                                   class="form-control"
                                   required>

                            <span class="input-group-text"
                                  onclick="toggleInputPassword()"
                                  style="cursor:pointer;">

                                <i class="fa fa-eye"
                                   id="eyeIcon"></i>

                            </span>

                        </div>

                    </div>

                    <!-- OUTLET -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Outlet
                    </label>

                    <select name="id_outlet"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Outlet --
                        </option>

                        @foreach($outlets as $outlet)

                        <option value="{{ $outlet->id }}">

                            {{ $outlet->nm_outlet }}

                        </option>

                        @endforeach

                    </select>

                </div>
                    <!-- ROLE -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Role
                        </label>

                        <select name="role"
                                class="form-select">

                            <option value="admin">
                                Admin
                            </option>

                            <option value="kasir">
                                Kasir
                            </option>

                            <option value="owner">
                                Owner
                            </option>

                        </select>

                    </div>

                </div>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function toggleInputPassword(){

    let input = document.getElementById('passwordInput');

    let icon = document.getElementById('eyeIcon');

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

<script>

function konfirmasiHapus(id){

    Swal.fire({
        title: 'Hapus Pengguna?',
        text: 'Data pengguna akan dihapus!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1a4fbf',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'HAPUS',
        cancelButtonText: 'BATAL'
    }).then((result) => {

        if(result.isConfirmed){

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

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: "{{ session('error') }}",
        timer: 2000,
        showConfirmButton: false
    });
@endif
</script>

</body>
</html>