@extends('layouts.app')

@section('title', 'Data Pengguna - BubbleBliss')
@section('page_title', 'DATA PENGGUNA')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
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
            <h4 class="table-title">DATA PENGGUNA</h4>
            <div class="d-flex align-items-center gap-3">
                <div class="search-box position-relative">
                    <i class="fa fa-search position-absolute" style="left:12px; top:13px; color:#3b82f6;"></i>
                    <input type="text" id="searchUser" class="form-control" placeholder="Cari Pengguna..."
                        style="font-family: Arial, Helvetica, sans-serif; padding-left:35px; width:260px; height:43px; font-size:16px; border:1.3px solid #3577f3; border-radius:10px; box-shadow:none;">
                </div>

                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                    <i class="fa fa-plus me-2"></i> TAMBAH PENGGUNA
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle table-user-custom" id="userTable">
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
                    @forelse($users as $u)
                        <tr>
                            <td class="id-user text-center">
                                P00{{ $u->id }}
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-user">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div class="text-start">
                                        <div class="nama-user">
                                            {{ $u->name }}
                                        </div>
                                        <small style="color: #7aa6ff; font-size: 12px;">
                                            {{ $u->telepon ?? '-' }}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                                @if($u->jk == 'Laki - Laki' || $u->jk == 'L')
                                    <span class="badge bg-primary">L</span>
                                @else
                                    <span class="badge text-white" style="background:#ff69b4;">P</span>
                                @endif
                            </td>

                            <td class="email-user">
                                {{ $u->email }}
                            </td>

                            <td class="text-center">
                                {{ $u->outlet->nm_outlet ?? '-' }}
                            </td>

                            <td class="text-center" style="letter-spacing: 2px;">
                                ••••••••
                            </td>

                            <td class="text-center">
                                <span class="badge rounded-pill px-3 py-2 
                            @if($u->role == 'admin') bg-primary text-white
                            @elseif($u->role == 'kasir') bg-success text-white
                            @else bg-warning text-dark @endif">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <button class="btn btn-sm btn-primary text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalEditUser{{ $u->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger" onclick="konfirmasiHapus({{ $u->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <form id="form-hapus-{{ $u->id }}" action="{{ route('user.destroy', $u->id) }}"
                                        method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </div>
                            </td>
                        </tr>

                        @include('user.edit', ['u' => $u, 'outlets' => $outlets])

                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-3">Belum ada data pengguna</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalTambahUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-primary">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body" style="font-family: Arial, Helvetica, sans-serif">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama Lengkap"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukan Email"
                                    value="{{ old('email') }}" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label text-secondary small fw-bold">Nomor Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control"
                                    placeholder="Masukan Nomor Telepon" value="{{ old('telepon') }}" maxlength="15">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small fw-bold">Jenis Kelamin</label>
                                <select name="jk" class="form-select" required>
                                    <option value="Laki - Laki" {{ old('jk') == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                                    <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small fw-bold">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="passwordInput" class="form-control"
                                        placeholder="Masukan Password" required>
                                    <span class="input-group-text" onclick="toggleInputPassword()" style="cursor:pointer;">
                                        <i class="fa fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small fw-bold">Outlet</label>
                                @if(auth()->user()->role == 'admin')
                                    <select name="id_outlet" class="form-select" required>
                                        <option value="">Pilih Outlet</option>
                                        @foreach($outlets as $outlet)
                                            <option value="{{ $outlet->id }}" {{ old('id_outlet') == $outlet->id ? 'selected' : '' }}>{{ $outlet->nm_outlet }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="hidden" name="id_outlet" value="{{ auth()->user()->id_outlet }}">
                                    <input type="text" class="form-control"
                                        value="{{ auth()->user()->outlet->nm_outlet ?? '-' }}" readonly>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small fw-bold">Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- File include script ditaruh di dalam section content agar rapi --}}
    @include('user.script')

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modalTambah = new bootstrap.Modal(document.getElementById('modalTambahUser'));
                modalTambah.show();
            });
        </script>
    @endif
@endsection