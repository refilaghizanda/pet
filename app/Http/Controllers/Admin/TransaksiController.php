<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with('pesanan.user')->get();
        return view('admin.transaksis.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya tampilkan pesanan yang belum lunas atau belum selesai
        $pesanans = Pesanan::with('user')
            ->where(function($query) {
                $query->where('status_pembayaran', '!=', 'lunas')
                      ->orWhere('status_pesanan', '!=', 'selesai');
            })
            ->whereNotExists(function($query) {
                $query->select(DB::raw(1))
                      ->from('transaksis')
                      ->whereRaw('transaksis.id_pesanan = pesanans.id');
            })
            ->get();
        return view('admin.transaksis.create', compact('pesanans'));
    }

    /**
     * Get harga layanan dari pesanan
     */
    public function getHargaLayanan($id_pesanan)
    {
        $pesanan = Pesanan::with('layanan')->findOrFail($id_pesanan);
        return response()->json(['harga' => $pesanan->layanan->harga]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanans,id',
            'metode_pembayaran' => 'required',
            'jumlah_bayar' => 'required|numeric',
            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Ambil harga layanan dari pesanan
        $pesanan = Pesanan::with('layanan')->findOrFail($validated['id_pesanan']);
        $validated['jumlah_bayar'] = $pesanan->layanan->harga;

        if ($request->hasFile('bukti_transfer')) {
            $validated['bukti_transfer'] = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        // Update status pembayaran pesanan menjadi pending
        $pesanan->update(['status_pembayaran' => 'lunas']);

        Transaksi::create($validated);
        return redirect()->route('admin.transaksis.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with('pesanan.user')->findOrFail($id);
        return view('admin.transaksis.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        // Untuk edit, tampilkan semua pesanan termasuk yang sudah ada transaksi
        $pesanans = Pesanan::with('user')
            ->where(function($query) {
                $query->where('status_pembayaran', '!=', 'lunas')
                      ->orWhere('status_pesanan', '!=', 'selesai');
            })
            ->get();
        return view('admin.transaksis.edit', compact('transaksi', 'pesanans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanans,id',
            'metode_pembayaran' => 'required',
            'jumlah_bayar' => 'required|numeric',
            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Ambil harga layanan dari pesanan
        $pesanan = Pesanan::with('layanan')->findOrFail($validated['id_pesanan']);
        $validated['jumlah_bayar'] = $pesanan->layanan->harga;

        if ($request->hasFile('bukti_transfer')) {
            if ($transaksi->bukti_transfer) {
                Storage::disk('public')->delete($transaksi->bukti_transfer);
            }
            $validated['bukti_transfer'] = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }
        $transaksi->update($validated);
        return redirect()->route('admin.transaksis.index')->with('success', 'Transaksi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        if ($transaksi->bukti_transfer) {
            Storage::disk('public')->delete($transaksi->bukti_transfer);
        }
        $transaksi->delete();
        return redirect()->route('admin.transaksis.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
