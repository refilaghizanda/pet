<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hewan;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $hewans = Hewan::count();
        $layanans = Layanan::count();
        $pesanans = Pesanan::count();
        $transaksis = Transaksi::count();
        $latestPesanans = Pesanan::with(['hewan', 'layanan', 'user'])->latest()->take(5)->get();

        // Layanan paling sering digunakan
        $topLayanan = Pesanan::selectRaw('id_layanan, COUNT(*) as total')
            ->groupBy('id_layanan')
            ->orderByDesc('total')
            ->with('layanan')
            ->first();

        // Statistik pesanan berdasarkan status pembayaran
        $pesanansLunas = Pesanan::where('status_pembayaran', 'lunas')->count();
        $pesanansPending = Pesanan::where('status_pembayaran', 'pending')->count();

        // Total pendapatan dari transaksi lunas
        $totalPendapatan = Transaksi::whereHas('pesanan', function($q) {
            $q->where('status_pembayaran', 'lunas');
        })->sum('jumlah_bayar');

        // Data chart dinamis - pesanan per bulan tahun ini
        $chartData = Pesanan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Isi data kosong dengan 0
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $chartData[$i] ?? 0;
        }

        // Statistik tambahan
        $pesananHariIni = Pesanan::whereDate('created_at', today())->count();
        $pesananMingguIni = Pesanan::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $pesananBulanIni = Pesanan::whereMonth('created_at', now()->month)->count();

        $pendapatanBulanIni = Transaksi::whereMonth('created_at', now()->month)
            ->whereHas('pesanan', function($q) {
                $q->where('status_pembayaran', 'lunas');
            })
            ->sum('jumlah_bayar');

        return view('admin.dashboard', compact(
            'users',
            'hewans',
            'layanans',
            'pesanans',
            'transaksis',
            'latestPesanans',
            'topLayanan',
            'monthlyData',
            'pesananHariIni',
            'pesananMingguIni',
            'pesananBulanIni',
            'pendapatanBulanIni',
            'pesanansLunas',
            'pesanansPending',
            'totalPendapatan'
        ));
    }
}
