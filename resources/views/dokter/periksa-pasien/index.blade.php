<x-layouts.app title="Periksa Pasien">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mb-4">Periksa Pasien</h1>

                {{-- ALERT FLASH MESSAGE --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible fade show" role="alert">
                        <strong>{{ session('type') == 'danger' ? 'Error!' : 'Berhasil!' }}</strong>
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pasien</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Pasien</th>
                                        <th>Keluhan</th>
                                        <th>No Antrian</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($daftarPasien as $dp)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dp->pasien->nama ?? '-' }}</td>
                                            <td>{{ $dp->keluhan }}</td>
                                            <td>{{ $dp->no_antrian }}</td>
                                            <td>
                                                @if ($dp->periksas->isNotEmpty())
                                                    <span class="badge badge-success">Sudah Diperiksa</span>
                                                @else
                                                    <a href="{{ route('periksa-pasien.create', $dp->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Periksa
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data pasien periksa.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 200);
            }
        }, 3000);
    </script>
    @endpush
</x-layouts.app>
