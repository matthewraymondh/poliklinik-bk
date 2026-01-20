<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->latest()->get();
        return view('admin.pasien.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_ktp' => 'required|string|max:20|unique:users,no_ktp',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'password' => 'required|min:6',
        ]);

        // Generate no_rm
        $lastPatient = User::where('role', 'pasien')->orderBy('id', 'desc')->first();
        $lastNumber = $lastPatient ? intval(substr($lastPatient->no_rm, 3)) : 0;
        $no_rm = 'RM-' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'no_rm' => $no_rm,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
        ]);

        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $pasien)
    {
        return view('admin.pasien.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pasien)
    {
        return view('admin.pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pasien->id,
            'no_ktp' => 'required|string|max:20|unique:users,no_ktp,' . $pasien->id,
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'password' => 'nullable|min:6',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $pasien->update($updateData);

        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil dihapus!');
    }
}
