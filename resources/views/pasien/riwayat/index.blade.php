<x-layouts.app title="Riwayat Periksa">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Riwayat Periksa</h1>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Poli</th>
                                        <th>Dokter</th>
                                        <th>Biaya Periksa</th>
                                        <th>Catatan</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayat as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d/m/Y') }}</td>
                                            <td>{{ $item->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</td>
                                            <td>{{ $item->daftarPoli->jadwalPeriksa->dokter->nama ?? '-' }}</td>
                                            <td>Rp {{ number_format($item->biaya_periksa, 0, ',', '.') }}</td>
                                            <td>{{ $item->catatan }}</td>
                                            <td>
                                                <a href="{{ route('pasien.riwayat.show', $item->id) }}" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada riwayat pemeriksaan</td>
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
</x-layouts.app>
