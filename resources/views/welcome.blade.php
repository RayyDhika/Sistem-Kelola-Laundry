<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BubbleBliss Laundry</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --blue-deep: #0a4fd4;
            --blue-main: #1a6fff;
            --blue-mid: #3d8bff;
            --blue-soft: #bed7fc;
            --blue-pale: #e8f1ff;
            --white: #ffffff;
            --text-dark: #0a1a3c;
            --text-muted: #5a7db5;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* ── BACKGROUND BLOBS ── */
        .bg-blobs {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
        }

        .blob-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, #bed7fc, #1a6fff55);
            top: -150px;
            right: -100px;
            animation: drift 12s ease-in-out infinite alternate;
        }

        .blob-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #dbeafe, #93c5fd66);
            bottom: 100px;
            left: -80px;
            animation: drift 16s ease-in-out infinite alternate-reverse;
        }

        .blob-3 {
            width: 250px;
            height: 250px;
            background: #1a6fff33;
            top: 50%;
            left: 40%;
            animation: drift 10s ease-in-out infinite alternate;
        }

        @keyframes drift {
            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(30px, 20px) scale(1.08);
            }
        }

        /* ── NAVBAR ── */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 18px 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(190, 215, 252, 0.4);
            transition: box-shadow 0.3s;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 30px rgba(26, 111, 255, 0.1);
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-logo-wrap {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--blue-main), var(--blue-deep));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(26, 111, 255, 0.35);
        }

        .nav-logo-wrap img {
            width: 26px;
            filter: brightness(0) invert(1);
        }

        .nav-brand-name {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 20px;
            color: var(--blue-deep);
            letter-spacing: -0.3px;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--blue-main), var(--blue-deep));
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 28px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            font-size: 15px;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(26, 111, 255, 0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 111, 255, 0.45);
            color: white;
        }

        /* ── HERO ── */
        .hero {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 90px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--blue-pale);
            border: 1px solid rgba(26, 111, 255, 0.2);
            border-radius: 30px;
            padding: 6px 16px;
            font-size: 13px;
            color: var(--blue-main);
            font-weight: 500;
            margin-bottom: 20px;
            animation: fadeUp 0.6s ease both;
        }

        .hero-badge .dot {
            width: 7px;
            height: 7px;
            background: var(--blue-main);
            border-radius: 50%;
            animation: pulse-dot 1.8s ease-in-out infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(0.7);
            }
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(38px, 5vw, 62px);
            line-height: 1.08;
            color: var(--text-dark);
            margin-bottom: 8px;
            animation: fadeUp 0.7s 0.1s ease both;
        }

        .hero-title .accent {
            background: linear-gradient(135deg, var(--blue-main), #00b4ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 480px;
            margin-bottom: 36px;
            animation: fadeUp 0.7s 0.2s ease both;
        }

        .hero-cta {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            animation: fadeUp 0.7s 0.3s ease both;
        }

        .btn-primary-hero {
            background: linear-gradient(135deg, var(--blue-main), var(--blue-deep));
            color: white;
            border: none;
            border-radius: 30px;
            padding: 14px 32px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            box-shadow: 0 8px 28px rgba(26, 111, 255, 0.4);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 36px rgba(26, 111, 255, 0.5);
            color: white;
        }

        .btn-ghost-hero {
            background: transparent;
            color: var(--blue-main);
            border: 1.5px solid rgba(26, 111, 255, 0.3);
            border-radius: 30px;
            padding: 14px 28px;
            font-weight: 500;
            font-size: 15px;
            text-decoration: none;
            transition: border-color 0.2s, background 0.2s;
        }

        .btn-ghost-hero:hover {
            border-color: var(--blue-main);
            background: var(--blue-pale);
            color: var(--blue-main);
        }

        /* ── HERO VISUAL ── */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeUp 0.8s 0.2s ease both;
        }

        .hero-card-main {
            background: linear-gradient(145deg, #ffffff, #f0f7ff);
            border: 1.5px solid rgba(190, 215, 252, 0.6);
            border-radius: 28px;
            padding: 32px;
            box-shadow: 0 24px 60px rgba(26, 111, 255, 0.13), 0 4px 16px rgba(26, 111, 255, 0.07);
            width: 100%;
            max-width: 380px;
            position: relative;
            z-index: 2;
        }

        .hero-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .hch-icon {
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, var(--blue-main), var(--blue-deep));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .hch-info h6 {
            font-weight: 700;
            font-size: 15px;
            margin: 0;
        }

        .hch-info span {
            font-size: 12px;
            color: var(--text-muted);
        }

        .stat-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .stat-box {
            background: var(--blue-pale);
            border-radius: 14px;
            padding: 14px 10px;
            text-align: center;
        }

        .stat-box .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: var(--blue-main);
        }

        .stat-box .stat-label {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .order-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fbff;
            border: 1px solid rgba(190, 215, 252, 0.5);
            border-radius: 12px;
            padding: 10px 14px;
        }

        .order-item .order-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .order-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .order-dot.done {
            background: #22c55e;
        }

        .order-dot.proses {
            background: #f59e0b;
        }

        .order-dot.baru {
            background: var(--blue-main);
        }

        .order-item .order-name {
            font-size: 13px;
            font-weight: 500;
        }

        .order-item .order-kg {
            font-size: 11px;
            color: var(--text-muted);
        }

        .order-item .order-price {
            font-size: 13px;
            font-weight: 600;
            color: var(--blue-deep);
        }

        /* Floating accent cards */
        .float-card {
            position: absolute;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(26, 111, 255, 0.15);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            border: 1px solid rgba(190, 215, 252, 0.5);
            z-index: 3;
            animation: floatAnim 4s ease-in-out infinite alternate;
        }

        .float-card-1 {
            top: 10px;
            left: -60px;
            animation-delay: 0s;
        }

        .float-card-2 {
            bottom: 40px;
            right: -50px;
            animation-delay: 1.5s;
        }

        @keyframes floatAnim {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-10px);
            }
        }

        .float-icon {
            font-size: 20px;
        }

        .float-text {
            line-height: 1.3;
        }

        .float-text strong {
            display: block;
            font-size: 13px;
            color: var(--text-dark);
        }

        .float-text span {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* ── SCROLL INDICATOR ── */
        .scroll-hint {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            font-size: 12px;
            animation: fadeUp 1s 0.6s ease both;
        }

        .scroll-line {
            width: 1.5px;
            height: 40px;
            background: linear-gradient(to bottom, var(--blue-soft), transparent);
            animation: scrollDrop 1.8s ease-in-out infinite;
        }

        @keyframes scrollDrop {
            0% {
                transform: scaleY(0);
                transform-origin: top;
            }

            50% {
                transform: scaleY(1);
                transform-origin: top;
            }

            51% {
                transform: scaleY(1);
                transform-origin: bottom;
            }

            100% {
                transform: scaleY(0);
                transform-origin: bottom;
            }
        }

        /* ── FEATURES SECTION ── */
        .section-features {
            position: relative;
            z-index: 1;
            padding: 100px 0 80px;
        }

        .section-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--blue-main);
            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(28px, 3.5vw, 42px);
            line-height: 1.15;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .section-desc {
            color: var(--text-muted);
            font-size: 15px;
            max-width: 500px;
            line-height: 1.7;
        }

        .feature-card {
            background: white;
            border: 1.5px solid rgba(190, 215, 252, 0.5);
            border-radius: 22px;
            padding: 32px 28px;
            height: 100%;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(26, 111, 255, 0.04), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(26, 111, 255, 0.12);
            border-color: rgba(26, 111, 255, 0.25);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon-wrap {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 20px;
        }

        .fi-blue {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        }

        .fi-sky {
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        }

        .fi-indigo {
            background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
        }

        .fi-cyan {
            background: linear-gradient(135deg, #cffafe, #a5f3fc);
        }

        .feature-card h5 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .feature-card p {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.7;
            margin: 0;
        }

        /* ── HOW IT WORKS ── */
        .section-steps {
            position: relative;
            z-index: 1;
            padding: 60px 0 100px;
        }

        .step-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 36px;
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.5s ease;
        }

        .step-item.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .step-num {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--blue-main), var(--blue-deep));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 18px;
            color: white;
            box-shadow: 0 6px 18px rgba(26, 111, 255, 0.35);
        }

        .step-content h6 {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 6px;
        }

        .step-content p {
            font-size: 14px;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.6;
        }

        .mock-report {
            background: white;
            border: 1.5px solid rgba(190, 215, 252, 0.6);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(26, 111, 255, 0.1);
        }

        .mock-report h6 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .bar-chart {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            height: 120px;
            margin-bottom: 12px;
        }

        .bar {
            flex: 1;
            border-radius: 8px 8px 0 0;
            background: linear-gradient(to top, var(--blue-main), #63b3ff);
            transition: height 0.8s ease;
            min-height: 20px;
        }

        .bar.dim {
            background: var(--blue-pale);
        }

        .bar-labels {
            display: flex;
            gap: 8px;
        }

        .bar-labels span {
            flex: 1;
            text-align: center;
            font-size: 10px;
            color: var(--text-muted);
        }

        .report-stats {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .rs-box {
            flex: 1;
            background: var(--blue-pale);
            border-radius: 12px;
            padding: 12px;
            text-align: center;
        }

        .rs-box .rs-val {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 18px;
            color: var(--blue-main);
        }

        .rs-box .rs-key {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* ── CTA SECTION ── */
        .section-cta {
            position: relative;
            z-index: 1;
            padding: 0 0 100px;
        }

        .cta-box {
            background: linear-gradient(135deg, var(--blue-deep), #0a6fff, #007acc);
            border-radius: 28px;
            padding: 60px 48px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-box::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            top: -150px;
            right: -100px;
        }

        .cta-box::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -100px;
            left: -60px;
        }

        .cta-box h2 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(26px, 4vw, 42px);
            color: white;
            margin-bottom: 16px;
            line-height: 1.15;
            position: relative;
            z-index: 1;
        }

        .cta-box p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 16px;
            margin-bottom: 32px;
            position: relative;
            z-index: 1;
        }

        .btn-cta-white {
            background: white;
            color: var(--blue-deep);
            border-radius: 30px;
            padding: 14px 36px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            z-index: 1;
            display: inline-block;
        }

        .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.28);
            color: var(--blue-deep);
        }

        /* ── FOOTER ── */
        footer {
            position: relative;
            z-index: 1;
            background: white;
            border-top: 1px solid rgba(190, 215, 252, 0.5);
            padding: 32px 0;
        }

        .footer-brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 18px;
            color: var(--blue-deep);
        }

        .footer-muted {
            color: var(--text-muted);
            font-size: 13px;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {

            .float-card-1,
            .float-card-2 {
                display: none;
            }

            .hero-visual {
                margin-top: 40px;
            }

            .cta-box {
                padding: 40px 24px;
            }
        }
    </style>
</head>

<body>

    <!-- Background Blobs -->
    <div class="bg-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- ── NAVBAR ── -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="nav-brand">
                <div class="nav-logo-wrap">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <span class="nav-brand-name">BubbleBliss</span>
            </a>
            <a href="{{ route('login') }}" class="btn-login">Login</a>
        </div>
    </nav>

    <!-- ── HERO ── -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center gy-5">

                <!-- Text -->
                <div class="col-lg-6">
                    <div class="hero-badge">
                        <span class="dot"></span>
                        Platform Laundry Digital #1
                    </div>
                    <h1 class="hero-title">
                        Kelola Laundry <br>
                        Lebih <span class="accent">Cerdas</span><br>
                        & Efisien
                    </h1>
                    <p class="hero-subtitle">
                        Platform manajemen laundry all-in-one untuk admin, kasir, dan owner. Pantau transaksi, kelola
                        pelanggan, dan lihat laporan secara real-time.
                    </p>
                    <div class="hero-cta">
                        <a href="{{ route('login') }}" class="btn-primary-hero">
                            ✦ Masuk Sekarang
                        </a>
                        <a href="#features" class="btn-ghost-hero">Lihat Fitur</a>
                    </div>
                </div>

                <!-- Visual Card -->
                <div class="col-lg-6">
                    <div class="hero-visual">

                        <!-- Floating card 1 -->
                        <div class="float-card float-card-1">
                            <span class="float-icon">🧺</span>
                            <div class="float-text">
                                <strong>Order Baru</strong>
                                <span>Diterima barusan</span>
                            </div>
                        </div>

                        <!-- Main Card -->
                        <div class="hero-card-main">
                            <div class="hero-card-header">
                                <div class="hch-icon">🫧</div>
                                <div class="hch-info">
                                    <h6>Dashboard Utama</h6>
                                    <span>Hari ini · {{ date('d M Y') }}</span>
                                </div>
                            </div>

                            <div class="stat-row">
                                <div class="stat-box">
                                    <div class="stat-num">48</div>
                                    <div class="stat-label">Pesanan</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-num">32</div>
                                    <div class="stat-label">Selesai</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-num">12</div>
                                    <div class="stat-label">Proses</div>
                                </div>
                            </div>

                            <div class="order-list">
                                <div class="order-item">
                                    <div class="order-left">
                                        <span class="order-dot done"></span>
                                        <div>
                                            <div class="order-name">Andi Kurniawan</div>
                                            <div class="order-kg">3.5 kg · Reguler</div>
                                        </div>
                                    </div>
                                    <div class="order-price">Rp 35.000</div>
                                </div>
                                <div class="order-item">
                                    <div class="order-left">
                                        <span class="order-dot proses"></span>
                                        <div>
                                            <div class="order-name">Siti Rahma</div>
                                            <div class="order-kg">5.0 kg · Express</div>
                                        </div>
                                    </div>
                                    <div class="order-price">Rp 75.000</div>
                                </div>
                                <div class="order-item">
                                    <div class="order-left">
                                        <span class="order-dot baru"></span>
                                        <div>
                                            <div class="order-name">Budi Santoso</div>
                                            <div class="order-kg">2.0 kg · Reguler</div>
                                        </div>
                                    </div>
                                    <div class="order-price">Rp 20.000</div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating card 2 -->
                        <div class="float-card float-card-2">
                            <span class="float-icon">📊</span>
                            <div class="float-text">
                                <strong>Omzet Hari Ini</strong>
                                <span>Rp 1.240.000</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll hint -->
        <div class="scroll-hint">
            <span>Gulir ke bawah</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    <!-- ── FEATURES ── -->
    <section class="section-features" id="features">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-7">
                    <div class="section-label">Fitur Unggulan</div>
                    <h2 class="section-title">Semua yang Kamu Butuhkan<br>dalam Satu Platform</h2>
                    <p class="section-desc">Dirancang khusus untuk bisnis laundry modern — dari skala kecil hingga
                        besar.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-blue">🚀</div>
                        <h5>Proses Cepat</h5>
                        <p>Pencatatan order laundry lebih cepat dan otomatis. Hemat waktu kasir hingga 70%.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-sky">🎯</div>
                        <h5>Data Akurat</h5>
                        <p>Minim kesalahan input data pelanggan dan transaksi dengan validasi sistem otomatis.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-indigo">📈</div>
                        <h5>Laporan Real-Time</h5>
                        <p>Pantau omzet harian, bulanan, dan tahunan kapan saja langsung dari dashboard.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-cyan">👥</div>
                        <h5>Multi Role</h5>
                        <p>Akses berbeda untuk Admin, Kasir, dan Owner. Setiap role punya tampilan yang sesuai.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── HOW IT WORKS ── -->
    <section class="section-steps">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <div class="section-label">Cara Kerja</div>
                    <h2 class="section-title" style="margin-bottom: 40px;">Mudah Digunakan,<br>Langsung Produktif</h2>

                    <div class="step-item" data-step>
                        <div class="step-num">1</div>
                        <div class="step-content">
                            <h6>Login ke Sistem</h6>
                            <p>Masuk dengan akun yang diberikan admin. Setiap role mendapatkan akses sesuai tugasnya.
                            </p>
                        </div>
                    </div>

                    <div class="step-item" data-step>
                        <div class="step-num">2</div>
                        <div class="step-content">
                            <h6>Catat Order Pelanggan</h6>
                            <p>Input data pelanggan, berat cucian, dan jenis layanan. Sistem otomatis menghitung total
                                biaya.</p>
                        </div>
                    </div>

                    <div class="step-item" data-step>
                        <div class="step-num">3</div>
                        <div class="step-content">
                            <h6>Pantau & Kelola Status</h6>
                            <p>Update status laundry dari antri → proses → selesai → diambil secara real-time.</p>
                        </div>
                    </div>

                    <div class="step-item" data-step>
                        <div class="step-num">4</div>
                        <div class="step-content">
                            <h6>Lihat Laporan Bisnis</h6>
                            <p>Owner dapat memantau performa bisnis melalui grafik dan laporan yang komprehensif.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mock-report">
                        <h6>📊 Laporan Pendapatan — Minggu Ini</h6>
                        <div class="bar-chart">
                            <div class="bar" style="height: 60%"></div>
                            <div class="bar" style="height: 80%"></div>
                            <div class="bar dim" style="height: 45%"></div>
                            <div class="bar" style="height: 95%"></div>
                            <div class="bar" style="height: 70%"></div>
                            <div class="bar dim" style="height: 55%"></div>
                            <div class="bar" style="height: 85%"></div>
                        </div>
                        <div class="bar-labels">
                            <span>Sen</span><span>Sel</span><span>Rab</span>
                            <span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
                        </div>
                        <div class="report-stats">
                            <div class="rs-box">
                                <div class="rs-val">284</div>
                                <div class="rs-key">Total Order</div>
                            </div>
                            <div class="rs-box">
                                <div class="rs-val">8,4 jt</div>
                                <div class="rs-key">Pendapatan</div>
                            </div>
                            <div class="rs-box">
                                <div class="rs-val">96%</div>
                                <div class="rs-key">Kepuasan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA ── -->
    <section class="section-cta">
        <div class="container">
            <div class="cta-box">
                <h2>Siap Digitalkan<br>Bisnis Laundry Kamu?</h2>
                <p>Bergabunglah dan kelola laundry lebih profesional mulai hari ini.</p>
                <a href="{{ route('login') }}" class="btn-cta-white">✦ Masuk Sekarang</a>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="footer-brand">BubbleBliss Laundry</div>
                <div class="footer-muted">© {{ date('Y') }} BubbleBliss. Hak cipta dilindungi.</div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
        });

        // Step items scroll reveal
        const steps = document.querySelectorAll('[data-step]');
        const obs = new IntersectionObserver((entries) => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    setTimeout(() => e.target.classList.add('visible'), i * 120);
                }
            });
        }, { threshold: 0.2 });
        steps.forEach(s => obs.observe(s));

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const target = document.querySelector(a.getAttribute('href'));
                if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
            });
        });
    </script>

</body>

</html>