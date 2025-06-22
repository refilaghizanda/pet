@extends('layouts.dashboard')
@section('content')
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-paw mr-2"></i>Daftar Hewan
        </h1>
        <a href="{{ route('admin.hewans.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Hewan
        </a>
    </div>

    <!-- Statistics Cards -->


    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table mr-2"></i>Data Hewan
            </h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Aksi:</div>
                    <a class="dropdown-item" href="{{ route('admin.hewans.create') }}">
                        <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>Tambah Hewan
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
                            <th>Hewan</th>
                            <th>Jenis</th>
                            <th>Umur</th>
                            <th>Pemilik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hewans as $hewan)
                            <tr>
                                <td class="text-center">
                                    <span class="badge badge-primary">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm mr-3">
                                            @if ($hewan->jenis == 'anjing')
                                                <i class="fas fa-dog fa-2x text-info"></i>
                                            @elseif($hewan->jenis == 'kucing')
                                                <i class="fas fa-cat fa-2x text-warning"></i>
                                            @else
                                                <i class="fas fa-paw fa-2x text-success"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-primary">{{ $hewan->nama }}</div>
                                            <small class="text-muted">
                                                <i class="fas fa-sticky-note mr-1"></i>
                                                {{ $hewan->catatan ? Str::limit($hewan->catatan, 30) : 'Tidak ada catatan' }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($hewan->jenis == 'anjing')
                                        <span class="badge badge-info">
                                            <i class="fas fa-dog mr-1"></i>{{ ucfirst($hewan->jenis) }}
                                        </span>
                                    @elseif($hewan->jenis == 'kucing')
                                        <span class="badge badge-warning">
                                            <i class="fas fa-cat mr-1"></i>{{ ucfirst($hewan->jenis) }}
                                        </span>
                                    @else
                                        <span class="badge badge-success">
                                            <i class="fas fa-paw mr-1"></i>{{ ucfirst($hewan->jenis) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="font-weight-bold text-success">
                                        <i class="fas fa-birthday-cake mr-1"></i>{{ $hewan->umur }} tahun
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-circle mr-2 text-primary"></i>
                                        <div>
                                            <div class="font-weight-bold">{{ $hewan->user->name ?? '-' }}</div>
                                            <small class="text-muted">{{ $hewan->user->username ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.hewans.show', $hewan->id) }}" class="btn btn-info btn-sm"
                                            data-toggle="tooltip" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.hewans.edit', $hewan->id) }}"
                                            class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.hewans.destroy', $hewan->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Hapus" onclick="return confirm('Yakin hapus data hewan ini?')">
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
