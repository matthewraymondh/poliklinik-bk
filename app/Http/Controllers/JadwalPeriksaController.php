<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())
            ->orderBy('hari')
            ->get();
        return view('dokter.jadwal-periksa.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal periksa berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPeriksa $jadwal_periksa)
    {
        // Pastikan jadwal milik dokter yang login
        if ($jadwal_periksa->id_dokter !== Auth::id()) {
            abort(403);
        }
        
        return view('dokter.jadwal-periksa.edit', compact('jadwal_periksa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPeriksa $jadwal_periksa)
    {
        // Pastikan jadwal milik dokter yang login
        if ($jadwal_periksa->id_dokter !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $jadwal_periksa->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal periksa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPeriksa $jadwal_periksa)
    {
        // Pastikan jadwal milik dokter yang login
        if ($jadwal_periksa->id_dokter !== Auth::id()) {
            abort(403);
        }

        $jadwal_periksa->delete();
        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal periksa berhasil dihapus!');
    }
}
