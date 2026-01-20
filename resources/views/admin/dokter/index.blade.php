<x-layouts.app title="Kelola Dokter">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Dokter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dokter</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" id="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" id="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Dokter</h3>
                    <div class="card-tools">
                        <a href="{{ route('dokters.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Dokter
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 50px">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Poli</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dokters as $index => $dokter)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dokter->nama }}</td>
                                    <td>{{ $dokter->email }}</td>
                                    <td>{{ $dokter->no_hp }}</td>
                                    <td>
                                        @if($dokter->poli)
                                            <span class="badge badge-info">{{ $dokter->poli->nama_poli }}</span>
                                        @else
                                            <span class="badge badge-secondary">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('dokters.edit', $dokter) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('dokters.destroy', $dokter) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data dokter</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert');
            if (alert) alert.remove();
        }, 3000);
    </script>
    @endpush
</x-layouts.app>
