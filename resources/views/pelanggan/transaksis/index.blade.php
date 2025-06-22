@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-receipt text-primary mr-2"></i>
        Transaksi Saya
    </h1>
</div>

<!-- Informasi Pembayaran -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-left-primary shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-university mr-2"></i>Informasi Rekening Bank
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary">Bank BCA</h6>
                        <p class="mb-1"><strong>No. Rekening:</strong></p>
                        <p class="text-success font-weight-bold">1234-5678-9012</p>
                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                        <p class="text-dark">PetCare Ngunut</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary">Bank Mandiri</h6>
                        <p class="mb-1"><strong>No. Rekening:</strong></p>
                        <p class="text-success font-weight-bold">9876-5432-1098</p>
                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                        <p class="text-dark">PetCare Ngunut</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-left-success shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-mobile-alt mr-2"></i>E-Wallet & QRIS
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-success">DANA</h6>
                        <p class="mb-1"><strong>No. HP:</strong></p>
                        <p class="text-success font-weight-bold">0812-3456-7890</p>
                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                        <p class="text-dark">PetCare Ngunut</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-success">OVO</h6>
                        <p class="mb-1"><strong>No. HP:</strong></p>
                        <p class="text-success font-weight-bold">0812-3456-7890</p>
                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                        <p class="text-dark">PetCare Ngunut</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Transaksi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksis->count() }}</div>
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
                            Total Bayar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp {{ number_format($transaksis->sum('jumlah_bayar'), 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
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
                            Lunas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $transaksis->where('pesanan.status_pembayaran', 'lunas')->count() }}
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
                            Pending
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $transaksis->where('pesanan.status_pembayaran', 'pending')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list mr-1"></i>
            Daftar Transaksi
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Kode Transaksi</th>
                        <th width="25%">Pesanan</th>
                        <th width="15%">Metode Pembayaran</th>
                        <th width="15%">Jumlah Bayar</th>
                        <th width="10%">Bukti Transfer</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $trx)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge badge-primary">
                                <i class="fas fa-hashtag mr-1"></i>
                                {{ $trx->code_transaksi ?? 'TRX-' . str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shopping-cart text-info mr-2"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $trx->pesanan->hewan->nama ?? '-' }}</div>
                                    <small class="text-muted">{{ $trx->pesanan->layanan->nama ?? '-' }}</small>
                                    <br>
                                    <small class="text-primary">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ \Carbon\Carbon::parse($trx->pesanan->tanggal_layanan)->format('d/m/Y') }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($trx->metode_pembayaran == 'transfer')
                                    <i class="fas fa-university text-primary mr-2"></i>
                                @elseif($trx->metode_pembayaran == 'cash')
                                    <i class="fas fa-money-bill-wave text-success mr-2"></i>
                                @elseif($trx->metode_pembayaran == 'qris')
                                    <i class="fas fa-qrcode text-info mr-2"></i>
                                @elseif($trx->metode_pembayaran == 'dana')
                                    <i class="fas fa-mobile-alt text-primary mr-2"></i>
                                @elseif($trx->metode_pembayaran == 'ovo')
                                    <i class="fas fa-mobile-alt text-warning mr-2"></i>
                                @else
                                    <i class="fas fa-credit-card text-primary mr-2"></i>
                                @endif
                                <span class="font-weight-bold">{{ ucfirst($trx->metode_pembayaran) }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-money-bill-wave text-success mr-2"></i>
                                <span class="font-weight-bold text-success">
                                    Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}
                                </span>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($trx->bukti_transfer)
                                <a href="{{ asset('storage/' . $trx->bukti_transfer) }}"
                                   target="_blank"
                                   class="btn btn-outline-primary btn-sm"
                                   data-toggle="tooltip"
                                   title="Lihat Bukti Transfer">
                                    <i class="fas fa-file-image"></i>
                                </a>
                            @else
                                <span class="badge badge-secondary" data-toggle="tooltip" title="Tidak ada bukti">
                                    <i class="fas fa-times"></i>
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('pelanggan.transaksis.show', $trx->id) }}"
                                   class="btn btn-info btn-sm"
                                   data-toggle="tooltip"
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pelanggan.transaksis.edit', $trx->id) }}"
                                   class="btn btn-warning btn-sm"
                                   data-toggle="tooltip"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-receipt fa-3x mb-3"></i>
                                <p>Belum ada transaksi</p>
                                <a href="{{ route('pelanggan.pesanans.index') }}" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart mr-1"></i> Lihat Pesanan
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('scriptss')
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2100,
                timerProgressBar: true,
                showConfirmButton: true,
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                timer: 2100,
                timerProgressBar: true,
                showConfirmButton: true,
            });
        @endif

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 2500);
    </script>
@endpush
