@extends('layouts.app')

@section('title', 'Registrasi Pelanggan - BubbleBliss')
@section('page_title', 'REGISTRASI PELANGGAN')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pelanggan.css') }}">
@endpush

@section('content')
    <div class="card-custom">
        <div class="table-header">
            <h4 class="table-title">DATA PELANGGAN</h4>
            <div class="d-flex gap-2">
                <div class="search-box position-relative">
                    <i class="fa fa-search position-absolute" style="left:12px; top:13px; color: #3b82f6;"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Pelanggan...">
                </div>
                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa fa-plus me-2"></i> TAMBAH PELANGGAN
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
                        <th>Outlet</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggans as $no => $p)
                        <tr>
                            <td class="text-center">{{ $no + 1 }}</td>
                            <td class="nama-pelanggan">{{ $p->nm_pelanggan }}</td>
                            <td class="text-center">{{ $p->no_telp }}</td>
                            <td class="text-center">
                                @if($p->jenis_kelamin == 'L')
                                    <span class="badge bg-primary">{{ $p->jenis_kelamin }}</span>
                                @else
                                    <span class="badge bg-pink text-white" style="background:#ff69b4;">{{ $p->jenis_kelamin }}</span>
                                @endif
                            </td>
                            <td>{{ $p->outlet->nm_outlet ?? '-' }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm btn-edit" data-id="{{ $p->id }}"
                                    data-nama="{{ $p->nm_pelanggan }}" data-telp="{{ $p->no_telp }}"
                                    data-jk="{{ $p->jenis_kelamin }}" data-alamat="{{ $p->alamat }}"
                                    data-outlet="{{ $p->id_outlet }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="konfirmasiHapus({{ $p->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="form-hapus-{{ $p->id }}" action="{{ route('pelanggan.destroy', $p->id) }}"
                                    method="POST" style="display:none;">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-3">Belum ada data pelanggan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                                <input type="text" name="nm_pelanggan" class="form-control" placeholder="Masukan Nama Pelanggan..." required>
                            </div>
                            <div class="section-box">
                                <label class="form-label-blue">No Telepon</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Masukan Nomor Telepon" maxlength="15" required>
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
                                <textarea name="alamat" class="form-control" rows="4" placeholder="Masukan Alamat Lengkap..." required></textarea>
                            </div>
                            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'owner')
                                <div class="section-box">
                                    <label class="form-label-blue">Outlet</label>
                                    <select name="id_outlet" class="form-control" required>
                                        <option value="">Pilih Outlet</option>
                                        @foreach($outlets as $outlet)
                                            <option value="{{ $outlet->id }}">{{ $outlet->nm_outlet }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
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

    @include('pelanggan.edit')
    @include('pelanggan.script')
@endsection