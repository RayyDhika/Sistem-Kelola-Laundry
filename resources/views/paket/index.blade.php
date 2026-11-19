@extends('layouts.app')

@section('title', 'Data Paket Cucian')
@section('page_title', 'DATA PAKET CUCIAN')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">
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
    <!-- BUTTON -->
    <div class="card-custom">

       <div class="table-header">

    <h4 class="table-title">
        DATA PAKET CUCIAN
    </h4>

    <div class="header-tools">

        <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" id="searchPaket" placeholder="Cari Paket...">
        </div>

        <button class="btn-add"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">
            <i class="fa fa-plus me-2"></i>
            TAMBAH PAKET
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
                        <th>Outlet</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pakets as $p)
                        <tr>
                            <td>C00{{ $p->id }}</td>
                            <td>
                                <span class="badge px-3 py-2" style="
                                                                                            border-radius:6px;
                                                                                            background-color:
                                                                                            {{ $p->jenis == 'kiloan' ? '#3577f3' : '#00b7ff' }};
                                                                                            color:white;
                                                                                        ">
                                    {{ strtoupper($p->jenis) }}
                                </span>
                            </td>
                            <td>{{ $p->nm_paket }}</td>
                            <td>{{ $p->outlet->nm_outlet }}</td>
                            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm btn-primary text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $p->id }}">

                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="konfirmasiHapus({{ $p->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <form id="form-hapus-{{ $p->id }}" action="{{ route('paket.destroy', $p->id) }}"
                                        method="POST" style="display:none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @include('paket.edit')

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-3">Belum ada data paket</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                                <input type="text" class="form-control" id="nm_paket" name="nm_paket"
                                    placeholder="Masukan Nama Paket" required>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label form-label-blue">Harga (Rp)</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    placeholder="Masukan Harga /Kg" min="0" required>
                            </div>
                        </div>

                        <div class="modal-footer border-0 pt-0 d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-secondary px-4 fw-bold" data-bs-dismiss="modal"
                                style="border-radius: 10px;">BATAL</button>
                            <button type="submit" id="btnSimpan" class="btn btn-primary px-4 fw-bold"
                                style="background: #3577f3; border: none; border-radius: 10px;">SIMPAN</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
@endsection
    @include('paket.script')