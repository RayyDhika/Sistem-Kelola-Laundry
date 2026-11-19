<div class="sidebar text-white">

    @if(auth()->user()->role == 'owner')

        <div class="menu-title-main">MENU UTAMA</div>

        <a href="{{ route('owner.dashboard') }}" 
            class="menu-link {{ request()->routeIs('owner.dashboard') ? 'active-menu' : '' }}">
            <i class="fa fa-file-text"></i> Laporan
        </a>

    @else

        <div class="menu-title-main">MENU UTAMA</div>

        {{-- BERANDA --}}
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active-menu' : '' }}">
                <i class="fa fa-home"></i> Beranda
            </a>
        @else
            <a href="{{ route('kasir.dashboard') }}"
                class="menu-link {{ request()->routeIs('kasir.dashboard') ? 'active-menu' : '' }}">
                <i class="fa fa-home"></i> Beranda
            </a>
        @endif

        <div class="menu-title-main">TRANSAKSI</div>

        {{-- Register Pelanggan --}}
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('pelanggan.index') }}"
                class="menu-link {{ request()->routeIs('pelanggan.*') ? 'active-menu' : '' }}">
                <i class="fa fa-user-plus"></i> Register Pelanggan
            </a>

            <a href="{{ route('transaksi.index') }}"
                class="menu-link {{ request()->routeIs('transaksi.*') ? 'active-menu' : '' }}">
                <i class="fa fa-cart-plus"></i> Entri Transaksi
            </a>
        @else
            <a href="{{ route('kasir.pelanggan') }}"
                class="menu-link {{ request()->routeIs('kasir.pelanggan*') ? 'active-menu' : '' }}">
                <i class="fa fa-user-plus"></i> Register Pelanggan
            </a>

            <a href="{{ route('kasir.transaksi') }}"
                class="menu-link {{ request()->routeIs('kasir.transaksi*') ? 'active-menu' : '' }}">
                <i class="fa fa-cart-plus"></i> Entri Transaksi
            </a>
        @endif

        {{-- DATA ADMIN --}}
        @if(auth()->user()->role == 'admin')
            <div class="menu-title-main">DATA</div>

            <a href="{{ route('user.index') }}" class="menu-link {{ request()->routeIs('user.*') ? 'active-menu' : '' }}">
                <i class="fa fa-user"></i> Data Pengguna
            </a>

            <a href="{{ route('outlet.index') }}" class="menu-link {{ request()->routeIs('outlet.*') ? 'active-menu' : '' }}">
                <i class="fa fa-shop"></i> Data Outlet
            </a>

            <a href="{{ route('paket.index') }}" class="menu-link {{ request()->routeIs('paket.*') ? 'active-menu' : '' }}">
                <i class="fa fa-box"></i> Data Paket
            </a>
        @endif

        <div class="menu-title-main">LAINNYA</div>

        {{-- LAPORAN UNTUK ADMIN & KASIR (SUDAH DIPERBAIKI IKON DAN AKTIF MENU) --}}
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('laporan.index') }}" 
                class="menu-link {{ request()->routeIs('laporan.*') ? 'active-menu' : '' }}">
                <i class="fa fa-file-text"></i> Laporan
            </a>
        @elseif(auth()->user()->role == 'kasir')
            <a href="{{ route('kasir.laporan') }}" 
                class="menu-link {{ request()->routeIs('kasir.laporan') ? 'active-menu' : '' }}">
                <i class="fa fa-file-text"></i> Laporan
            </a>
        @endif

    @endif

</div>