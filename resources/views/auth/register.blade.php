<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Horizon Health</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --accent-color: #3fbbc0;
        }
        
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #fff;
            height: 100vh;
            overflow: hidden;
        }

        .split-screen {
            display: flex;
            height: 100%;
        }

        .left-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background-color: white;
            position: relative;
            overflow-y: auto; 
        }

        .right-panel {
            flex: 1;
            background: linear-gradient(rgba(13, 110, 253, 0.2), rgba(13, 110, 253, 0.4)), url('{{ asset("images/auth_side_panel.png") }}');
            background-size: cover;
            background-position: center;
            display: none;
        }

        @media (min-width: 992px) {
            .right-panel {
                display: block;
            }
        }

        .register-card {
            width: 100%;
            max-width: 500px;
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 2rem;
            display: block;
            text-decoration: none;
        }
        
        .brand-logo i {
            color: var(--primary-color);
        }

        .form-floating:focus-within {
            z-index: 2;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: #6c757d;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-link:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>

    <div class="split-screen">
        <!-- Left Panel: Form -->
        <div class="left-panel">
            <a href="/" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>

            <div class="register-card">
                <a href="/" class="brand-logo text-center pt-2">
                    <i class="fas fa-heartbeat me-2"></i>HORIZON HEALTH
                </a>
                
                <h3 class="mb-4 fw-bold text-center">Registrasi Pasien</h3>
                <p class="text-muted text-center mb-4">Isi data diri Anda untuk membuat akun baru.</p>

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        @foreach ($errors->all() as $error)
                            <div><i class="fas fa-exclamation-circle me-2"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="/register" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                        <label for="nama">Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="alamat" class="form-control" id="alamat" placeholder="Alamat" style="height: 100px" required>{{ old('alamat') }}</textarea>
                        <label for="alamat">Alamat Lengkap</label>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="no_ktp" class="form-control" id="no_ktp" placeholder="Nomor KTP" value="{{ old('no_ktp') }}" required>
                                <label for="no_ktp">Nomor KTP</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP" value="{{ old('no_hp') }}" required>
                                <label for="no_hp">Nomor HP</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="email">Email Address</label>
                    </div>

                    <div class="row g-2 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" required>
                                <label for="password_confirmation">Konfirmasi Password</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">Daftar Sekarang</button>
                    
                    <div class="text-center pb-4">
                        <span class="text-muted">Sudah punya akun?</span> 
                        <a href="/login" class="fw-bold text-decoration-none">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Panel: Image -->
        <div class="right-panel"></div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
