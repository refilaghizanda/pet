<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Hewan;
use App\Models\Pesanan;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Basic counts
        $hewans = Hewan::where('id_user', $userId)->count();
        $pesanans = Pesanan::where('id_user', $userId)->count();
        $transaksis = Transaksi::whereHas('pesanan', function($q) use ($userId) {
            $q->where('id_user', $userId);
        })->count();

        // Total bayar
        $totalBayar = Transaksi::whereHas('pesanan', function($q) use ($userId) {
            $q->where('id_user', $userId);
        })->sum('jumlah_bayar');

        // Latest data
        $latestPesanans = Pesanan::with(['hewan', 'layanan'])
            ->where('id_user', $userId)
            ->latest()
            ->take(5)
            ->get();
        $latestTransaksis = Transaksi::with(['pesanan.hewan', 'pesanan.layanan'])
            ->whereHas('pesanan', function($q) use ($userId) {
                $q->where('id_user', $userId);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('pelanggan.dashboard', compact(
            'hewans',
            'pesanans',
            'transaksis',
            'totalBayar',
            'latestPesanans',
            'latestTransaksis'
        ));
    }
}
