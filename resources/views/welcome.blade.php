<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Horizon Health') }} - Layanan Kesehatan Terpercaya</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --accent-color: #3fbbc0;
        }
        
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section {
            background: linear-gradient(rgba(24, 61, 93, 0.8), rgba(24, 61, 93, 0.7)), url('{{ asset("images/landing_hero.png") }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
        }

        .navbar {
            transition: all 0.3s;
            padding: 1rem 0;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: #333 !important;
            font-size: 1.5rem;
        }
        
        .navbar-brand i {
            color: var(--primary-color);
        }

        .nav-link {
            font-weight: 500;
            color: #555 !important;
            margin: 0 10px;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-medical {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }

        .btn-medical:hover {
            background-color: #0b5ed7;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }

        .feature-box {
            background: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
            height: 100%;
            text-align: center;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .footer {
            background-color: #1a1a1a;
            color: white;
            padding: 50px 0 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-heartbeat me-2"></i>HORIZON HEALTH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item ms-2">
                                <a href="{{ url('/dashboard') }}" class="btn btn-medical">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item ms-2">
                                <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item ms-2">
                                    <a href="{{ route('register') }}" class="btn btn-medical">Daftar</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Layanan Kesehatan Terpercaya untuk Anda</h1>
                    <p class="lead mb-5">Kami menyediakan pelayanan dokter spesialis terbaik dengan kemudahan pendaftaran online. Kesehatan Anda adalah prioritas kami.</p>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-medical btn-lg">Ke Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-medical btn-lg me-3">Daftar Berobat Sekarang</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="layanan" class="py-5">
        <div class="container py-5">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold">Layanan Utama Kami</h2>
                    <p class="text-muted">Kemudahan akses layanan kesehatan dalam satu aplikasi</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
                        <h4>Jadwal Dokter</h4>
                        <p>Cek jadwal praktek dokter spesialis kami yang terupdate setiap harinya.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                        <h4>Daftar Online</h4>
                        <p>Daftar konsultasi tanpa antri panjang melalui sistem pendaftaran online kami.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-file-medical"></i></div>
                        <h4>Riwayat Medis</h4>
                        <p>Akses riwayat pemeriksaan dan catatan medis Anda dengan aman dan mudah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://img.freepik.com/free-photo/group-medical-staff-carrying-health-related-icons_53876-125842.jpg" class="img-fluid rounded shadow" alt="Tentang Kami">
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h2 class="fw-bold mb-4">Tentang Horizon Health</h2>
                    <p class="lead text-muted">Mengutamakan pelayanan yang ramah, cepat, dan profesional.</p>
                    <p>Poliklinik kami didukung oleh tenaga medis profesional dan fasilitas modern. Kami berkomitmen untuk memberikan pengalaman berobat yang nyaman dan efisien bagi setiap pasien.</p>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Dokter Spesialis Berpengalaman</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Pelayanan 24 Jam</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Fasilitas Modern</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="mb-0">&copy; {{ date('Y') }} <strong>Horizon Health</strong>. All rights reserved.</p>
                    <small class="text-white-50">Created by Matthew Raymond Hartono, A11.2021.13275</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
