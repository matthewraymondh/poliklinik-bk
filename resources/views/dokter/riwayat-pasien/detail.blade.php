<x-layouts.app title="Detail Riwayat Pasien">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Detail Riwayat Pasien</h1>
                    <a href="{{ route('dokter.riwayat-pasien.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Informasi Pasien -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Informasi Pasien</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama Pasien:</strong><br>{{ $periksa->daftarPoli->pasien->nama ?? '-' }}</p>
                                <p><strong>Email:</strong><br>{{ $periksa->daftarPoli->pasien->email ?? '-' }}</p>
                                <p><strong>No Antrian:</strong><br>{{ $periksa->daftarPoli->no_antrian }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Keluhan:</strong><br>{{ $periksa->daftarPoli->keluhan }}</p>
                                <p><strong>Poli:</strong><br>{{ $periksa->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</p>
                                <p><strong>Dokter:</strong><br>{{ $periksa->daftarPoli->jadwalPeriksa->dokter->nama ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan Dokter -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-notes-medical"></i> Detail Pemeriksaan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Tanggal Periksa:</strong><br>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y H:i') }}</p>
                                <p><strong>Biaya Periksa:</strong><br>Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Catatan Dokter:</strong></p>
                                <p>{{ $periksa->catatan ?? 'Tidak ada catatan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Obat yang Diresepkan -->
                <div class="card mb-3">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-pills"></i> Obat yang Diresepkan</h5>
                    </div>
                    <div class="card-body">
                        @if($periksa->detailPeriksas && $periksa->detailPeriksas->count() > 0)
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Kemasan</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($periksa->detailPeriksas as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $detail->obat->nama_obat ?? '-' }}</td>
                                            <td>{{ $detail->obat->kemasan ?? '-' }}</td>
                                            <td>Rp {{ number_format($detail->obat->harga ?? 0, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Tidak ada obat yang diresepkan</p>
                        @endif
                    </div>
                </div>

                <!-- Total Biaya -->
                <div class="card">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0"><i class="fas fa-money-bill"></i> Rincian Biaya</h5>
                    </div>
                    <div class="card-body text-center">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-left"><strong>Biaya Pemeriksaan:</strong></td>
                                <td class="text-right">Rp 150.000</td>
                            </tr>
                            <tr>
                                <td class="text-left"><strong>Biaya Obat:</strong></td>
                                <td class="text-right">Rp {{ number_format($periksa->biaya_periksa - 150000, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-top">
                                <td class="text-left"><strong>Total Biaya:</strong></td>
                                <td class="text-right"><strong>Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
