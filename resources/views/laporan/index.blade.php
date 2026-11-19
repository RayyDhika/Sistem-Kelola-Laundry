<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Laporan - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
</head>

<body>

    <div class="topbar">
        <div class="logo-header">
            <img src="{{ asset('images/logoputih.png') }}" width="45">
            <span style="font-size: 26px;">BubbleBliss</span>
        </div>
        <div class="header-right px-4">
            <div>
                <h4 class="mb-0" style="font-size: 28px; text-transform: uppercase;">

                    @if(auth()->user()->role == 'admin')
                        Generate Laporan
                    @else
                        Generate Laporan {{ auth()->user()->outlet->nm_outlet ?? '-' }}
                    @endif

                </h4>

                <small style="color: #5691f6; font-size: 17px;">

                    @if(auth()->user()->role == 'admin')
                        Buat Dan Lihat Laporan
                    @else
                        Buat Dan Lihat Laporan {{ auth()->user()->outlet->nm_outlet ?? '-' }}
                    @endif

                </small>
            </div>
    @include('partials.profile')
            </div>

        </div>
    </div>

    @include('partials.sidebar')

    <div class="main">
        <p class="text-primary mb-3" style="font-size: 16px;">Silahkan Untuk Melengkapi Terlebih Dahulu Untuk
            Lanjut</p>

        <div class="card-filter mb-4">
            <form action="
        @if(auth()->user()->role == 'kasir')
            {{ route('kasir.laporan') }}
        @elseif(auth()->user()->role == 'owner')
            {{ route('owner.dashboard') }}
        @else
            {{ route('laporan.index') }}
        @endif   
            " method="GET">
                <div class="row align-items-end g-3">

                    @if(auth()->user()->role == 'admin')

                        <div class="col-md-3">
                            <label class="form-label-blue mb-2">Outlet</label>

                            <select name="id_outlet" class="form-control shadow-sm py-2"
                                style="border: 1.5px solid #3577f3; font-family: arial;">
                                <option value="">Semua Outlet</option>

                                @foreach($outlets as $outlet)
                                    <option value="{{ $outlet->id }}" {{ ($id_outlet ?? '') == $outlet->id ? 'selected' : '' }}>
                                        {{ $outlet->nm_outlet }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label-blue mb-2">Tanggal Awal</label>
                            <input type="text" name="tanggal_awal" value="{{ $tanggal_awal ?? '' }}"
                                placeholder="Pilih Tanggal Awal..." class="form-control shadow-sm py-2 text-primary"
                                style="border: 1.5px solid #3577f3; font-family: arial;" onfocus="(this.type='date')"
                                onblur="if(!this.value) this.type='text'" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label-blue mb-2">Tanggal Akhir</label>
                            <input type="text" name="tanggal_akhir" value="{{ $tanggal_akhir ?? '' }}"
                                placeholder="Pilih Tanggal Akhir..." class="form-control shadow-sm py-2 text-primary"
                                style="border: 1.5px solid #3577f3; font-family: arial;" onfocus="(this.type='date')"
                                onblur="if(!this.value) this.type='text'" required>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn-tampilkan py-2">
                                TAMPILKAN
                            </button>
                        </div>

                    @else

                        <div class="col-md-4">
                            <label class="form-label-blue mb-2">Tanggal Awal</label>
                            <input type="text" name="tanggal_awal" value="{{ $tanggal_awal ?? '' }}"
                                placeholder="Pilih Tanggal Awal..." class="form-control shadow-sm py-2 text-primary"
                                style="border: 1.5px solid #3577f3; font-family: arial;" onfocus="(this.type='date')"
                                onblur="if(!this.value) this.type='text'" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label-blue mb-2">Tanggal Akhir</label>
                            <input type="text" name="tanggal_akhir" value="{{ $tanggal_akhir ?? '' }}"
                                placeholder="Pilih Tanggal Akhir..." class="form-control shadow-sm py-2 text-primary"
                                style="border: 1.5px solid #3577f3; font-family: arial;" onfocus="(this.type='date')"
                                onblur="if(!this.value) this.type='text'" required>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn-tampilkan py-2">
                                TAMPILKAN
                            </button>
                        </div>

                    @endif

                </div>
            </form>
        </div>

        @php
            $totalPendapatan = isset($transaksi) ? $transaksi->sum('total_harga') : 0;
            $jumlahTransaksi = isset($transaksi) ? $transaksi->count() : 0;
            $rataRata = $jumlahTransaksi > 0
                ? $totalPendapatan / $jumlahTransaksi
                : 0;
        @endphp

        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card-stat" style="background:#6da8ff;">
                    <h6>TOTAL PENDAPATAN</h6>
                    <h2>
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-stat" style="background:#3577f3;">
                    <h6>JUMLAH TRANSAKSI</h6>
                    <h2>
                        {{ $jumlahTransaksi }}
                    </h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-stat" style="background:#1a4fbf;">
                    <h6>RATA-RATA TRANSAKSI</h6>
                    <h2>
                        Rp {{ number_format($rataRata, 0, ',', '.') }}
                    </h2>
                </div>
            </div>

        </div>

        <div class="card-table">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold m-0 text-uppercase">Data Laporan Menyeluruh</h5>

                <div class="d-flex align-items-center gap-2"></div>

                @if(isset($tanggal_awal) && isset($tanggal_akhir) && $tanggal_awal && $tanggal_akhir)
                    <span class="badge bg-primary px-3 py-2">
                        Periode:
                        {{ \Carbon\Carbon::parse($tanggal_awal)->format('d/m/Y') }} s/d
                        {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d/m/Y') }}
                    </span>

                    @if(auth()->user()->role == 'kasir')

                                <a href="{{ route('kasir.laporan.cetak', [
                            'tanggal_awal' => $tanggal_awal,
                            'tanggal_akhir' => $tanggal_akhir
                        ]) }}" class="btn btn-danger">

                    @elseif(auth()->user()->role == 'owner')

                                        <a href="{{ route('owner.laporan.cetak', [
                                'tanggal_awal' => $tanggal_awal,
                                'tanggal_akhir' => $tanggal_akhir
                            ]) }}" class="btn btn-danger">

                        @else

                                                <a href="{{ route('laporan.cetak', [
                                    'tanggal_awal' => $tanggal_awal,
                                    'tanggal_akhir' => $tanggal_akhir,
                                    'id_outlet' => $id_outlet
                                ]) }}" class="btn btn-danger">

                            @endif

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

                        @if(isset($tanggal_awal) && isset($tanggal_akhir) && $tanggal_awal && $tanggal_akhir)

                            @forelse($transaksi as $key => $t)

                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>
                                        <b class="text-dark">
                                            {{ $t->kode_invoice ?? 'INV-' . $t->id }}
                                        </b>
                                    </td>

                                    <td>
                                        {{ $t->pelanggan->nm_pelanggan ?? 'Umum' }}
                                    </td>

                                    <td>
                                        @foreach($t->details as $detail)
                                            {{ $detail->paket->nm_paket ?? '-' }}@if(!$loop->last),@endif<br>
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
@include('laporan.script')

</body>

</html>