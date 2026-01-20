<x-layouts.app title="Dashboard Pasien">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Welcome Card -->
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-warning">
                        <h5><i class="fas fa-user"></i> Selamat Datang, {{ Auth::user()->nama }}!</h5>
                        <p>Anda login sebagai Pasien. Daftar poli dan lihat riwayat pemeriksaan dari dashboard ini.</p>
                    </div>
                </div>
            </div>

            <!-- Info Card - No RM -->
            <div class="row">
                <div class="col-12">
                    <div class="info-box bg-gradient-primary">
                        <span class="info-box-icon"><i class="fas fa-id-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Nomor Rekam Medis Anda</span>
                            <span class="info-box-number">{{ Auth::user()->no_rm ?? 'Belum tersedia' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $pendaftaranAktif }}</h3>
                            <p>Pendaftaran Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <a href="/pasien/daftar-poli" class="small-box-footer">
                            Daftar Sekarang <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $riwayatPeriksa }}</h3>
                            <p>Riwayat Periksa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <a href="/pasien/riwayat" class="small-box-footer">
                            Lihat Riwayat <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $nomorAntrian ?? '-' }}</h3>
                            <p>Nomor Antrian</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <span class="small-box-footer">
                            {{ $nomorAntrian ? 'Antrian Aktif' : 'Belum ada antrian' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
