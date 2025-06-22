<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hewan;
use Illuminate\Support\Facades\Auth;

class HewanPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hewans = Hewan::where('id_user', Auth::id())->get();
        return view('pelanggan.hewans.index', compact('hewans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.hewans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'umur' => 'required|integer',
            'catatan' => 'nullable',
        ]);
        $validated['id_user'] = Auth::id();
        Hewan::create($validated);
        return redirect()->route('pelanggan.hewans.index')->with('success', 'Hewan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hewan = Hewan::where('id', $id)->where('id_user', Auth::id())->firstOrFail();
        return view('pelanggan.hewans.show', compact('hewan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hewan = Hewan::where('id', $id)->where('id_user', Auth::id())->firstOrFail();
        return view('pelanggan.hewans.edit', compact('hewan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hewan = Hewan::where('id', $id)->where('id_user', Auth::id())->firstOrFail();
        $validated = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'umur' => 'required|integer',
            'catatan' => 'nullable',
        ]);
        $hewan->update($validated);
        return redirect()->route('pelanggan.hewans.index')->with('success', 'Hewan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hewan = Hewan::where('id', $id)->where('id_user', Auth::id())->firstOrFail();
        $hewan->delete();
        return redirect()->route('pelanggan.hewans.index')->with('success', 'Hewan berhasil dihapus');
    }
}
