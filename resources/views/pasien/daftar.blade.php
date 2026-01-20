<x-layouts.app title="Daftar Poli">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Poli</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/pasien/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Poli</li>
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

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Pendaftaran Poli</h3>
                </div>
                <form action="{{ route('pasien.daftar.submit') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="no_rm">Nomor Rekam Medis</label>
                            <input type="text" class="form-control" id="no_rm" 
                                   value="{{ $user->no_rm }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="id_poli">Pilih Poli <span class="text-danger">*</span></label>
                            <select class="form-control @error('id_poli') is-invalid @enderror" 
                                    id="id_poli" name="id_poli" required>
                                <option value="">-- Pilih Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}" {{ old('id_poli') == $poli->id ? 'selected' : '' }}>
                                        {{ $poli->nama_poli }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_poli')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_jadwal">Pilih Jadwal Periksa <span class="text-danger">*</span></label>
                            <select class="form-control @error('id_jadwal') is-invalid @enderror" 
                                    id="id_jadwal" name="id_jadwal" required>
                                <option value="">-- Pilih Jadwal --</option>
                                @foreach($jadwals as $jadwal)
                                    <option value="{{ $jadwal->id }}" 
                                            data-poli="{{ $jadwal->dokter->id_poli ?? '' }}"
                                            {{ old('id_jadwal') == $jadwal->id ? 'selected' : '' }}>
                                        {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }} 
                                        ({{ $jadwal->dokter->nama ?? 'Dokter tidak ditemukan' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jadwal')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keluhan">Keluhan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('keluhan') is-invalid @enderror" 
                                      id="keluhan" name="keluhan" rows="4" 
                                      placeholder="Tuliskan keluhan Anda..." required>{{ old('keluhan') }}</textarea>
                            @error('keluhan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Filter jadwal berdasarkan poli yang dipilih
        document.getElementById('id_poli').addEventListener('change', function() {
            const selectedPoli = this.value;
            const jadwalSelect = document.getElementById('id_jadwal');
            const options = jadwalSelect.querySelectorAll('option');
            
            options.forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                } else {
                    const poliId = option.getAttribute('data-poli');
                    if (selectedPoli === '' || poliId === selectedPoli) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                }
            });
            
            // Reset pilihan jadwal jika tidak sesuai
            const currentJadwal = jadwalSelect.options[jadwalSelect.selectedIndex];
            if (currentJadwal && currentJadwal.getAttribute('data-poli') !== selectedPoli && selectedPoli !== '') {
                jadwalSelect.value = '';
            }
        });

        // Auto select poli berdasarkan jadwal yang dipilih
        document.getElementById('id_jadwal').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const poliId = selectedOption.getAttribute('data-poli');
            
            if (poliId) {
                document.getElementById('id_poli').value = poliId;
            }
        });

        // Auto dismiss alert
        setTimeout(() => {
            const alert = document.getElementById('alert');
            if (alert) alert.remove();
        }, 5000);
    </script>
    @endpush
</x-layouts.app>
