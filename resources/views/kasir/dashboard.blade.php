<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beranda Kasir - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap"
          rel="stylesheet">

    <style>

        body{
            background:#e5f0ff;
            margin:0;
            font-family:'Hammersmith One', sans-serif;
        }

        /* HEADER */
        .topbar{
            display:flex;
            position:sticky;
            top:0;
            z-index:1000;
        }

        .logo-header{
            width:240px;
            height:70px;
            background:#1a4fbf !important;
            color:white;
            display:flex;
            align-items:center;
            gap:10px;
            padding:15px;
        }

        .header-right{
            flex:1;
            height:70px;
            background:white;
            padding:0 15px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 3px 5px -1px rgb(53,119,243);
        }

        /* SIDEBAR */
        .sidebar{
            width:240px;
            position:fixed;
            top:70px;
            left:0;
            bottom:0;
            background:linear-gradient(#2f80ed, #56ccf2);
            padding:15px;
            z-index:999;
        }

        .menu-title-main{
            font-size:14px;
            margin:15px 5px 5px;
            opacity:0.8;
            color:white;
            letter-spacing:1px;
        }

        .sidebar a{
            text-decoration:none;
            color:white;
            display:block;
            padding:10px 15px;
            border-radius:8px;
            margin-bottom:4px;
            font-size:15px;
            position:relative;
            transition:0.3s;
        }

        .sidebar a:hover,
        .active-menu{
            background:rgba(255,255,255,0.2);
        }

        .active-menu::before{
            content:"";
            position:absolute;
            left:0;
            top:8px;
            bottom:8px;
            width:4px;
            background:white;
            border-radius:2px;
        }

        /* MAIN */
        .main{
            margin-left:240px;
            padding:20px;
        }

        .welcome-card{
            background:white;
            border-radius:10px;
            padding:20px;
            box-shadow:0 3px 5px -1px rgb(53,119,243);
            margin-bottom:25px;
        }

        /* CARD */
        .card-menu{
            border:none;
            border-top:4px solid #278cff;
            transition:0.3s;
            text-decoration:none;
            color:inherit;
            height:100%;
        }

        .card-menu:hover{
            transform:translateY(-5px);
            box-shadow:0 10px 20px rgba(0,0,0,0.1);
        }

        .card-menu i{
            font-size:40px;
            color:#0d6efd;
        }

        .card-menu h5{
            color:#0650d1;
            margin-top:15px;
            font-weight:normal;
        }

        .card-menu small{
            color:#5691f6;
        }

    </style>

</head>

<body>

<!-- HEADER -->
<div class="topbar">

    <div class="logo-header">

        <img src="{{ asset('images/logoputih.png') }}"
             width="45">

        <span style="font-size:26px">
            BubbleBliss
        </span>

    </div>

    <div class="header-right px-4">

        <div>

            <h4 class="mb-0"
                style="color:#0650d1; font-size:28px;">

                BERANDA KASIR

            </h4>

            <small style="color:#5691f6; font-size:17px;">

                Kelola Transaksi Laundry

            </small>

        </div>

        <!-- PROFILE -->
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
                    width:320px;
                    position:absolute;
                    top:70px;
                    right:0;
                    display:none;
                    z-index:9999;
                ">

                <!-- HEADER PROFILE -->
                <div class="d-flex align-items-center gap-3 p-3 rounded-4"
                     style="background:#eaf2ff;">

                    <i class="fa fa-user-circle text-primary"
                       style="font-size:70px;"></i>

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

                    <p class="mb-2 text-primary">

                        <i class="fa fa-user me-2"></i>

                        Role: Kasir

                    </p>

                    <p class="mb-0 text-success">

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

    <div class="menu-title-main">
        MENU UTAMA
    </div>

    <a href="{{ route('kasir.dashboard') }}"
       class="active-menu">

        <i class="fa fa-home me-2"></i>
        Beranda

    </a>

    <div class="menu-title-main">
        TRANSAKSI
    </div>

    <a href="{{ route('kasir.pelanggan') }}">

        <i class="fa fa-user-plus me-2"></i>
        Register Pelanggan

    </a>

    <a href="{{ route('kasir.transaksi') }}">

        <i class="fa fa-cart-plus me-2"></i>
        Entri Transaksi

    </a>

    <div class="menu-title-main">LAINNYA</div>

    @if(auth()->user()->role == 'kasir')

        <a href="{{ route('kasir.laporan') }}">
            <i class="fa fa-file me-2"></i> Laporan
        </a>

    @else

        <a href="{{ route('laporan.index') }}">
            <i class="fa fa-file me-2"></i> Laporan
        </a>

    @endif

</div>

<!-- MAIN -->
<div class="main">

    <div class="welcome-card">

        <h4 class="mb-1"
            style="color:#0650d1; font-size:28px;">

            Halo, {{ auth()->user()->name }}!

        </h4>

        <p class="mb-0"
           style="color:#5691f6">

            Selamat Datang Di Halaman Kasir

        </p>

    </div>

    <div class="row g-4">

        <!-- PELANGGAN -->
        <div class="col-md-4">

            <a href="{{ route('kasir.pelanggan') }}"
               class="text-decoration-none">

                <div class="card card-menu text-center p-4 shadow-sm">

                    <i class="fa fa-user-plus"></i>

                    <h5>
                        Registrasi Pelanggan
                    </h5>

                    <small>
                        Tambah pelanggan baru
                    </small>

                </div>

            </a>

        </div>

        <!-- TRANSAKSI -->
        <div class="col-md-4">

            <a href="{{ route('kasir.transaksi') }}"
               class="text-decoration-none">

                <div class="card card-menu text-center p-4 shadow-sm">

                    <i class="fa fa-cart-plus"></i>

                    <h5>
                        Transaksi
                    </h5>

                    <small>
                        Input transaksi laundry
                    </small>

                </div>

            </a>

        </div>

        <!-- LAPORAN -->
        <div class="col-md-4">

            <a href="{{ route('kasir.laporan') }}"
               class="text-decoration-none">

                <div class="card card-menu text-center p-4 shadow-sm">

                    <i class="fa fa-file-invoice"></i>

                    <h5>
                        Laporan
                    </h5>

                    <small>
                        Lihat laporan transaksi
                    </small>

                </div>

            </a>

        </div>

    </div>

</div>

<!-- SCRIPT PROFILE -->
<script>

    const profileBtn = document.getElementById('profileBtn');
    const profileCard = document.getElementById('profileCard');

    profileBtn.addEventListener('click', function () {

        if(profileCard.style.display === 'block'){

            profileCard.style.display = 'none';

        }else{

            profileCard.style.display = 'block';

        }

    });

    document.addEventListener('click', function(e){

        if(
            !profileBtn.contains(e.target) &&
            !profileCard.contains(e.target)
        ){
            profileCard.style.display = 'none';
        }

    });

</script>

<!-- SCRIPT LOGOUT -->
<script>

    const logoutBtn = document.getElementById('logoutBtn');
    const logoutForm = document.getElementById('logoutForm');

    logoutBtn.addEventListener('click', function () {

        Swal.fire({

            title: 'Yakin ingin logout?',
            text: 'Anda akan keluar dari halaman kasir',
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#d33',

            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',

            background: '#ffffff',
            color: '#0650d1'

        }).then((result) => {

            if(result.isConfirmed){

                logoutForm.submit();

            }

        });

    });

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>