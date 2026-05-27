<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pelanggan - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

    <style>
        body { background: #e5f0ff; margin: 0; font-family: 'Hammersmith One', sans-serif; color: #0650d1; }
        .topbar { display: flex; position: sticky; top: 0; z-index: 1050; }
        .logo-header { width: 240px; height: 70px; background: #1a4fbf !important; color: white; display: flex; align-items: center; gap: 10px; padding: 15px; }
        .header-right { flex: 1; height: 70px; background: white; padding: 0 15px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 3px 5px -1px rgb(53, 119, 243); }
        .sidebar { width: 240px; position: fixed; top: 70px; left: 0; bottom: 0; background: linear-gradient(#2f80ed, #56ccf2); padding: 15px; z-index: 999; }
        .menu-title-main { font-size: 14px; margin: 15px 5px 5px; opacity: 0.8; color: white; letter-spacing: 1px; }
        .sidebar a { text-decoration: none; color: white; display: block; padding: 10px 15px; border-radius: 8px; margin-bottom: 4px; font-size: 15px; position: relative; transition: 0.3s; }
        .sidebar a:hover, .active-menu { background: rgba(255,255,255,0.2); }
        .active-menu::before { content: ""; position: absolute; left: 0; top: 8px; bottom: 8px; width: 4px; background: white; border-radius: 2px; }
        .main { margin-left: 240px; padding: 25px; }
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
            text-align: center;
            border: none;
            font-size: 16px;
            font-family: 'Hammersmith One', sans-serif;
        }

        .table-custom tbody td { 
            padding: 14px;
            vertical-align: middle;
            border-bottom: 1px solid #edf4ff;
            font-weight: normal !important;
            font-family: Arial, Helvetica, sans-serif !important;
            color: #0650d1;
        }

        .table-custom thead th,
        .table-custom tbody td {
            text-align: center;
        }

        .table-custom thead th.text-start,
        .table-custom tbody td.text-start {
            text-align: left !important;
        }

        .table-responsive{
             padding: 0 18px;
        }
        
        .btn-add{
            background: linear-gradient(to right,#4f7dff,#2357eb) !important;
            border: none !important;
            color: white !important;
            padding: 10px 18px !important;
            border-radius: 8px !important;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,.15);
            font-family: 'Hammersmith One', sans-serif;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
    t       ext-decoration: none;
        }

        .btn-add:hover{
            opacity: .9;
            color: white !important;
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

        .section-box { border: 1px solid #c2dbff; border-radius: 12px; padding: 15px; margin-bottom: 15px; }
        .form-label-blue { color: #60a5fa; font-size: 13px; margin-bottom: 5px; display: block; }
        .form-control { border: 1px solid #60a5fa; border-radius: 8px; color: #0650d1; height: 45px; }
        textarea.form-control { height: auto; }
        .form-control:focus { 
            box-shadow: none; 
            border-color: #3b82f6; 
        }

        .form-control,
        .form-label-blue,
        .radio-box,
        .form-check-label {
            font-family: Arial, Helvetica, sans-serif !important;
        }   
        .radio-box { border: 1px solid #60a5fa; border-radius: 8px; padding: 10px 15px; height: 45px; display: flex; align-items: center; gap: 20px; }
        .btn-add { background: #4f7df3; color: white; border: none; border-radius: 8px; padding: 10px 18px; }
        .btn-simpan { background: #0649ca; color: white; border: none; border-radius: 8px; padding: 10px 35px; }
        .btn-batal { background: #3498db; color: white; border: none; border-radius: 8px; padding: 10px 35px; }
        .search-box input { border-radius: 8px; border: 1px solid #60a5fa; padding-left: 35px; height: 42px; width: 250px; }
        .modal-content { border-radius: 20px; border: none; }
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
            <h4 class="mb-0" style="font-size: 28px;">REGISTRASI PELANGGAN</h4>
            <small style="color: #5691f6;">Kelola Data Laundry Anda</small>
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
    <a href="{{ route('pelanggan.index') }}" class="active-menu"><i class="fa fa-user-plus me-2"></i> Register Pelanggan</a>
    <a href="{{ route('transaksi.index') }}"><i class="fa fa-cart-plus me-2"></i> Entri Transaksi</a>

    <div class="menu-title-main">DATA</div>
    <a href="{{ route('user.index') }}"><i class="fa fa-user me-2"></i> Data Pengguna</a>
    <a href="{{ route('outlet.index') }}"><i class="fa fa-shop me-2"></i> Data Outlet</a>
    <a href="{{ route('paket.index') }}"><i class="fa fa-box me-2"></i> Data Paket</a>

    <div class="menu-title-main">LAINNYA</div>
    <a href="{{ route('laporan.index') }}"><i class="fa fa-file-invoice me-2"></i> Laporan</a>
</div>

<div class="main">
    <div class="card-custom">
        <div class="table-header">

            <h4 class="table-title">
                DATA PELANGGAN
            </h4>

            <div class="d-flex gap-2">
                <div class="search-box position-relative">
                    <i class="fa fa-search position-absolute" style="left:12px; top:13px; color:#3b82f6;"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Pelanggan...">
                </div>
                <button class="btn-add" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalTambah">

                    <i class="fa fa-plus me-2"></i>
                     TAMBAH PELANGGAN
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom" id="pelangganTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>No Tlp</th>
                        <th>L/P</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggans as $no => $p)
                    <tr>
                        <td class="text-center">{{ $no + 1 }}</td>
                        
                        <td class="nama-pelanggan">
                            {{ $p->nm_pelanggan }}
                        </td>
                        <td class="text-center">{{ $p->no_telp }}</td>
                        <td class="text-center">
                            <span class="badge bg-info text-dark">{{ $p->jenis_kelamin }}</span>
                        </td>
                        <td>{{ $p->alamat }}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm btn-edit"
                                    data-id="{{ $p->id }}"
                                    data-nama="{{ $p->nm_pelanggan }}"
                                    data-telp="{{ $p->no_telp }}"
                                    data-jk="{{ $p->jenis_kelamin }}"
                                    data-alamat="{{ $p->alamat }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="konfirmasiHapus({{ $p->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <form id="form-hapus-{{ $p->id }}" action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data pelanggan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="text-primary fw-bold mb-4">TAMBAH PELANGGAN</h5>
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-box">
                            <label class="form-label-blue">Nama Pelanggan</label>
                            <input type="text" name="nm_pelanggan" class="form-control" required>
                        </div>
                        <div class="section-box">
                            <label class="form-label-blue">No Telepon</label>
                            <input type="text" name="no_telp" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-box">
                            <label class="form-label-blue mb-2">Jenis Kelamin</label>
                            <div class="radio-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" required>
                                    <label class="form-check-label">Laki-Laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="P">
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="section-box">
                            <label class="form-label-blue">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="button" class="btn-batal" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn-simpan">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="text-primary fw-bold mb-4">EDIT PELANGGAN</h5>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-box">
                            <label class="form-label-blue">Nama Pelanggan</label>
                            <input type="text" id="edit_nama" name="nm_pelanggan" class="form-control" required>
                        </div>
                        <div class="section-box">
                            <label class="form-label-blue">No Telepon</label>
                            <input type="text" id="edit_telp" name="no_telp" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-box">
                            <label class="form-label-blue mb-2">Jenis Kelamin</label>
                            <div class="radio-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="edit_jk_l" name="jenis_kelamin" value="L">
                                    <label class="form-check-label">Laki-Laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="edit_jk_p" name="jenis_kelamin" value="P">
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="section-box">
                            <label class="form-label-blue">Alamat</label>
                            <textarea id="edit_alamat" name="alamat" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="button" class="btn-batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $("#searchInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#pelangganTable tbody tr").filter(function () {
            $(this).toggle($(this).find(".nama-pelanggan").text().toLowerCase().indexOf(value) > -1);
        });
    });

    $(document).on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        $('#edit_nama').val($(this).data('nama'));
        $('#edit_telp').val($(this).data('telp'));
        $('#edit_alamat').val($(this).data('alamat'));
        if ($(this).data('jk') == 'L') {
            $('#edit_jk_l').prop('checked', true);
        } else {
            $('#edit_jk_p').prop('checked', true);
        }
        $('#formEdit').attr('action', '/pelanggan/' + id);
        $('#modalEdit').modal('show');
    });

    function konfirmasiHapus(id) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0649ca',
            cancelButtonColor: '#3498db',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
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