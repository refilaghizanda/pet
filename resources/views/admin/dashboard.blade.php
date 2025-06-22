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
                            <i class="fas fa-user-shield text-primary mr-2"></i>
                            Selamat datang, <b>{{ Auth::user()->name }}</b>!
                        </h4>
                        <p class="mb-0 text-muted">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::now()->format('l, d F Y') }}
                        </p>
                        <p class="mb-0 text-muted">
                            <i class="fas fa-chart-line mr-1"></i>
                            Dashboard Admin - Manajemen Sistem PetCare
                        </p>
                    </div>
                    <div class="col-lg-4 text-right">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mr-2">
                            <i class="fas fa-plus mr-1"></i> Tambah User
                        </a>
                        <a href="{{ route('admin.pesanans.create') }}" class="btn btn-success">
                            <i class="fas fa-shopping-cart mr-1"></i> Buat Pesanan
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
                            Total User
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                        <div class="text-xs text-muted mt-1">
                            <i class="fas fa-users mr-1"></i>
                            {{ $users }} user terdaftar
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
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
                            Total Hewan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $hewans }}</div>
                        <div class="text-xs text-muted mt-1">
                            <i class="fas fa-paw mr-1"></i>
                            {{ $hewans }} hewan terdaftar
                        </div>
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
                            Total Layanan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $layanans }}</div>
                        <div class="text-xs text-muted mt-1">
                            <i class="fas fa-briefcase-medical mr-1"></i>
                            {{ $layanans }} layanan tersedia
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-briefcase-medical fa-2x text-gray-300"></i>
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
                            Total Pesanan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pesanans }}</div>
                        <div class="text-xs text-muted mt-1">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            {{ $pesanans }} pesanan dibuat
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Statistics -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Transaksi
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $transaksis }}</div>
                        <div class="text-xs text-muted mt-1">
                            <i class="fas fa-receipt mr-1"></i>
                            {{ $transaksis }} transaksi
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-receipt fa-2x text-gray-300"></i>
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
                            Pesanan Lunas
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pesanansLunas ?? 0 }}</div>
                        <div class="text-xs text-muted mt-1">
                            <i class="fas fa-check-circle mr-1"></i>
                            Pembayaran lunas
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                            Pesanan Pending
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pesanansPending ?? 0 }}</div>
                        <div class="text-xs text-muted mt-1">
                            <i class="fas fa-clock mr-1"></i>
                            Menunggu pembayaran
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
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
                            Total Pendapatan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                        <div class="text-xs text-muted mt-1">
                            <i class="fas fa-money-bill-wave mr-1"></i>
                            Pendapatan total
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
    <!-- Chart -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-area mr-2"></i>Statistik Pesanan {{ date('Y') }}
                </h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Aksi:</div>
                        <a class="dropdown-item" href="{{ route('admin.pesanans.index') }}">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Lihat Semua Pesanan
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.transaksis.index') }}">
                            <i class="fas fa-receipt fa-sm fa-fw mr-2 text-gray-400"></i>Lihat Transaksi
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="areaChart"></canvas>
                <hr>
                <div class="mt-3">
                    <h6 class="font-weight-bold">
                        <i class="fas fa-star mr-1 text-warning"></i>Layanan Paling Populer:
                    </h6>
                    @if($topLayanan && $topLayanan->layanan)
                        <span class="badge badge-info">
                            <i class="fas fa-briefcase-medical mr-1"></i>
                            {{ $topLayanan->layanan->nama }} ({{ $topLayanan->total }} pesanan)
                        </span>
                    @else
                        <span class="text-muted">
                            <i class="fas fa-info-circle mr-1"></i>
                            Belum ada data layanan yang digunakan pelanggan.
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Orders -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-clock mr-2"></i>Pesanan Terbaru
                </h6>
                <a href="{{ route('admin.pesanans.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-list mr-1"></i>Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if($latestPesanans->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Pelanggan</th>
                                <th>Hewan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestPesanans as $p)
                            <tr>
                                <td class="text-center">
                                    <span class="badge badge-primary">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $p->user->name ?? '-' }}</div>
                                    <small class="text-muted">{{ $p->user->username ?? '-' }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $p->hewan->nama ?? '-' }}</div>
                                    <small class="text-success">{{ $p->layanan->nama ?? '-' }}</small>
                                </td>
                                <td>
                                    @if($p->status_pesanan == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($p->status_pesanan == 'proses')
                                        <span class="badge badge-info">Proses</span>
                                    @elseif($p->status_pesanan == 'batal')
                                        <span class="badge badge-danger">Batal</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($p->status_pesanan) }}</span>
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
                    <i class="fas fa-bolt mr-2"></i>Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary btn-block">
                            <i class="fas fa-user-plus fa-lg mb-2"></i><br>
                            Tambah User
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.hewans.create') }}" class="btn btn-outline-info btn-block">
                            <i class="fas fa-paw fa-lg mb-2"></i><br>
                            Tambah Hewan
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.layanans.create') }}" class="btn btn-outline-success btn-block">
                            <i class="fas fa-briefcase-medical fa-lg mb-2"></i><br>
                            Tambah Layanan
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.pesanans.create') }}" class="btn btn-outline-warning btn-block">
                            <i class="fas fa-shopping-cart fa-lg mb-2"></i><br>
                            Buat Pesanan
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.transaksis.create') }}" class="btn btn-outline-danger btn-block">
                            <i class="fas fa-receipt fa-lg mb-2"></i><br>
                            Buat Transaksi
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-block">
                            <i class="fas fa-users fa-lg mb-2"></i><br>
                            Kelola User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptss')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('areaChart').getContext('2d');
    var areaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pesanan',
                data: @json($monthlyData),
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
