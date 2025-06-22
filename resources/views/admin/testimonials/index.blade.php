@extends('layouts.dashboard')
@section('content')
<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-comments mr-2"></i>Daftar Testimonial
    </h1>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Testimonial
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $testimonials->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                            Testimonial Hari Ini
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $testimonials->where('created_at', '>=', now()->startOfDay())->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                            Testimonial Minggu Ini
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $testimonials->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
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
                            Rata-rata Karakter
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $testimonials->count() > 0 ? round($testimonials->avg(function($t) { return strlen($t->isi); })) : 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-font fa-2x text-gray-300"></i>
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
            <i class="fas fa-table mr-2"></i>Data Testimonial
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Testimonial</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.png') }}"
                                     class="rounded-circle mr-3" style="width: 40px; height: 40px;">
                                <div>
                                    <div class="font-weight-bold text-primary">{{ $testimonial->user->name }}</div>
                                    <small class="text-muted">{{ $testimonial->user->username }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-muted">
                                <i class="fas fa-quote-left mr-1"></i>
                                {{ Str::limit($testimonial->isi, 100) }}
                            </div>
                            <small class="text-info">
                                {{ strlen($testimonial->isi) }} karakter
                            </small>
                        </td>
                        <td>
                            <small class="text-muted">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $testimonial->created_at->format('d/m/Y H:i') }}
                            </small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.testimonials.show', $testimonial->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="return confirm('Yakin hapus testimonial ini?')">
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


