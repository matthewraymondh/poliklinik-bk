<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Menampilkan riwayat pemeriksaan pasien
     */
    public function index()
    {
        // Ambil data periksa berdasarkan id_pasien yang sedang login
        // Relasi: Periksa -> DaftarPoli -> Pasien (User)
        $riwayat = Periksa::with(['daftarPoli.jadwalPeriksa.dokter.poli', 'detailPeriksas.obat'])
            ->whereHas('daftarPoli', function($query) {
                $query->where('id_pasien', Auth::id());
            })
            ->orderBy('tgl_periksa', 'desc')
            ->get();

        return view('pasien.riwayat.index', compact('riwayat'));
    }

    /**
     * Menampilkan detail riwayat pemeriksaan
     */
    public function show($id)
    {
        $periksa = Periksa::with([
            'daftarPoli.jadwalPeriksa.dokter.poli', 
            'detailPeriksas.obat'
        ])
        ->whereHas('daftarPoli', function($query) {
            $query->where('id_pasien', Auth::id());
        })
        ->findOrFail($id);

        return view('pasien.riwayat.detail', compact('periksa'));
    }
}
