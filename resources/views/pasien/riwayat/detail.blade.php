<x-layouts.app title="Detail Riwayat Periksa">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Detail Riwayat Periksa</h1>
                    <a href="{{ route('pasien.riwayat.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Informasi Pemeriksaan -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Informasi Pemeriksaan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Tanggal Periksa:</strong><br>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y') }}</p>
                                <p><strong>Poli:</strong><br>{{ $periksa->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Dokter:</strong><br>{{ $periksa->daftarPoli->jadwalPeriksa->dokter->nama ?? '-' }}</p>
                                <p><strong>Keluhan Pasien:</strong><br>{{ $periksa->daftarPoli->keluhan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan & Obat -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-notes-medical"></i> Hasil Pemeriksaan</h5>
                    </div>
                    <div class="card-body">
                         <div class="mb-4">
                            <h6><strong>Catatan Dokter:</strong></h6>
                            <p class="alert alert-light border">{{ $periksa->catatan }}</p>
                        </div>

                        <h6><strong>Obat yang Diresepkan:</strong></h6>
                        @if($periksa->detailPeriksas->count() > 0)
                            <table class="table table-sm table-bordered">
                                <thead class="thead-light">
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
                                            <td>{{ $detail->obat->nama_obat }}</td>
                                            <td>{{ $detail->obat->kemasan }}</td>
                                            <td>Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Tidak ada obat yang diresepkan.</p>
                        @endif
                    </div>
                </div>

                <!-- Rincian Biaya -->
                <div class="card">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0"><i class="fas fa-money-bill-wave"></i> Rincian Biaya</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>Biaya Jasa Dokter</td>
                                <td class="text-right">Rp 150.000</td>
                            </tr>
                            <tr>
                                <td>Biaya Obat</td>
                                <td class="text-right">Rp {{ number_format($periksa->biaya_periksa - 150000, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-top font-weight-bold">
                                <td>Total Biaya</td>
                                <td class="text-right text-primary" style="font-size: 1.2rem;">
                                    Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
