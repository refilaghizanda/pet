@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-paw text-primary mr-2"></i>
        Daftar Hewan Saya
    </h1>
    <a href="{{ route('pelanggan.hewans.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Hewan
    </a>
</div>

<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Hewan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $hewans->count() }}</div>
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
                            Anjing
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $hewans->where('jenis', 'Anjing')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dog fa-2x text-gray-300"></i>
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
                            Kucing
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $hewans->where('jenis', 'Kucing')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cat fa-2x text-gray-300"></i>
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
                            Lainnya
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $hewans->whereNotIn('jenis', ['Anjing', 'Kucing'])->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paw fa-2x text-gray-300"></i>
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
            Daftar Hewan
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Hewan</th>
                        <th width="15%">Jenis</th>
                        <th width="10%">Umur</th>
                        <th width="20%">Catatan</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hewans as $hewan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($hewan->jenis == 'Anjing')
                                    <i class="fas fa-dog text-warning mr-2"></i>
                                @elseif($hewan->jenis == 'Kucing')
                                    <i class="fas fa-cat text-info mr-2"></i>
                                @else
                                    <i class="fas fa-paw text-primary mr-2"></i>
                                @endif
                                <div>
                                    <div class="font-weight-bold">{{ $hewan->nama }}</div>
                                    <small class="text-muted">ID: {{ $hewan->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-primary">
                                <i class="fas fa-tag mr-1"></i>
                                {{ $hewan->jenis }}
                            </span>
                        </td>

                        <td class="text-center">
                            <span class="badge badge-info">
                                <i class="fas fa-birthday-cake mr-1"></i>
                                {{ $hewan->umur }} tahun
                            </span>
                        </td>
                        <td>
                            @if($hewan->catatan)
                                <div class="text-truncate" style="max-width: 200px;" data-toggle="tooltip" title="{{ $hewan->catatan }}">
                                    {{ $hewan->catatan }}
                                </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('pelanggan.hewans.show', $hewan->id) }}"
                                   class="btn btn-info btn-sm"
                                   data-toggle="tooltip"
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pelanggan.hewans.edit', $hewan->id) }}"
                                   class="btn btn-warning btn-sm"
                                   data-toggle="tooltip"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pelanggan.hewans.destroy', $hewan->id) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Yakin ingin menghapus hewan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="tooltip"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-paw fa-3x mb-3"></i>
                                <p>Belum ada hewan</p>
                                <a href="{{ route('pelanggan.hewans.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Tambah Hewan Pertama
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
