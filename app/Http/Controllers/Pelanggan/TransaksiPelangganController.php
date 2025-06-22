<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class TransaksiPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['pesanan.hewan', 'pesanan.layanan'])
            ->whereHas('pesanan', function($q) {
                $q->where('id_user', Auth::id());
            })
            ->get();
        return view('pelanggan.transaksis.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pesanan milik user login yang belum lunas/selesai dan belum ada transaksi
        $pesanans = Pesanan::where('id_user', Auth::id())
            ->where(function($query) {
                $query->where('status_pembayaran', '!=', 'lunas')
                      ->orWhere('status_pesanan', '!=', 'selesai');
            })
            ->whereDoesntHave('transaksi')
            ->with(['hewan', 'layanan'])
            ->get();

        // Jika ada pesanan_id di URL, gunakan untuk pre-select
        $selectedPesananId = request('pesanan_id');

        return view('pelanggan.transaksis.create', compact('pesanans', 'selectedPesananId'));
    }

    /**
     * Get harga layanan dari pesanan
     */
    public function getHargaLayanan($id_pesanan)
    {
        $pesanan = Pesanan::where('id_user', Auth::id())
            ->with('layanan')
            ->findOrFail($id_pesanan);
        return response()->json(['harga' => $pesanan->layanan->harga]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanans,id',
            'metode_pembayaran' => 'required|string|max:100',
            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);
        // Pastikan pesanan milik user login
        $pesanan = Pesanan::where('id_user', Auth::id())->with('layanan')->findOrFail($validated['id_pesanan']);

        // Buat transaksi
        $transaksi = new Transaksi();
        $transaksi->id_pesanan = $validated['id_pesanan'];
        $transaksi->metode_pembayaran = $validated['metode_pembayaran'];
        $transaksi->jumlah_bayar = $pesanan->layanan->harga ?? 0;
        if ($request->hasFile('bukti_transfer')) {
            $transaksi->bukti_transfer = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }
        $transaksi->save();

        // Update status pembayaran pesanan menjadi 'pending'
        $pesanan->status_pembayaran = 'pending';
        $pesanan->save();

        return redirect()->route('pelanggan.transaksis.index')->with('success', 'Transaksi berhasil ditambahkan. Menunggu verifikasi admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['pesanan.hewan', 'pesanan.layanan'])
            ->whereHas('pesanan', function($q) {
                $q->where('id_user', Auth::id());
            })
            ->findOrFail($id);
        return view('pelanggan.transaksis.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaksi = Transaksi::with(['pesanan.hewan', 'pesanan.layanan'])
            ->whereHas('pesanan', function($q) {
                $q->where('id_user', Auth::id());
            })
            ->findOrFail($id);
        return view('pelanggan.transaksis.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::whereHas('pesanan', function($q) {
                $q->where('id_user', Auth::id());
            })->findOrFail($id);
        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|max:100',
            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);
        $transaksi->metode_pembayaran = $validated['metode_pembayaran'];
        if ($request->hasFile('bukti_transfer')) {
            $transaksi->bukti_transfer = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }
        $transaksi->save();
        return redirect()->route('pelanggan.transaksis.index')->with('success', 'Transaksi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::whereHas('pesanan', function($q) {
                $q->where('id_user', Auth::id());
            })->findOrFail($id);
        $transaksi->delete();
        return redirect()->route('pelanggan.transaksis.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
