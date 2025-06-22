<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Hewan;
use App\Models\Layanan;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = Pesanan::with(['user', 'hewan', 'layanan'])->get();
        return view('admin.pesanans.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $hewans = Hewan::all();
        $layanans = Layanan::all();
        return view('admin.pesanans.create', compact('users', 'hewans', 'layanans'));
    }

    /**
     * Get hewan berdasarkan user
     */
    public function getHewanByUser($id_user)
    {
        $hewans = Hewan::where('id_user', $id_user)->get();
        return response()->json($hewans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_hewan' => 'required|exists:hewans,id',
            'id_layanan' => 'required|exists:layanans,id',
            'tanggal_layanan' => 'required|date',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date',
            'status_pembayaran' => 'required',
            'status_pesanan' => 'required',
            'catatan' => 'nullable',
        ]);
        Pesanan::create($validated);
        return redirect()->route('admin.pesanans.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'hewan', 'layanan'])->findOrFail($id);
        return view('admin.pesanans.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $users = User::all();
        $hewans = Hewan::all();
        $layanans = Layanan::all();
        return view('admin.pesanans.edit', compact('pesanan', 'users', 'hewans', 'layanans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_hewan' => 'required|exists:hewans,id',
            'id_layanan' => 'required|exists:layanans,id',
            'tanggal_layanan' => 'required|date',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date',
            'status_pembayaran' => 'required',
            'status_pesanan' => 'required',
            'catatan' => 'nullable',
        ]);
        $pesanan->update($validated);
        return redirect()->route('admin.pesanans.index')->with('success', 'Pesanan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        return redirect()->route('admin.pesanans.index')->with('success', 'Pesanan berhasil dihapus');
    }
}
