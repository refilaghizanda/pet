<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Hewan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;

class PesananPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = Pesanan::with(['hewan', 'layanan'])
            ->where('id_user', Auth::id())
            ->get();
        return view('pelanggan.pesanans.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hewans = Hewan::where('id_user', Auth::id())->get();
        $layanans = Layanan::all();
        return view('pelanggan.pesanans.create', compact('hewans', 'layanans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_hewan' => 'required|exists:hewans,id',
            'id_layanan' => 'required|exists:layanans,id',
            'tanggal_layanan' => 'required|date',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date',
            'status_pembayaran' => 'required',
            'status_pesanan' => 'required',
            'catatan' => 'nullable',
        ]);
        $validated['id_user'] = Auth::id();
        Pesanan::create($validated);
        return redirect()->route('pelanggan.pesanans.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesanan = Pesanan::with(['hewan', 'layanan'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);
        return view('pelanggan.pesanans.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pesanan = Pesanan::where('id_user', Auth::id())->findOrFail($id);
        $hewans = Hewan::where('id_user', Auth::id())->get();
        $layanans = Layanan::all();
        return view('pelanggan.pesanans.edit', compact('pesanan', 'hewans', 'layanans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::where('id_user', Auth::id())->findOrFail($id);
        $validated = $request->validate([
            'id_hewan' => 'required|exists:hewans,id',
            'id_layanan' => 'required|exists:layanans,id',
            'tanggal_layanan' => 'required|date',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date',
            'catatan' => 'nullable',
        ]);
        $pesanan->update($validated);
        return redirect()->route('pelanggan.pesanans.index')->with('success', 'Pesanan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::where('id_user', Auth::id())->findOrFail($id);
        $pesanan->delete();
        return redirect()->route('pelanggan.pesanans.index')->with('success', 'Pesanan berhasil dihapus');
    }
}
