<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BubbleBliss Laundry')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    
    @stack('styles')
</head>
<body>

    <div class="topbar">
        <div class="logo-header">
            <img src="{{ asset('images/logoputih.png') }}" width="45">
            <span style="font-size:26px">BubbleBliss</span>
        </div>
        <div class="header-right px-4">
            <div>
                <h4 class="mb-0" style="font-size: 28px;">@yield('page_title')</h4>
                <small style="color: #5691f6; font-size: 17px;">Kelola Data Laundry Anda</small>
            </div>
            @include('partials.profile')
        </div>
    </div>

    @include('partials.sidebar')

    <div class="main">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // 1. Notifikasi Sukses (Tambah & Edit)
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2500,
                iconColor: '#28a745'
            });
        @endif

        // 2. Notifikasi Berhasil Hapus
        @if(session('deleted') || session('success_hapus'))
            Swal.fire({
                icon: 'success',
                title: 'DATA BERHASIL DIHAPUS',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    </script>

    @stack('scripts')
</body>
</html>