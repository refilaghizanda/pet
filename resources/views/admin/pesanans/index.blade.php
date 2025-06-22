@extends('layouts.dashboard')
@section('content')
<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-shopping-cart mr-2"></i>Daftar Pesanan
    </h1>
    <a href="{{ route('admin.pesanans.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Pesanan
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
                            Total Pesanan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pesanans->count() }}</div>
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
                            Selesai
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pesanans->where('status_pesanan', 'selesai')->count() }}</div>
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
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pesanans->where('status_pesanan', 'menunggu')->count() }}</div>
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
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pesanans->where('status_pesanan', 'proses')->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cog fa-2x text-gray-300"></i>
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
            <i class="fas fa-table mr-2"></i>Data Pesanan
        </h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <a class="dropdown-item" href="{{ route('admin.pesanans.create') }}">
                    <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>Tambah Pesanan
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
                        <th>Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Hewan & Layanan</th>
                        <th>Tanggal</th>
                        <th>Status Bayar</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanans as $pesanan)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm mr-3">
                                    <i class="fas fa-file-invoice fa-2x text-warning"></i>
                                </div>
                                <div>
                                    <small class="font-weight-bold text-primary">{{ $pesanan->code_pesanan }}</small>
                                    <small class="text-muted">
                                        <i class="fas fa-sticky-note mr-1"></i>
                                        {{ $pesanan->catatan ? Str::limit($pesanan->catatan, 30) : 'Tidak ada catatan' }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle mr-2 text-primary"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $pesanan->user->name ?? '-' }}</div>
                                    <small class="text-muted">{{ $pesanan->user->username ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-paw mr-2 text-info"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $pesanan->hewan->nama ?? '-' }}</div>
                                    <small class="text-success">{{ $pesanan->layanan->nama ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="font-weight-bold text-info">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ date('d/m/Y', strtotime($pesanan->tanggal_layanan)) }}
                                </div>
                                @if($pesanan->tanggal_mulai)
                                    <small class="text-muted">
                                        {{ date('d/m/Y', strtotime($pesanan->tanggal_mulai)) }} - {{ date('d/m/Y', strtotime($pesanan->tanggal_kembali)) }}
                                    </small>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($pesanan->status_pembayaran == 'lunas')
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle mr-1"></i>Lunas
                                </span>
                            @elseif($pesanan->status_pembayaran == 'pending')
                                <span class="badge badge-warning">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    <i class="fas fa-times-circle mr-1"></i>{{ ucfirst($pesanan->status_pembayaran) }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($pesanan->status_pesanan == 'selesai')
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle mr-1"></i>Selesai
                                </span>
                            @elseif($pesanan->status_pesanan == 'proses')
                                <span class="badge badge-info">
                                    <i class="fas fa-cog mr-1"></i>Proses
                                </span>
                            @elseif($pesanan->status_pesanan == 'batal')
                                <span class="badge badge-danger">
                                    <i class="fas fa-times-circle mr-1"></i>Batal
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    <i class="fas fa-clock mr-1"></i>{{ ucfirst($pesanan->status_pesanan) }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.pesanans.show', $pesanan->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.pesanans.edit', $pesanan->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pesanans.destroy', $pesanan->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="return confirm('Yakin hapus pesanan ini?')">
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
