@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-shopping-cart text-primary mr-2"></i>
        Daftar Pesanan Saya
    </h1>
    <a href="{{ route('pelanggan.pesanans.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Pesanan
    </a>
</div>

<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pesanan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pesanans->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
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
                            Lunas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pesanans->where('status_pembayaran', 'lunas')->count() }}
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
                            Menunggu
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pesanans->where('status_pembayaran', 'menunggu')->count() }}
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
                            Proses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pesanans->where('status_pesanan', 'proses')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cog fa-2x text-gray-300"></i>
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
            Daftar Pesanan
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Kode Pesanan</th>
                        <th width="20%">Hewan</th>
                        <th width="20%">Layanan</th>
                        <th width="12%">Tgl Layanan</th>
                        <th width="12%">Status Bayar</th>
                        <th width="12%">Status Pesanan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $pesanan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge badge-primary">
                                <i class="fas fa-hashtag mr-1"></i>
                                {{ $pesanan->code_pesanan ?? 'PS-' . str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-paw text-warning mr-2"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $pesanan->hewan->nama ?? '-' }}</div>
                                    <small class="text-muted">{{ $pesanan->hewan->jenis ?? '-' }} - {{ $pesanan->hewan->ras ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-tools text-info mr-2"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $pesanan->layanan->nama ?? '-' }}</div>
                                    <small class="text-success">Rp {{ number_format($pesanan->layanan->harga ?? 0, 0, ',', '.') }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <i class="fas fa-calendar text-primary mr-1"></i>
                            {{ \Carbon\Carbon::parse($pesanan->tanggal_layanan)->format('d/m/Y') }}
                        </td>
                        <td class="text-center">
                            @if($pesanan->status_pembayaran == 'lunas')
                                <span class="badge badge-success badge-lg">
                                    <i class="fas fa-check-circle mr-1"></i> Lunas
                                </span>
                            @elseif($pesanan->status_pembayaran == 'pending')
                                <span class="badge badge-warning badge-lg">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                </span>
                            @else
                                <span class="badge badge-secondary badge-lg">
                                    <i class="fas fa-times-circle mr-1"></i> Belum
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($pesanan->status_pesanan == 'selesai')
                                <span class="badge badge-success badge-lg">
                                    <i class="fas fa-check-circle mr-1"></i> Selesai
                                </span>
                            @elseif($pesanan->status_pesanan == 'proses')
                                <span class="badge badge-info badge-lg">
                                    <i class="fas fa-cog mr-1"></i> Proses
                                </span>
                            @elseif($pesanan->status_pesanan == 'menunggu')
                                <span class="badge badge-warning badge-lg">
                                    <i class="fas fa-clock mr-1"></i> Menunggu
                                </span>
                            @else
                                <span class="badge badge-danger badge-lg">
                                    <i class="fas fa-times-circle mr-1"></i> Batal
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('pelanggan.pesanans.show', $pesanan->id) }}"
                                   class="btn btn-info btn-sm"
                                   data-toggle="tooltip"
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pelanggan.pesanans.edit', $pesanan->id) }}"
                                   class="btn btn-warning btn-sm"
                                   data-toggle="tooltip"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                @if(!$pesanan->transaksi && $pesanan->status_pesanan != 'menunggu' && $pesanan->status_pembayaran != 'lunas')
                                    <a href="{{ route('pelanggan.transaksis.create') }}?pesanan_id={{ $pesanan->id }}"
                                       class="btn btn-success btn-sm"
                                       data-toggle="tooltip"
                                       title="Bayar">
                                        <i class="fas fa-credit-card"></i>
                                    </a>
                                @elseif($pesanan->transaksi)
                                    <span class="badge badge-success" data-toggle="tooltip" title="Sudah Dibayar">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @elseif($pesanan->status_pesanan == 'menunggu')
                                    <span class="badge badge-warning" data-toggle="tooltip" title="Menunggu Konfirmasi">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                <p>Belum ada pesanan</p>
                                <a href="{{ route('pelanggan.pesanans.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Buat Pesanan Pertama
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