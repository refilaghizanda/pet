@extends('layouts.dashboard')
@section('content')
<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-receipt mr-2"></i>Daftar Transaksi
    </h1>
    <a href="{{ route('admin.transaksis.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Transaksi
    </a>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Transaksi
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $transaksis->count() }}</div>
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
                            Total Pendapatan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($transaksis->sum('jumlah_bayar'), 0, ',', '.') }}</div>
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
                            Rata-rata Transaksi
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($transaksis->avg('jumlah_bayar'), 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calculator fa-2x text-gray-300"></i>
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
                            Transaksi Lunas
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $transaksis->where('pesanan.status_pembayaran', 'lunas')->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-table mr-2"></i>Data Transaksi
        </h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <a class="dropdown-item" href="{{ route('admin.transaksis.create') }}">
                    <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>Tambah Transaksi
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="exportTable()">
                    <i class="fas fa-download fa-sm fa-fw mr-2 text-gray-400"></i>Export Data
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Status Bayar</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $transaksi)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <span>{{ $transaksi->code_transaksi ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle mr-2 text-primary"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $transaksi->pesanan->user->name ?? '-' }}</div>
                                    <small class="text-muted">{{ $transaksi->pesanan->user->username ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-briefcase-medical mr-2 text-success"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $transaksi->pesanan->layanan->nama ?? '-' }}</div>
                                    <small class="text-muted">{{ $transaksi->pesanan->hewan->nama ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($transaksi->metode_pembayaran == 'transfer')
                                    <i class="fas fa-university text-primary mr-2"></i>
                                @elseif($transaksi->metode_pembayaran == 'cash')
                                    <i class="fas fa-money-bill-wave text-success mr-2"></i>
                                @elseif($transaksi->metode_pembayaran == 'qris')
                                    <i class="fas fa-qrcode text-info mr-2"></i>
                                @elseif($transaksi->metode_pembayaran == 'dana')
                                    <i class="fas fa-mobile-alt text-primary mr-2"></i>
                                @elseif($transaksi->metode_pembayaran == 'ovo')
                                    <i class="fas fa-mobile-alt text-warning mr-2"></i>
                                @else
                                    <i class="fas fa-credit-card text-primary mr-2"></i>
                                @endif
                                <span class="font-weight-bold">{{ ucfirst($transaksi->metode_pembayaran) }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="font-weight-bold text-success">
                                <i class="fas fa-money-bill-wave mr-1"></i>
                                Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            @php $bayar = $transaksi->pesanan->status_pembayaran ?? null; @endphp
                            @if($bayar == 'lunas')
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle mr-1"></i>Lunas
                                </span>
                            @elseif($bayar == 'pending')
                                <span class="badge badge-warning">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    <i class="fas fa-times-circle mr-1"></i>{{ ucfirst($bayar) }}
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($transaksi->bukti_transfer)
                                <a href="{{ asset('storage/' . $transaksi->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Lihat Bukti">
                                    <i class="fas fa-file-image"></i>
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.transaksis.show', $transaksi->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.transaksis.edit', $transaksi->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="return confirm('Yakin hapus transaksi ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
