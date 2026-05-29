<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Paket Cucian - BubbleBliss</title>

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

        .topbar {
            display: flex;
            position: sticky;
            top: 0;
            z-index: 1040;
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

        .main {
            margin-left: 240px;
            padding: 25px;
        }

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

        .bg-blue-1 { background: #6da8ff; }
        .bg-blue-2 { background: #3577f3; }
        .bg-blue-3 { background: #1a4fbf; }

        .card-custom {
            border: 2px solid #c7d7ff; 
            border-radius: 15px;
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
            text-align: center;
            border: none;
            font-size: 16px;
            font-family: 'Hammersmith One', sans-serif;
        }

        .table-custom tbody td {
            vertical-align: middle;
            padding: 14px;
            text-align:center;
            border-bottom: 1px solid #edf4ff;
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: normal !important;
            color: #0650d1;
        }

        .table-custom tbody tr:hover{
            background:#f5f9ff;
        }

        .table-responsive{
             padding: 0 18px;
        }

        .modal { z-index: 2000; }
        .modal-backdrop {
            z-index: 1990 !important;
            background-color: #000 !important;
        }
        .modal-backdrop.show { opacity: 0.6 !important; }
        .modal-dialog { max-width: 650px; }
        .modal-content { border-radius: 20px; border: none; padding: 10px; }
        .form-label-blue { 
            color: #0650d1; 
            font-weight: normal; 
        }
        
        .form-control, .form-select { 
            height: 48px; 
            border-radius: 10px; 
            font-family: Arial, Helvetica, sans-serif !important;
        }
        .empty-data { padding: 35px !important; color: #7a93c9; font-size: 16px; }
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
            <h4 class="mb-0" style="color: #0650d1; font-size: 28px;">DATA PAKET CUCIAN</h4>
            <small style="color: #5691f6; font-size: 17px;">Kelola Data Paket Cucian Anda</small>
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

                <p class="mb-2 text-primary" style="font-family: Arial, Helvetica, sans-serif">
                    <i class="fa fa-user me-2"></i>
                    Role: Admin
                </p>

                <p class="mb-0 text-success" style="font-family: Arial, Helvetica, sans-serif">
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
    <a href="{{ route('dashboard') }}"><i class="fa fa-home me-2"></i> Beranda</a>

    <div class="menu-title-main">TRANSAKSI</div>
    <a href="{{ route('pelanggan.index') }}"><i class="fa fa-user-plus me-2"></i> Register Pelanggan</a>
    <a href="{{ route('transaksi.index') }}"><i class="fa fa-cart-plus me-2"></i> Entri Transaksi</a>

    <div class="menu-title-main">DATA</div>
    <a href="{{ route('user.index') }}"><i class="fa fa-user me-2"></i> Data Pengguna</a>
    <a href="{{ route('outlet.index') }}"><i class="fa fa-shop me-2"></i> Data Outlet</a>
    <a href="{{ route('paket.index') }}" class="active-menu"><i class="fa fa-box me-2"></i> Data Paket</a>

    <div class="menu-title-main">LAINNYA</div>
    <a href="{{ route('laporan.index') }}"><i class="fa fa-file me-2"></i> Laporan</a>
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
                    <h3>{{ $outlets->count() }}</h3></div>
                <i class="fa fa-store fs-1 opacity-50"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card bg-blue-3">
                <div>
                    <small>JUMLAH PAKET</small>
                    <h3>{{ $pakets->count() }}</h3></div>
                <i class="fa fa-box fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="table-header">
    <h4 class="table-title">DATA PAKET CUCIAN</h4>

    <div class="d-flex align-items-center gap-3">

        <!-- SEARCH -->
        <div class="search-box position-relative">
            <i class="fa fa-search position-absolute"
               style="left:12px; top:13px; color:#3b82f6;"></i>

            <input type="text"
                   id="searchTransaksi"
                   class="form-control"
                   placeholder="Cari Paket..."
                   style="
                        padding-left:35px;
                        width:260px;
                        height:43px;
                        font-size:16px;
                        border:1.3px solid #3577f3;
                        border-radius:12px;">
        </div>

        <!-- BUTTON -->
        <button class="btn-add"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

            <i class="fa fa-plus me-2"></i> TAMBAH PAKET
        </button>

    </div>
</div>

        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis Paket</th>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pakets as $p)
                    <tr>
                        <td>C00{{ $p->id }}</td>
                        <td><span class="badge bg-primary px-3 py-2" style="border-radius:6px">{{ strtoupper($p->jenis) }}</span></td>
                        <td>{{ $p->nm_paket }}</td>
                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-primary text-white" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalEdit{{ $p->id }}">
                                   
                            <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="konfirmasiHapus({{ $p->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="form-hapus-{{ $p->id }}" action="{{ route('paket.destroy', $p->id) }}" method="POST" style="display:none;">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>

                    @include('paket.edit')

                    @empty

                    <tr><td colspan="5" class="empty-data">Belum ada data paket</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg p-3">
            
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalTambahLabel" style="color: #0650d1;">
                    <i></i>TAMBAH DATA PAKET
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('paket.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="id_outlet" class="form-label form-label-blue">Pilih Outlet</label>
                        <select class="form-select" id="id_outlet" name="id_outlet" required>
                            <option value="" disabled selected>Pilih Outlet</option>
                            @isset($outlets)
                                @foreach($outlets as $outlet)
                                    <option value="{{ $outlet->id }}">{{ $outlet->nm_outlet }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jenis" class="form-label form-label-blue">Jenis Paket</label>
                        <select class="form-select" id="jenis" name="jenis" required>
                            <option value="" disabled selected>Pilih Jenis</option>
                            <option value="kiloan">Kiloan</option>
                            <option value="satuan">Satuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nm_paket" class="form-label form-label-blue">Nama Paket</label>
                        <input type="text" class="form-control" id="nm_paket" name="nm_paket" placeholder="Masukan Nama Paket" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label form-label-blue">Harga (Rp)</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukan Harga /Kg" min="0" required>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-secondary px-4 fw-bold" data-bs-dismiss="modal" style="border-radius: 10px;">BATAL</button>
                    <button type="submit" 
                            id="btnSimpan"
                            class="btn btn-primary px-4 fw-bold" 
                            style="background: #3577f3; border: none; border-radius: 10px;">SIMPAN</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

    function konfirmasiHapus(id){
        Swal.fire({
            title: 'Hapus Paket?',
            text: 'Data paket akan dihapus!',
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

<script>

document.querySelector('form').addEventListener('submit', function(){

    let btn = document.getElementById('btnSimpan');

    btn.disabled = true;

    btn.innerHTML = 'MENYIMPAN...';

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

<!-- search -->

<script>

document.getElementById('searchTransaksi').addEventListener('keyup', function(){

    let keyword = this.value.toLowerCase();

    let rows = document.querySelectorAll('.table-custom tbody tr');

    rows.forEach(function(row){

        let text = row.innerText.toLowerCase();

        if(text.includes(keyword)){

            row.style.display = '';

        } else {

            row.style.display = 'none';

        }

    });

});

</script>

</body>
</html> 