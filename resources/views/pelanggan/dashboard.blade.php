@extends('layouts.dashboard')
@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h4 class="mb-1">
                            <i class="fas fa-user-circle text-primary mr-2"></i>
                            Selamat datang, <b>{{ Auth::user()->name }}</b>!
                        </h4>
                        <p class="mb-0 text-muted">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::now()->format('l, d F Y') }}
                        </p>
                    </div>
                    <div class="col-lg-4 text-right">
                        <a href="{{ route('pelanggan.pesanans.create') }}" class="btn btn-primary mr-2">
                            <i class="fas fa-plus mr-1"></i> Pesan Sekarang
                        </a>
                        <a href="{{ route('pelanggan.hewans.create') }}" class="btn btn-success mr-2">
                            <i class="fas fa-paw mr-1"></i> Tambah Hewan
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Hewan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $hewans }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paw fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pesanan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pesanans }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Transaksi
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $transaksis }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-receipt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Bayar
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">
                            Rp {{ number_format($totalBayar ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Pesanan Terakhir -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    Pesanan Terakhir
                </h6>
                <a href="{{ route('pelanggan.pesanans.index') }}" class="btn btn-primary btn-sm">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if($latestPesanans->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Hewan</th>
                                <th>Layanan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestPesanans as $p)
                            <tr>
                                <td>
                                    <div class="font-weight-bold">{{ $p->hewan->nama ?? '-' }}</div>
                                    <small class="text-muted">{{ $p->hewan->jenis ?? '-' }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $p->layanan->nama ?? '-' }}</div>
                                    <small class="text-success">Rp {{ number_format($p->layanan->harga ?? 0, 0, ',', '.') }}</small>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($p->tanggal_layanan)->format('d/m/Y') }}
                                    </small>
                                </td>
                                <td>
                                    @if($p->status_pesanan == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($p->status_pesanan == 'proses')
                                        <span class="badge badge-info">Proses</span>
                                    @elseif($p->status_pesanan == 'menunggu')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @else
                                        <span class="badge badge-danger">Batal</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <div class="text-muted">
                        <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                        <p>Belum ada pesanan</p>
                        <a href="{{ route('pelanggan.pesanans.create') }}" class="btn btn-primary btn-sm">
                            Buat Pesanan Pertama
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Transaksi Terakhir -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning">
                    Transaksi Terakhir
                </h6>
                <a href="{{ route('pelanggan.transaksis.index') }}" class="btn btn-warning btn-sm">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if($latestTransaksis->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Pesanan</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestTransaksis as $trx)
                            <tr>
                                <td>
                                    <div class="font-weight-bold">{{ $trx->pesanan->hewan->nama ?? '-' }}</div>
                                    <small class="text-muted">{{ $trx->pesanan->layanan->nama ?? '-' }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold text-success">
                                        Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">
                                        {{ ucfirst($trx->metode_pembayaran) }}
                                    </span>
                                </td>
                                <td>
                                    @if($trx->pesanan->status_pembayaran == 'lunas')
                                        <span class="badge badge-success">Lunas</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <div class="text-muted">
                        <i class="fas fa-receipt fa-2x mb-2"></i>
                        <p>Belum ada transaksi</p>
                        <a href="{{ route('pelanggan.pesanans.index') }}" class="btn btn-warning btn-sm">
                            Lihat Pesanan
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('pelanggan.hewans.create') }}" class="btn btn-outline-primary btn-block">
                            <i class="fas fa-paw fa-lg mb-2"></i><br>
                            Tambah Hewan
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('pelanggan.pesanans.create') }}" class="btn btn-outline-success btn-block">
                            <i class="fas fa-shopping-cart fa-lg mb-2"></i><br>
                            Buat Pesanan
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('pelanggan.profile') }}" class="btn btn-outline-info btn-block">
                            <i class="fas fa-user fa-lg mb-2"></i><br>
                            Edit Profil
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('pelanggan.transaksis.index') }}" class="btn btn-outline-warning btn-block">
                            <i class="fas fa-receipt fa-lg mb-2"></i><br>
                            Lihat Transaksi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
