<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Laporan - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

    <style>
        body { background: #e5f0ff; margin: 0; font-family: 'Hammersmith One', sans-serif; color: #0650d1; }
        
        .topbar { display: flex; position: sticky; top: 0; z-index: 1060; }
        .logo-header { width: 240px; height: 70px; background: #1a4fbf !important; color: white; display: flex; align-items: center; gap: 10px; padding: 15px; }
        .header-right { 
            flex: 1; 
            height: 70px; 
            background: white; 
            padding: 0 15px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 3px 5px -1px rgba(53, 119, 243); }

        .sidebar { 
            width: 240px;
            position: fixed; 
            top: 70px; 
            left: 0; 
            bottom: 0; 
            background: linear-gradient(#2f80ed, #56ccf2);
            padding: 15px; 
            z-index: 990; 
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

        .menu-title-main { 
            font-size: 14px; 
            margin: 15px 5px 5px; 
            opacity: 0.8; 
            color: white; 
            letter-spacing: 1px; 
        }

        .main { margin-left: 240px; padding: 25px; }

        .card-filter { 
            border: 2px solid #3577f3; 
            border-radius: 15px; 
            background: white; 
            padding: 25px; 
        }
        .form-label-blue { color: #0650d1; font-weight: bold; font-size: 18px; }
        
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

        .btn-tampilkan:hover { background: #1a4fbf; color: white; }

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

        .card-table { border: none; border-radius: 15px; background: white; box-shadow: 0 4px 15px rgba(53, 119, 243, 0.15); padding: 25px; }
    </style>
</head>
<body>

<div class="topbar">
    <div class="logo-header">
        <img src="{{ asset('images/logoputih.png') }}" width="45">
        <span style="font-size: 26px;">BubbleBliss</span>
    </div>
    <div class="header-right px-4">
        <div>
            <h4 class="mb-0" style="font-size: 28px; text-transform: uppercase;">Generate Laporan</h4>
            <small class="text-primary">Buat Dan Lihat Laporan</small>
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
    <a href="{{ route('dashboard') }}"><i class="fa fa-home me-2"></i> Beranda</a>
    <div class="menu-title-main">TRANSAKSI</div>
    <a href="{{ route('pelanggan.index') }}"><i class="fa fa-user-plus me-2"></i> Register Pelanggan</a>
    <a href="{{ route('transaksi.index') }}"><i class="fa fa-cart-plus me-2"></i> Entri Transaksi</a>
    <div class="menu-title-main">DATA</div>
    <a href="{{ route('user.index') }}"><i class="fa fa-user me-2"></i> Data Pengguna</a>
    <a href="{{ route('outlet.index') }}"><i class="fa fa-shop me-2"></i> Data Outlet</a>
    <a href="{{ route('paket.index') }}"><i class="fa fa-box me-2"></i> Data Paket</a>
    <div class="menu-title-main">LAINNYA</div>
    <a href="{{ route('laporan.index') }}" class="active-menu"><i class="fa fa-file-invoice me-2"></i> Laporan</a>
</div>

<div class="main">
    <p class="text-primary fw-bold mb-3" style="font-size: 16px;">Silahkan Untuk Melengkapi Terlebih Dahulu Untuk Lanjut</p>
    
    <div class="card-filter mb-4">
        <form action="{{ route('laporan.index') }}" method="GET">
            <div class="row align-items-end g-3">
                
                <div class="col-md-4">
                    <label class="form-label-blue mb-2">Tanggal Awal</label>
                    <input type="text" name="tanggal_awal" value="{{ $tanggal_awal ?? '' }}" 
                           placeholder="Pilih Tanggal Awal..." 
                           class="form-control shadow-sm py-2 text-primary" 
                           style="border: 1.5px solid #3577f3; font-family: arial;"
                           onfocus="(this.type='date')" 
                           onblur="if(!this.value) this.type='text'" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label-blue mb-2">Tanggal Akhir</label>
                    <input type="text" name="tanggal_akhir" value="{{ $tanggal_akhir ?? '' }}" 
                           placeholder="Pilih Tanggal Akhir..." 
                           class="form-control shadow-sm py-2 text-primary" 
                           style="border: 1.5px solid #3577f3; font-family: arial;"
                           onfocus="(this.type='date')" 
                           onblur="if(!this.value) this.type='text'" required>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn-tampilkan py-2">TAMPILKAN</button>
                </div>

            </div>
        </form>
    </div>

    <div class="card-table">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold m-0 text-uppercase">Data Laporan Menyeluruh</h5>

        <div class="d-flex align-items-center gap-2"></div>

            @if($tanggal_awal && $tanggal_akhir)
                <span class="badge bg-primary px-3 py-2">
                    Periode: 
                    {{ \Carbon\Carbon::parse($tanggal_awal)->format('d/m/Y') }} s/d
                    {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d/m/Y') }}
                </span>

            <a href="{{ route('laporan.cetak', [
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                ]) }}"
               class="btn btn-danger">

                <i class="fa fa-file-pdf"></i>
                Cetak PDF

            </a>

            @endif
        </div>
        
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

@if($tanggal_awal && $tanggal_akhir)

    @forelse($transaksi as $key => $t)

    <tr>
        <td>{{ $key + 1 }}</td>

        <td>
            <b class="text-dark">
                {{ $t->kode_invoice ?? 'INV-'.$t->id }}
            </b>
        </td>

        <td>
            {{ $t->pelanggan->nm_pelanggan ?? 'Umum' }}
        </td>

        <td>
            @foreach ($t->details as $detail)
                {{ $detail->paket->nm_paket ?? '-'  }}<br>
            @endforeach
        </td>

        <td>
            {{ $t->details->sum('qty')}} KG
        </td>

        <td>
            {{ \Carbon\Carbon::parse($t->tgl_masuk)->format('d/m/Y') }}
        </td>

        <td class="text-primary font-weight-bold">
            Rp {{ number_format($t->total_harga, 0, ',', '.') }}
        </td>
    </tr>

    @empty

    <tr>
        <td colspan="7" class="text-muted py-4">
            Tidak ada data transaksi ditemukan pada periode ini.
        </td>
    </tr>

    @endforelse

@else

    <tr>
        <td colspan="7" class="text-muted py-4">
            Silahkan pilih tanggal terlebih dahulu.
        </td>
    </tr>

@endif

</tbody>

</table>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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