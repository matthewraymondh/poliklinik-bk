<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\Pasien\PoliController as PasienPoliController;
use App\Http\Controllers\Pasien\RiwayatController as PasienRiwayatController;
use App\Http\Controllers\Dokter\PeriksaPasienController;
use App\Http\Controllers\Dokter\RiwayatPasienController;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\Poli;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Awal (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// Route Autentikasi Umum
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Dashboard Berdasarkan Role

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        $totalDokter = User::where('role', 'dokter')->count();
        $totalPasien = User::where('role', 'pasien')->count();
        $totalPoli = Poli::count();
        $totalObat = Obat::count();
        return view('admin.dashboard', compact('totalDokter', 'totalPasien', 'totalPoli', 'totalObat'));
    })->name('admin.dashboard');
    
    // CRUD Poli
    Route::resource('polis', PoliController::class);
    
    // CRUD Dokter
    Route::resource('dokters', DokterController::class);
    
    // CRUD Pasien
    Route::resource('pasiens', PasienController::class);
    
    // CRUD Obat
    Route::resource('obats', ObatController::class);
});

// Dokter Routes
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        $hariIni = Carbon::now()->locale('id')->dayName;
        // Map Indonesian day names if necessary, assuming DB stores 'Senin', 'Selasa', etc.
        
        $dokterId = Auth::id();
        
        // Jadwal Hari Ini
        $jadwalHariIni = JadwalPeriksa::where('id_dokter', $dokterId)
            ->where('hari', $hariIni)
            ->count();

        // Pasien Menunggu (DaftarPoli linked to Doctor's schedule, but no Periksa record yet)
        $pasienMenunggu = DaftarPoli::whereHas('jadwalPeriksa', function($q) use ($dokterId) {
            $q->where('id_dokter', $dokterId);
        })->doesntHave('periksa')->count();

        // Selesai Diperiksa
        $selesaiDiperiksa = Periksa::whereHas('daftarPoli.jadwalPeriksa', function($q) use ($dokterId) {
            $q->where('id_dokter', $dokterId);
        })->count();

        return view('dokter.dashboard', compact('jadwalHariIni', 'pasienMenunggu', 'selesaiDiperiksa'));
    })->name('dokter.dashboard');
    
    // CRUD Jadwal Periksa
    Route::resource('jadwal-periksa', JadwalPeriksaController::class)->except(['show']);
    
    // Periksa Pasien
    Route::get('/periksa-pasien', [PeriksaPasienController::class, 'index'])->name('periksa-pasien.index');
    Route::post('/periksa-pasien', [PeriksaPasienController::class, 'store'])->name('periksa-pasien.store');
    Route::get('/periksa-pasien/{id}', [PeriksaPasienController::class, 'create'])->name('periksa-pasien.create');
    
    // Riwayat Pasien
    Route::get('/riwayat-pasien', [RiwayatPasienController::class, 'index'])->name('dokter.riwayat-pasien.index');
    Route::get('/riwayat-pasien/{id}', [RiwayatPasienController::class, 'show'])->name('dokter.riwayat-pasien.show');
});

// Pasien Routes
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        $pasienId = Auth::id();
        
        // Pendaftaran Aktif (DaftarPoli without Periksa)
        $pendaftaranAktif = DaftarPoli::where('id_pasien', $pasienId)
            ->doesntHave('periksa')
            ->count();
            
        // Riwayat Periksa
        $riwayatPeriksa = DaftarPoli::where('id_pasien', $pasienId)
            ->has('periksa')
            ->count();
            
        // Nomor Antrian Terakhir (Active)
        $latestDaftar = DaftarPoli::where('id_pasien', $pasienId)
            ->doesntHave('periksa')
            ->latest()
            ->first();
            
        $nomorAntrian = $latestDaftar ? $latestDaftar->no_antrian : null;

        return view('pasien.dashboard', compact('pendaftaranAktif', 'riwayatPeriksa', 'nomorAntrian'));
    })->name('pasien.dashboard');
    
    // Daftar Poli
    Route::get('/daftar-poli', [PasienPoliController::class, 'get'])->name('pasien.daftar');
    Route::post('/daftar-poli', [PasienPoliController::class, 'submit'])->name('pasien.daftar.submit');
    
    // Riwayat Periksa
    Route::get('/riwayat', [PasienRiwayatController::class, 'index'])->name('pasien.riwayat.index');
    Route::get('/riwayat/{id}', [PasienRiwayatController::class, 'show'])->name('pasien.riwayat.show');
});
