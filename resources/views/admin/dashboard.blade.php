<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin - BubbleBliss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
</head>

<body>

    <div class="topbar">

        <div class="logo-header">
            <img src="{{ asset('images/logoputih.png') }}" width="45">
            <span style="font-size:26px">BubbleBliss</span>
        </div>

        <div class="header-right px-4">

            <div>
                <h4 class="mb-0" style="color: #0650d1; font-size: 28px;">
                    BERANDA
                </h4>

                <small style="color: #5691f6; font-size: 17px;">
                    Kelola Data Laundry Anda
                </small>
            </div>
            @include('partials.profile')
        </div>
    </div>


    @include('partials.sidebar')

    <!-- MAIN -->
    <div class="main">

        <div class="welcome-card">
            <h4 class="mb-1" style="color: #0650d1; font-size: 28px;">
                Halo, {{ auth()->user()->name }}!
            </h4>

            <p class="mb-0" style="color: #5691f6">
                Selamat Datang Di Halaman Admin
                {{ auth()->user()->outlet->nm_outlet ?? '-' }}
            </p>
        </div>

        <div class="row mb-4">

            <!-- KOLOM KIRI -->
            <div class="col-md-4">

                <!-- Pendapatan -->
                <div class="card-stat mb-3" style="background:#3577f3;">
                    <h6>Pendapatan Bulan Ini</h6>
                    <h2>
                        Rp {{ number_format($pendapatanBulanIni ?? 0, 0, ',', '.') }}
                    </h2>
                </div>

                <!-- Total Pesanan -->
                <div class="card-stat" style="background:#1a4fbf;">
                    <h6>Total Pesanan Bulan Ini</h6>
                    <h2>
                        {{ $totalPesanan ?? 0 }}
                    </h2>
                </div>

            </div>

            <!-- KOLOM KANAN -->
            <div class="col-md-8">

                <div class="bg-white rounded-4 shadow-sm p-4 h-100">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">
                            Transaksi Terbaru
                        </h5>

                        <i class="fa fa-ellipsis-h text-secondary"></i>
                    </div>

                    @if($transaksiTerakhir->count())

                        @foreach($transaksiTerakhir as $trx)

                            <div class="d-flex align-items-center justify-content-between py-2 border-bottom">

                                <div class="d-flex align-items-center gap-3">

                                    <div style="
                                                                        width:45px;
                                                                        height:45px;
                                                                        background:#f3f4f6;
                                                                        border-radius:10px;
                                                                        display:flex;
                                                                        align-items:center;
                                                                        justify-content:center;
                                                                    ">
                                        <i class="fa fa-shirt text-secondary"></i>
                                    </div>

                                    <div>

                                        <div class="fw-bold text-dark" style="font-family: Arial, Helvetica, sans-serif">
                                            {{ $trx->pelanggan->nm_pelanggan ?? '-' }}
                                        </div>

                                        <small class="text-secondary" style="font-family: Arial, Helvetica, sans-serif">
                                            {{ $trx->outlet->nm_outlet ?? 'outlet'  }} -
                                            {{ \Carbon\Carbon::parse($trx->tgl_masuk)->format('d M Y') }}
                                        </small>

                                    </div>

                                </div>

                                <div class="text-end">

                                    @if($trx->status == 'selesai')

                                        <span class="badge bg-success rounded-pill px-3 py-2" style="text-white">
                                            Selesai
                                        </span>

                                    @else

                                        <span class="badge bg-info rounded-pill px-3 py-2" style="text-white">
                                            Proses
                                        </span>

                                    @endif

                                    <div class="small text-secondary mt-1" style="font-family: Arial, Helvetica, sans-serif">
                                        {{ $trx->kode_invoice }}
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @else

                        <div class="text-center py-5 text-secondary" style="font-family: Arial, Helvetica, sans-serif;">
                            Belum ada transaksi
                        </div>

                    @endif

@include('admin.script')
</body>

</html>