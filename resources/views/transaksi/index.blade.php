@extends('layouts.app')

@section('title', 'Entri Transaksi - BubbleBliss')
@section('page_title', 'ENTRI TRANSAKSI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
@endpush

@section('content')
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card-stat" style="background: #6da8ff;">
                <h6 style="font-size:13px;">JUMLAH TOTAL PESANAN</h6>
                <h2 style="font-size:28px;">{{ $countTransaksi }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-stat" style="background: #3577f3;">
                <h6 style="font-size:13px;">JUMLAH PESANAN DALAM PROSES</h6>
                <h2 style="font-size:28px;">{{ $countProses }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-stat" style="background: #1a4fbf;">
                <h6 style="font-size:13px;">JUMLAH PESANAN SELESAI</h6>
                <h2 style="font-size:28px;">{{ $countSelesai }}</h2>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="table-header">
            <h4 class="table-title">DATA TRANSAKSI</h4>
            <div class="d-flex align-items-center gap-3">
                <div class="search-box position-relative">
                    <i class="fa fa-search position-absolute" style="left:12px; top:13px; color:#3b82f6;"></i>
                    <input type="text" id="searchTransaksi" class="form-control" placeholder="Cari Pelanggan..."
                        style="padding-left:35px; width:260px; height:43px; font-size:16px; border:1.3px solid #3577f3; border-radius:12px;">
                </div>
                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa fa-plus me-2"></i> TAMBAH TRANSAKSI
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom" id="transaksiTable">
                <thead>
                    <tr>
                        <th>No</th>
                        @if(auth()->user()->role == 'admin')
                            <th>Outlet</th>
                        @endif
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
                            <td>{{ $no + 1 }}</td>
                            @if(auth()->user()->role == 'admin')
                                <td>{{ $t->outlet->nm_outlet ?? '-' }}</td>
                            @endif
                            <td class="nama-pelanggan">{{ $t->pelanggan->nm_pelanggan ?? '-' }}</td>
                            <td class="kode_invoice">{{ $t->kode_invoice }}</td>
                            <td>
                                @if($t->status == 'selesai')
                                    <span class="badge bg-success">{{ $t->status }}</span>
                                @else
                                    <span class="badge bg-info">{{ $t->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if($t->status_bayar == 'dibayar')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-danger">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1 align-items-center">
                                    <button class="btn btn-warning btn-action text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalDetail{{ $t->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <button class="btn btn-primary btn-action text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $t->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-action btn-hapus-transaksi" data-id="{{ $t->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <form id="form-hapus-{{ $t->id }}" action="{{ route('transaksi.destroy', $t->id) }}" method="POST" style="display:none;">
                                        @csrf @method('DELETE')
                                    </form>

                                    @if($t->status == 'selesai')
                                        <a href="{{ route('transaksi.nota', $t->id) }}" class="btn btn-success btn-action">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role == 'admin' ? 7 : 6 }}" class="text-center">
                                Belum ada data transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total_harga" id="totalHargaInput" value="0">
                    <div id="hiddenInputs"></div>
                    <input type="hidden" name="status" value="proses">
                    <input type="hidden" name="status_bayar" value="belum">
                    <input type="hidden" name="kode_invoice" value="INV-{{ date('Ymd') }}-{{ rand(100, 999) }}">

                    <h5 class="modal-title-custom mb-4" style="color: #3577f3; font-weight: bold;">TAMBAH TRANSAKSI</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="section-box p-3 border rounded mb-3">
                                <div class="section-title fw-bold text-secondary mb-2">Pelanggan & Layanan</div>
                                
                                <label class="form-label-blue">Pelanggan</label>
                                <select class="form-select mb-3" name="id_pelanggan" id="pelangganselect" required>
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($pelanggans as $p)
                                        <option value="{{ $p->id }}" data-outlet="{{ $p->id_outlet }}">{{ $p->nm_pelanggan }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label-blue">Tambah Layanan</label>
                                <select id="paketSelect" class="form-select mb-2">
                                    <option value="">Pilih Paket Cucian</option>
                                    @foreach($pakets as $paket)
                                        <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}" data-outlet="{{ $paket->id_outlet }}">
                                            {{ $paket->nm_paket }} - {{ $paket->jenis }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                <div class="d-flex gap-2">
                                    <input type="number" id="jumlahInput" class="form-control" placeholder="Qty" min="1">
                                    <button type="button" class="btn btn-primary btn-add-item" onclick="tambahKeranjang()">Add</button>
                                </div>
                            </div>

                            <div class="section-box p-3 border rounded">
                                <div class="section-title fw-bold text-secondary mb-2">Pembayaran</div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label-blue">Metode</label>
                                        <select class="form-select" name="metode_bayar">
                                            <option value="cash">Cash</option>
                                            <option value="transfer">Transfer</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label-blue">Estimasi Selesai</label>
                                        <input type="date" name="batas_waktu" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="section-title fw-bold text-secondary mb-2">Keranjang Pesanan</div>
                            <div class="cart-box p-3 border rounded bg-light mb-3" id="cartBox" style="min-height: 150px; max-height: 200px; overflow-y: auto;">
                                <div class="cart-empty text-center text-muted pt-4">
                                    <i class="fa fa-cart-shopping fa-2x mb-2"></i>
                                    <p>Keranjang Pesanan Kosong</p>
                                </div>
                            </div>

                            <div class="detail-box p-3 border rounded bg border-primary">
                                <div class="section-title fw-bold text-primary mb-2">Detail Pesanan</div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Subtotal:</span>
                                    <span id="subtotalText" class="fw-bold">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold text-dark">Total:</span>
                                    <span id="totalText" class="fw-bold text-success fs-5">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="button" class="btn-batal btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn-simpan btn btn-primary">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('transaksi.edit')
    @include('transaksi.script')
@endsection