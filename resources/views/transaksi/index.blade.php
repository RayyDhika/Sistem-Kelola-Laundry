<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entri Transaksi - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap"
          rel="stylesheet">

    <style>

        body{
            background:#e5f0ff;
            margin:0;
            font-family:'Hammersmith One',sans-serif;
            color:#0650d1;
        }

        .topbar{
            display:flex;
            position:sticky;
            top:0;
            z-index:1050;
        }

        .logo-header{
            width:240px;
            height:70px;
            background:#1a4fbf;
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

        .sidebar{
            width:240px;
            position:fixed;
            top:70px;
            left:0;
            bottom:0;
            background:linear-gradient(#2f80ed,#56ccf2);
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

        .main{
            margin-left:240px;
            padding:25px;
        }

        .card-custom{
            border:2px solid #c7d7ff;
            border-radius: 14px;
            background: white;
            box-shadow:0 3px 10px rgba(53,119,243,0.15);
            overflow: hidden;
        }

        .table-custom {
            margin-bottom: 0;
        }

        .table-custom thead th{
            background: #b9d5f7;
            color: #0050d7;
            padding: 14px;
            vertical-align: middle;
            border: none;
            text-align: center;
            font-weight: bold;
            font-family: 'Hammersmith One', sans-serif;
        }

        .table-custom tbody td{
            vertical-align:middle;
            padding:15px;
            color:#0650d1;
            text-align: center;
            font-weight: normal !important;
            font-family: Arial, Helvetica, sans-serif !important;
            color: #0650d1;
        }

        .table-responsive{
             padding: 0 18px;
        }

        .btn-add{
            background:#4f7df3;
            color:white;
            border:none;
            border-radius:8px;
            padding:10px 18px;
        }

        .btn-action{
            border:none;
            border-radius:6px;
            padding:4px 8px;
            font-size: 12px;
        }

        .card-stat{
            border-radius:15px;
            color:white;
            padding:10px 20px;
            box-shadow:0 4px 15px rgba(53,119,243,0.15);
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

        #modalTambah .modal-dialog{
            max-width:660px;
            margin:5px auto;
        }

        #modalTambah .modal-content{
            border:none;
            border-radius:26px;
            padding:18px 22px;
            background:white;
            box-shadow:0 8px 30px rgba(0,0,0,0.12);
        }

        .modal-title-custom{
            color:#3467eb;
            font-size:18px;
            margin-bottom:15px;
        }

        .section-box{
            border:1.5px solid #bfd7ff;
            border-radius:14px;
            padding:8px;
            background:#f8fbff;
            margin-bottom:12px;
        }

        .section-title{
            color:#3467eb;
            font-size:12px;
            margin-bottom:10px;
        }

        .form-label-blue{
            color:#7da6ff;
            font-size:12px;
            margin-bottom:5px;
            display:block;
        }

        .form-control,
        .form-select{
            border:1.5px solid #7da6ff;
            border-radius:10px;
            height:32px;
            color:#3467eb;
            font-size:12px;
            box-shadow:none !important;
            font-family: Arial, Helvetica, sans-serif !important;
        }

        textarea.form-control{
            height:55px;
            resize:none;
        }

        .qty-group{
            display:flex;
            gap:10px;
        }

        .btn-add-item{
            width:70px;
            border:none;
            border-radius:10px;
            background:#4f7df3;
            color:white;
            font-size:14px;
        }

        .cart-box{
            border:1.5px solid #8fb6ff;
            border-radius:14px;
            min-height:140px;
            background:#f8fbff;
            padding:10px;
        }

        .cart-empty{
            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
            height:120px;
        }

        .cart-empty i{
            font-size:45px;
            color:#b3c6ff;
            margin-bottom:10px;
        }

        .cart-empty p{
            color:#9ab5ff;
            font-size:14px;
            margin:0;
        }

        .detail-box{
            border:1.5px solid #bfd7ff;
            border-radius:14px;
            padding:12px;
            margin-top:12px;
            background:#f8fbff;
        }

        .detail-row{
            display:flex;
            justify-content:space-between;
            margin-bottom:10px;
            color:#3467eb;
            font-size:14px;
        }

        .btn-simpan{
            background:#0b46d1;
            color:white;
            border:none;
            border-radius:10px;
            padding:10px 32px;
        }

        .btn-batal{
            background:#39a0ff;
            color:white;
            border:none;
            border-radius:10px;
            padding:10px 32px;
        }

        .modal-footer-custom{
            display:flex;
            justify-content:end;
            gap:12px;
            margin-top:14px;
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
            <h4 class="mb-0" style="font-size:28px;">
                ENTRI TRANSAKSI
            </h4>

            <small style="color:#5691f6;">
                Kelola Data Transaksi Laundry
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


<div class="sidebar text-white">

    <div class="menu-title-main">MENU UTAMA</div>

    <a href="{{ route('dashboard') }}">
        <i class="fa fa-home me-2"></i> Beranda
    </a>

    <div class="menu-title-main">TRANSAKSI</div>

    <a href="{{ route('pelanggan.index') }}">
        <i class="fa fa-user-plus me-2"></i> Register Pelanggan
    </a>

    <a href="{{ route('transaksi.index') }}" class="active-menu">
        <i class="fa fa-cart-plus me-2"></i> Entri Transaksi
    </a>

     <!-- DATA -->
    <div class="menu-title-main">DATA</div>

    <a href="{{ route('user.index') }}">
        <i class="fa fa-user me-2"></i> Data Pengguna
    </a>

    <a href="{{ route('outlet.index') }}">
        <i class="fa fa-shop me-2"></i> Data Outlet
    </a>

    <a href="{{ route('paket.index') }}">
        <i class="fa fa-box me-2"></i> Data Paket
    </a>

    <!-- LAINNYA -->
    <div class="menu-title-main">LAINNYA</div>

    <a href="{{ route('laporan.index') }}">
        <i class="fa fa-file-alt me-2"></i> Laporan
    </a>


</div>

<div class="main">

    <!-- CARD INFO -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card-stat" style="background: #6da8ff;">
                <h6 style="font-size:13px;">JUMLAH TOTAL PESANAN</h6>
                <h2  style="font-size:28px;">{{ $countTransaksi }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-stat" style="background: #3577f3;">
                <h6 style="font-size:13px;">JUMLAH PROSES PESANAN</h6>
                <h2 style="font-size:28px;">{{ $countProses }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-stat" style="background: #1a4fbf;">
                <h6 style="font-size:13px;">JUMLAH SELESAI</h6>
                <h2 style="font-size:28px;">{{ $countSelesai }}</h2>
            </div>
        </div>

    </div>

    <!-- TABLE -->
    <div class="card-custom">

        <div class="table-header">

            <h4 class="table-title">
                DATA TRANSAKSI
            </h4>

            <div class="d-flex align-items-center gap-3">

                 <!-- SEARCH -->
                <div class="search-box position-relative">
                    <i class="fa fa-search position-absolute"
                        style="left:12px; top:13px; color:#3b82f6;"></i>

                <input type="text"
                       id="searchTransaksi"
                       class="form-control"
                       placeholder="Cari Pelanggan..."
                       style="padding-left:35px; width:260px; height: 43px; font-size:16px;">
                </div>

    <!--button-->
    <button class="btn-add"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">

        <i class="fa fa-plus me-2"></i>
        TAMBAH TRANSAKSI

    </button>

</div>


        </div>

        <div class="table-responsive">

            <table class="table table-custom" id="transaksiTable">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Invoice</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($transaksis as $no => $t)

                <tr>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1 align-items-center">
                        {{ $no + 1 }}
                        </div>
                    </td>

                    <td class="nama-pelanggan">
                        {{ $t->pelanggan->nm_pelanggan ?? '-' }}
                    </td>

                    <td class="kode-invoice">
                        {{ $t->kode_invoice }}
                    </td>

                    <td>

                        @if($t->status == 'selesai')

                            <span class="badge bg-success">
                                {{ $t->status }}
                            </span>

                        @else

                            <span class="badge bg-info">
                                {{ $t->status }}
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($t->status_bayar == 'dibayar')

                            <span class="badge bg-success">
                                Lunas
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Belum Lunas
                            </span>

                        @endif

                    </td>

                    <td class="text-center">

                        <div class="d-flex justify-content-center gap-1 align-items-center">

                            <!-- DETAIL -->
                            <button class="btn btn-warning btn-action text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $t->id }}">

                                <i class="fa fa-eye"></i>

                            </button>

                             <!-- EDIT -->
                             <button class="btn btn-primary btn-action text-white"
                                     data-bs-toggle="modal"
                                     data-bs-target="#modalEdit{{ $t->id }}">

                                <i class="fa fa-edit"></i>

                             </button>

                            <!-- HAPUS -->
                            <form action="{{ route('transaksi.destroy', $t->id) }}"
                                  method="POST"
                                  class="form-hapus m-0">

                             @csrf
                             @method('DELETE')

                            <button class="btn btn-danger btn-action">

                                <i class="fa fa-trash"></i>

                            </button>

                        </form>

                        <!-- CETAK -->
                        @if($t->status == 'selesai')

                        <a href="{{ route('transaksi.nota', $t->id) }}"
                            class="btn btn-success btn-action">

                            <i class="fa fa-print"></i>

                        </a>

                         @endif

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center">
                        Belum ada data transaksi
                    </td>
                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambah" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('transaksi.store') }}"
                  method="POST">

                @csrf

            <input type="hidden"
                   name="total_harga"
                   id="totalHargaInput"
                   value="0">

                <input type="hidden"
                       name="status"
                       value="proses">

                <input type="hidden"
                       name="status_bayar"
                       value="belum">

                <input type="hidden"
                       name="kode_invoice"
                       value="INV-{{ date('Ymd') }}-{{ rand(100,999) }}">

                <h5 class="modal-title-custom">
                    TAMBAH TRANSAKSI
                </h5>

                <div class="row g-3">

                    <!-- KIRI -->
                    <div class="col-md-6">

                        <div class="section-box">

                            <div class="section-title">
                                Pelanggan & Layanan
                            </div>

                            <label class="form-label-blue">
                                Pelanggan
                            </label>

                            <select class="form-select mb-3"
                                    name="id_pelanggan">

                                <option value="">
                                    Pilih Pelanggan
                                </option>

                                @foreach($pelanggans as $p)

                                <option value="{{ $p->id }}">
                                    {{ $p->nm_pelanggan }}
                                </option>

                                @endforeach

                            </select>

                            <label class="form-label-blue">
                                Tambah Layanan
                            </label>

                            <select id="paketSelect"
                                    class="form-select mb-2">

                                <option value="">
                                    Pilih Paket Cucian
                                </option>

                                @foreach($pakets as $paket)

                                <option
                                    value="{{ $paket->id }}"
                                    data-harga="{{ $paket->harga }}">

                                    {{ $paket->nm_paket }}
                                    -
                                    {{ $paket->jenis }}

                                </option>

                                @endforeach

                            </select>

                            <div class="qty-group">

                                <input type="number"
                                       id="jumlahInput"
                                       class="form-control"
                                       placeholder="Jumlah">

                                <button type="button"
                                        class="btn-add-item"
                                        onclick="tambahKeranjang()">

                                    + Add

                                </button>

                            </div>

                        </div>

                        <div class="section-box">

                            <div class="section-title">
                                Pembayaran
                            </div>

                            <div class="row">

                                <div class="col-6">

                                    <label class="form-label-blue">
                                        Metode Pembayaran
                                    </label>

                                    <select class="form-select">

                                        <option>
                                            Cash
                                        </option>

                                        <option>
                                            Transfer
                                        </option>

                                    </select>

                                </div>

                                <div class="col-6">

                                    <label class="form-label-blue">
                                        Estimasi Selesai
                                    </label>

                                    <input type="date"
                                           class="form-control">

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- KANAN -->
                    <div class="col-md-6">

                        <div class="section-title">
                            Keranjang Pesanan
                        </div>

                        <div class="cart-box"
                             id="cartBox">

                            <div class="cart-empty">

                                <i class="fa fa-cart-shopping"></i>

                                <p>
                                    Keranjang Pesanan Kosong
                                </p>

                            </div>

                        </div>

                        <div class="detail-box">

                            <div class="section-title">
                                Detail Pesanan
                            </div>

                            <div class="detail-row">
                                <span>Subtotal:</span>
                                <span id="subtotalText">
                                    Rp 0
                                </span>
                            </div>

                            <div class="detail-row">
                                <span>Total:</span>
                                <span id="totalText">
                                    Rp 0
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer-custom">

                    <button type="button"
                            class="btn-batal"
                            data-bs-dismiss="modal">

                        BATAL

                    </button>

                    <button type="submit"
                            class="btn-simpan">

                        SIMPAN

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- MODAL DETAIL & EDIT -->
@foreach($transaksis as $t)

<div class="modal fade"
     id="modalDetail{{ $t->id }}"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content p-4">

            <h5 class="text-primary mb-3">
                Detail Transaksi
            </h5>

            <div class="mb-2">
                <b>Pelanggan:</b><br>
                {{ $t->pelanggan->nm_pelanggan }}
            </div>

            <div class="mb-2">
                <b>Invoice:</b><br>
                {{ $t->kode_invoice }}
            </div>

            <div class="mb-2">
                <b>Status:</b><br>

                <span class="badge bg-info">
                    {{ ucfirst ($t->status) }}
                </span>
            </div>
            
            <div class="mb-2">
                <b>Status Pembayaran:</b><br>

                @if($t->status_bayar == 'dibayar')

                    <span class="badge bg-success">
                        Lunas
                    </span>

                @else

                    <span class="badge bg-danger">
                        Belum Lunas
                    </span>

                @endif
            </div>

            <div class="mb-2">
                <b>Tanggal Masuk:</b><br>
                {{ \Carbon\Carbon::parse($t->tgl_masuk)->format('d M Y') }}
            </div>

            <div class="mb-2">
                <b>Estimasi Selesai:</b><br>
                {{ \Carbon\Carbon::parse($t->batas_waktu)->format('d M Y') }}
            </div>

            <div class="mb-2">
                <b>Total Harga:</b><br>

                Rp {{ number_format($t->total_harga ?? 0, 0, ',', '.') }}
            </div>

            @if($t->tgl_bayar)
            <div class="mb-2">
                <b>Tanggal Bayar:</b><br>
                {{ \Carbon\Carbon::parse($t->tgl_bayar)->format('d M Y') }}
            </div>
            @endif
         </div>
    </div>
</div>

<div class="modal fade"
     id="modalEdit{{ $t->id }}"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content p-4">

            <h5 class="text-primary mb-3">
                Edit Transaksi
            </h5>

            <form action="{{ route('transaksi.update', $t->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <label>Status</label>

                <select name="status"
                        class="form-select mb-3">

                    <option value="proses">
                        Proses
                    </option>

                    <option value="selesai">
                        Selesai
                    </option>

                </select>

                <label>Pembayaran</label>

                <select name="status_bayar"
                        class="form-select mb-3">

                    <option value="dibayar">
                        Dibayar
                    </option>

                    <option value="belum">
                        Belum Dibayar
                    </option>

                </select>

                <button class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>

    </div>

</div>

@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

    let total = 0;

    function tambahKeranjang(){

        let paket =
            document.getElementById('paketSelect');

        let jumlah =
            document.getElementById('jumlahInput').value;

        if(paket.selectedIndex == 0 || jumlah == ''){

            alert('Pilih paket & jumlah');

            return;
        }

        let nama =
            paket.options[paket.selectedIndex].text;

        let harga = parseInt(
            paket.options[paket.selectedIndex]
            .getAttribute('data-harga')
        );

        let subtotal = harga * jumlah;

        total += subtotal;

        let cart =
            document.getElementById('cartBox');

        if(cart.innerHTML.includes('Keranjang')){

            cart.innerHTML = '';
        }

        cart.innerHTML += `

            <div style="
                background:white;
                border:1px solid #bfd7ff;
                border-radius:10px;
                padding:10px;
                margin-bottom:10px;
                color:#3467eb;
                font-size:12px;
            ">

                <b>${nama}</b><br>

                Qty : ${jumlah}<br>

                Rp ${subtotal.toLocaleString()}

            </div>

        `;

        document.getElementById('subtotalText')
            .innerHTML =
            'Rp ' + total.toLocaleString();

        document.getElementById('totalText')
            .innerHTML =
            'Rp ' + total.toLocaleString();

        document.getElementById('totalHargaInput').value = total;

        console.log(total);
        console.log(document.getElementById('totalHargaInput').value);

    }

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
</script>

<script>
document.querySelectorAll('.form-hapus').forEach(form => {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({
            title: 'Yakin hapus transaksi?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0649ca',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {

                form.submit();

            }

        });

    });

});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$("#searchTransaksi").on("keyup", function () {

    var value = $(this).val().toLowerCase();

    $("#transaksiTable tbody tr").filter(function () {

        let pelanggan = $(this)
            .find(".nama-pelanggan")
            .text()
            .toLowerCase();

        let invoice = $(this)
            .find(".kode-invoice")
            .text()
            .toLowerCase();

        $(this).toggle(
            pelanggan.indexOf(value) > -1 ||
            invoice.indexOf(value) > -1
        );

    });

});
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

</body>
</html>