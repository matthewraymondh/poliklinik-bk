<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    /**
     * Menampilkan form daftar poli
     */
    public function get()
    {
        $user = Auth::user();
        $polis = Poli::all();
        $jadwals = JadwalPeriksa::with(['dokter', 'dokter.poli'])->get();

        return view('pasien.daftar', compact('user', 'polis', 'jadwals'));
    }

    /**
     * Proses pendaftaran poli
     */
    public function submit(Request $request)
    {
        $request->validate([
            'id_poli' => 'required|exists:poli,id',
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string',
        ]);

        // Hitung nomor antrian berdasarkan jadwal yang sama hari ini
        $jumlahSudahDaftar = DaftarPoli::where('id_jadwal', $request->id_jadwal)
            ->whereDate('created_at', now()->toDateString())
            ->count();
        
        $noAntrian = $jumlahSudahDaftar + 1;

        DaftarPoli::create([
            'id_pasien' => Auth::id(),
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return redirect()->route('pasien.daftar')->with('success', 'Pendaftaran berhasil! Nomor antrian Anda: ' . $noAntrian);
    }
}
