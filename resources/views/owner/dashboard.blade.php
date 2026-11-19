<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Owner - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

    <style>
        body {
            background: #e5f0ff;
            margin: 0;
            font-family: 'Hammersmith One', sans-serif;
        }

        .topbar {
            display: flex;
            position: sticky;
            top: 0;
            z-index: 1000;
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
            background: rgba(255, 255, 255, 0.2);
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
            padding: 20px;
        }

        .card-filter {
            border: 2px solid #3577f3;
            border-radius: 15px;
            background: white;
            padding: 25px;
        }

        .form-label-blue {
            color: #0650d1;
            font-weight: bold;
            font-size: 18px;
        }

        .btn-tampilkan {
            background: #3577f3;
            color: white;
            border: none;
            padding: 10px 30px;
            font-weight: bold;
            border-radius: 8px;
            width: 100%;
            height: 43px;
            transition: 0.2s;
        }

        .btn-tampilkan:hover {
            background: #1a4fbf;
            color: white;
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

        .card-table {
            border: none;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 15px rgba(53, 119, 243, 0.15);
            padding: 25px;
        }
    </style>

</head>

<body>

    <!-- HEADER -->
    <div class="topbar">

        <div class="logo-header">

            <img src="{{ asset('images/logoputih.png') }}" width="45">

            <span style="font-size:26px">
                BubbleBliss
            </span>

        </div>

        <div class="header-right px-4">

            <div>

                <h4 class="mb-0" style="color:#0650d1; font-size:28px;">

                    GENERATE LAPORAN
                    {{ auth()->user()->outlet->nm_outlet ?? '-' }}

                </h4>

                <small style="color:#5691f6; font-size:17px;">

                    Buat Dan Lihat Laporan

                </small>

            </div>

            <div class="d-flex align-items-center gap-2 text-primary">

                <i class="fa fa-user-circle fs-1"></i>

                <span>
                    {{ auth()->user()->name }}
                </span>

            </div>

        </div>

    </div>

    <!-- SIDEBAR -->
    <div class="sidebar text-white">

        <div class="menu-title-main">
            MENU UTAMA
        </div>

        <a href="{{ route('owner.dashboard') }}" class="active-menu">
            <i class="fa fa-file-pdf me-2"></i>
            Laporan

    </div>

    <!-- MAIN -->
    <div class="main">

        <h3 class="mb-4" style="color:#0650d1;">

            Silahkan Untuk Melengkapi Terlebih Dahulu Untuk Lanjut

        </h3>

        <p class="text-primary fw-bold mb-3" style="font-size:16px;">
            Silahkan Untuk Melengkapi Terlebih Dahulu Untuk Lanjut
        </p>

        <!-- FILTER -->
        <div class="card-filter mb-4">

            <form>

                <div class="row align-items-end g-3">

                    <div class="col-md-4">

                        <label class="form-label-blue mb-2">
                            Tanggal Awal
                        </label>

                        <input type="text" placeholder="Pilih Tanggal Awal..."
                            class="form-control shadow-sm py-2 text-primary"
                            style="border:1.5px solid #3577f3; font-family:arial;">

                    </div>

                    <div class="col-md-4">

                        <label class="form-label-blue mb-2">
                            Tanggal Akhir
                        </label>

                        <input type="text" placeholder="Pilih Tanggal Akhir..."
                            class="form-control shadow-sm py-2 text-primary"
                            style="border:1.5px solid #3577f3; font-family:arial;">

                    </div>

                    <div class="col-md-4">

                        <button type="submit" class="btn-tampilkan py-2">

                            TAMPILKAN

                        </button>

                    </div>

                </div>

            </form>

        </div>

        <!-- TABLE -->
        <div class="card-table">

            <h5 class="fw-bold m-0 text-uppercase mb-4">
                Data Laporan Menyeluruh
            </h5>

            <div class="table-responsive">

                <table class="table table-custom">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Kode Invoice</th>
                            <th>Pelanggan</th>
                            <th>Paket Cucian</th>
                            <th>Berat/Qty</th>
                            <th>Tgl Transaksi</th>
                            <th>Total Harga</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td colspan="7" class="text-muted py-4">

                                Silahkan pilih tanggal terlebih dahulu.

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>
</body>

</html>