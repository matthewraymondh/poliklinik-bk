<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <i class="fas fa-hospital-alt brand-image ml-3" style="font-size: 24px;"></i>
        <span class="brand-text font-weight-light">Poliklinik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-user-circle fa-2x text-light"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
                <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                @if(Auth::user()->role == 'admin')
                <!-- Admin Menu -->
                <li class="nav-header">ADMIN MENU</li>
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/dokters" class="nav-link {{ request()->is('admin/dokters*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Kelola Dokter</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/pasiens" class="nav-link {{ request()->is('admin/pasiens*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Kelola Pasien</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/polis" class="nav-link {{ request()->is('admin/polis*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hospital"></i>
                        <p>Kelola Poli</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/obats" class="nav-link {{ request()->is('admin/obats*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>Kelola Obat</p>
                    </a>
                </li>

                @elseif(Auth::user()->role == 'dokter')
                <!-- Dokter Menu -->
                <li class="nav-header">DOKTER MENU</li>
                <li class="nav-item">
                    <a href="/dokter/dashboard" class="nav-link {{ request()->is('dokter/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dokter/jadwal-periksa" class="nav-link {{ request()->is('dokter/jadwal-periksa*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Jadwal Periksa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dokter/periksa-pasien" class="nav-link {{ request()->is('dokter/periksa-pasien*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>Periksa Pasien</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dokter/riwayat-pasien" class="nav-link {{ request()->is('dokter/riwayat-pasien*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Pasien</p>
                    </a>
                </li>

                @elseif(Auth::user()->role == 'pasien')
                <!-- Pasien Menu -->
                <li class="nav-header">PASIEN MENU</li>
                <li class="nav-item">
                    <a href="/pasien/dashboard" class="nav-link {{ request()->is('pasien/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pasien/daftar-poli" class="nav-link {{ request()->is('pasien/daftar-poli*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Daftar Poli</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pasien/riwayat" class="nav-link {{ request()->is('pasien/riwayat*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Periksa</p>
                    </a>
                </li>
                @endif

                <!-- Logout -->
                <li class="nav-header">AKUN</li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
