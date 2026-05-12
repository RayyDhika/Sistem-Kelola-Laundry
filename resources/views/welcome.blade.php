<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BubbleBliss Laundry</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to left, #ffffff, #bed7fc);
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-text h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 1000;
            color: #0d6efd;
            line-height: 1.1;
            font-size: 60px;
        }

        .hero-text p {
            color: #0095d1;
        }

        .btn-login {
            background-color: #0d6efd;
            color: white;
            border-radius: 30px;
            padding: 10px 30px;
        }

        .btn-login:hover {
            background-color: #0b5ed7;
        }

        .card-feature {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card-feature:hover {
            transform: translateY(-5px);
        }

        .logo-img {
            width: 40px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        
        <!-- Logo + Text -->
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img me-2">
            <span class="navbar-brand fw-bold text-primary mb-0">BubbleBliss</span>
        </div>

        <!-- Button -->
        <a href="{{ route('login') }}" class="btn btn-login">Login</a>

    </div>
</nav>

<!-- Hero Section -->
<div class="container hero">
    <div class="row align-items-center">
        
        <!-- Text -->
        <div class="col-md-6 hero-text">
            <h1>BubbleBliss Laundry Digital</h1>
            <p class="mt-3">
               Platform manajemen laundry all-in-one untuk admin, kasir, dan owner. Pantau transaksi, kelola pelanggan, dan lihat laporan secara real-time.
            </p>

            <a href="{{ route('login') }}" class="btn btn-login mt-3">
                Masuk Sekarang
            </a>
        </div>

        <!-- image -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="400">
        </div>

    </div>
</div>

<!-- Features -->
<div class="container mb-5">
    <div class="row text-center">
        
        <div class="col-md-4">
            <div class="card card-feature p-4 shadow-sm">
                <h5 class="text-primary">Cepat</h5>
                <p>Proses pencatatan laundry lebih cepat dan otomatis.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-feature p-4 shadow-sm">
                <h5 class="text-primary">Akurat</h5>
                <p>Minim kesalahan dalam pencatatan data pelanggan.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-feature p-4 shadow-sm">
                <h5 class="text-primary">Digital</h5>
                <p>Semua data tersimpan aman dalam sistem.</p>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="text-center py-3 text-muted">
    © {{ date('Y') }} BubbleBliss Laundry
</footer>

</body>
</html>