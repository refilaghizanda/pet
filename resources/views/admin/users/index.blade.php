@extends('layouts.dashboard')
@section('content')
<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-users mr-2"></i>Daftar User
    </h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus mr-1"></i> Tambah User
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
                            Total User
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $users->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
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
                            Admin
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $users->where('role', 'admin')->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-shield fa-2x text-gray-300"></i>
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
                            Pelanggan
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $users->where('role', 'pelanggan')->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
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
            <i class="fas fa-table mr-2"></i>Data User
        </h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <a class="dropdown-item" href="{{ route('admin.users.create') }}">
                    <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>Tambah User
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
                        <th>User</th>
                        <th>Username</th>
                        <th>No Telepon</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm mr-3">
                                    <i class="fas fa-user-circle fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <div class="font-weight-bold text-primary">{{ $user->name }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        {{ $user->alamat ? Str::limit($user->alamat, 30) : 'Alamat tidak diisi' }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-weight-bold text-info">
                                <i class="fas fa-at mr-1"></i>{{ $user->username }}
                            </span>
                        </td>
                        <td>
                            @if($user->no_telepon)
                                <i class="fas fa-phone mr-1 text-success"></i>
                                {{ $user->no_telepon }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge badge-danger">
                                    <i class="fas fa-user-shield mr-1"></i>Admin
                                </span>
                            @else
                                <span class="badge badge-success">
                                    <i class="fas fa-user mr-1"></i>Pelanggan
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="return confirm('Yakin hapus user ini?')">
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
