<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokters = User::where('role', 'dokter')->with('poli')->latest()->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_ktp' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'id_poli' => 'required|exists:poli,id',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'id_poli' => $request->id_poli,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
        ]);

        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $dokter)
    {
        return view('admin.dokter.show', compact('dokter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dokter->id,
            'no_ktp' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'id_poli' => 'required|exists:poli,id',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'id_poli' => $request->id_poli,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $dokter->update($data);

        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil dihapus!');
    }
}
