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
        body { background: #e5f0ff; margin: 0; font-family: 'Hammersmith One', sans-serif; }

        /* HEADER */
        .topbar { display: flex; position: sticky; top: 0; z-index: 1000; }
        .logo-header {
            width: 240px; height: 70px; background: #1a4fbf !important; color: white;
            display: flex; align-items: center; gap: 10px; padding: 15px; font-weight: bold;
        }
        .header-right {
            flex: 1; height: 70px; background: white; padding: 0 15px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 3px 5px -1px rgb(53, 119, 243);
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px; position: fixed; top: 70px; left: 0; bottom: 0;
            background: linear-gradient(#2f80ed, #56ccf2); padding: 15px; z-index: 999;
        }
        .menu-title-main { font-size: 14px; margin: 15px 5px 5px; opacity: 0.8; color: white; letter-spacing: 1px; }
        .sidebar a {
            text-decoration: none; color: white; display: block; padding: 10px 15px;
            border-radius: 8px; margin-bottom: 4px; font-size: 15px; position: relative;
        }
        .sidebar a:hover, .active-menu { background: rgba(255,255,255,0.2); }
        .active-menu::before {
            content: ""; position: absolute; left: 0; top: 8px; bottom: 8px;
            width: 4px; background: white; border-radius: 2px;
        }

        /* MAIN CONTENT */
        .main { margin-left: 240px; padding: 20px; }
        .card-custom { border: none; border-radius: 12px; background: white; overflow: hidden; box-shadow: 0 3px 5px rgb(100, 152, 250); }
        .card-header-custom {
            background: white; padding: 20px; display: flex; justify-content: space-between; 
            align-items: center; border-bottom: 2px solid #aec6eb; margin-bottom: 15px;
        }

        /* FONT NORMAL */
        h4, h5, label, input, textarea, td, th, button, span { font-weight: normal !important; }
        
        .table-custom thead th { background-color: #d1e3ff !important; color: #0650d1; padding: 15px 10px; border: none; }
        .table-custom tbody td { vertical-align: middle; color: #1a4fbf; border-bottom: 1px solid #f0f6ff; }
        .avatar-circle {
            width: 40px; height: 40px; background: #5a97ff; color: white;
            display: flex; align-items: center; justify-content: center; border-radius: 50%; margin-right: 12px;
        }
        .btn-add { background: #3577f3; color: white; border-radius: 8px; padding: 8px 18px; border: none; }
        
        /* SEARCH BOX */
        .search-box input { border-radius: 8px; border: 1px solid #005eff; padding-left: 35px; height: 40px; width: 250px; }
        .search-box input:focus { box-shadow: none; border-color: #1a4fbf; }
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
            <h4 class="mb-0" style="color: #0650d1; font-size: 28px;">REGISTRASI PELANGGAN</h4>
            <small style="color: #5691f6; font-size: 17px;">Kelola Data Laundry Anda</small>
        </div>
        <div class="d-flex align-items-center gap-2 text-primary">
            <i class="fa fa-user-circle fs-1"></i>
            <span>Admin</span>
        </div>
    </div>
</div>

<div class="sidebar text-white">
    <div class="menu-title-main">MENU UTAMA</div>
    <a href="/dashboard"><i class="fa fa-home me-2"></i> Beranda</a>

    <div class="menu-title-main">TRANSAKSI</div>
    <a href="{{ route('pelanggan.create') }}" class="active-menu"><i class="fa fa-user-plus me-2"></i> Register Pelanggan</a>
    <a href="{{ route('transaksi.index') }}"><i class="fa fa-cart-plus me-2"></i> Entri Transaksi</a>

    <div class="menu-title-main">DATA</div>
    <a href="#"><i class="fa fa-user me-2"></i> Data Pengguna</a>
    <a href="#"><i class="fa fa-shop me-2"></i> Data Outlet</a>
    <a href="#"><i class="fa fa-box me-2"></i> Data Paket</a>
    <div class="menu-title-main">LAINNYA</div>
    <a href="#"><i class="fa fa-file me-2"></i> Laporan</a>
</div>

<div class="main">
    <div class="card card-custom">
        <div class="card-header-custom">
            <h5 style="color: #0650d1; font-size: 22px;">DATA PELANGGAN</h5>
            <div class="d-flex gap-2">
                <div class="search-box position-relative">
                    <i class="fa fa-search position-absolute" style="left: 12px; top: 12px; color: #0057f9;"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Pelanggan...">
                </div>
                <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa fa-plus me-2"></i> TAMBAH PELANGGAN
                </button>
            </div>
        </div>

        <div class="px-3 pb-3">
            <table class="table table-custom" id="pelangganTable">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th class="text-start">Nama Pelanggan</th>
                        <th>No Tlp</th>
                        <th>L/P</th>
                        <th class="text-start">Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggans as $no => $p)
                    <tr class="text-center">
                        <td>{{ $no + 1 }}</td>
                        <td class="text-start nama-pelanggan">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle">{{ strtoupper(substr($p->nm_pelanggan, 0, 1)) }}</div>
                                <span>{{ $p->nm_pelanggan }}</span>
                            </div>
                        </td>
                        <td>{{ $p->no_telp }}</td>
                        <td><span class="badge bg-info text-dark">{{ $p->jenis_kelamin }}</span></td>
                        <td class="text-start">{{ $p->alamat }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-edit" 
                                    data-id="{{ $p->id }}" data-nama="{{ $p->nm_pelanggan }}"
                                    data-telp="{{ $p->no_telp }}" data-jk="{{ $p->jenis_kelamin }}"
                                    data-alamat="{{ $p->alamat }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="konfirmasiHapus({{ $p->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <form id="form-hapus-{{ $p->id }}" action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr id="noData"><td colspan="6" class="text-center p-4 text-muted">Belum ada data pelanggan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header border-0 pb-0"><h5 class="modal-title" style="color: #0650d1;">TAMBAH PELANGGAN</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="mb-1">Nama Pelanggan</label><input type="text" name="nm_pelanggan" class="form-control mb-3" placeholder="Nama..." required>
                            <label class="mb-1">Nomor Telepon</label><input type="text" name="no_telp" class="form-control mb-3" placeholder="08..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-1">Jenis Kelamin</label><br>
                            <div class="mt-1 mb-3"><input type="radio" name="jenis_kelamin" value="L" required> Laki-Laki <input type="radio" name="jenis_kelamin" value="P" class="ms-3"> Perempuan</div>
                            <label class="mb-1">Alamat</label><textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary px-4">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header border-0 pb-0"><h5 class="modal-title" style="color: #0650d1;">EDIT PELANGGAN</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="mb-1">Nama Pelanggan</label><input type="text" name="nm_pelanggan" id="edit_nama" class="form-control mb-3" required>
                            <label class="mb-1">Nomor Telepon</label><input type="text" name="no_telp" id="edit_telp" class="form-control mb-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-1">Jenis Kelamin</label><br>
                            <div class="mt-1 mb-3"><input type="radio" name="jenis_kelamin" value="L" id="edit_jk_l"> Laki-Laki <input type="radio" name="jenis_kelamin" value="P" id="edit_jk_p" class="ms-3"> Perempuan</div>
                            <label class="mb-1">Alamat</label><textarea name="alamat" id="edit_alamat" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary px-4">Update</button></div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 1. Fitur Live Search Pelanggan
    $(document).ready(function(){
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pelangganTable tbody tr").filter(function() {
                // Menyaring berdasarkan teks di dalam kolom nama
                $(this).toggle($(this).find(".nama-pelanggan").text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    // 2. Notifikasi Berhasil (Simpan/Update)
    @if(session('success')) 
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false }); 
    @endif

    // 3. Logika Menampilkan Data di Modal Edit
    $(document).on('click', '.btn-edit', function() {
        let id = $(this).data('id');
        $('#edit_nama').val($(this).data('nama'));
        $('#edit_telp').val($(this).data('telp'));
        $('#edit_alamat').val($(this).data('alamat'));
        
        if($(this).data('jk') == 'L') { 
            $('#edit_jk_l').prop('checked', true); 
        } else { 
            $('#edit_jk_p').prop('checked', true); 
        }

        $('#formEdit').attr('action', '/pelanggan/' + id);
        $('#modalEdit').modal('show');
    });

    // 4. Konfirmasi Hapus Data
    function konfirmasiHapus(id) {
        Swal.fire({ 
            title: 'Hapus Data?', 
            text: "Data yang dihapus tidak bisa dikembalikan!", 
            icon: 'warning', 
            showCancelButton: true, 
            confirmButtonColor: '#d33', 
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => { 
            if (result.isConfirmed) { 
                document.getElementById('form-hapus-' + id).submit(); 
            } 
        });
    }
</script>
</body>
</html>