@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-eye mr-2"></i>Detail Testimonial
    </h1>
    <div>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Testimonial Content -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-comments mr-2"></i>Testimonial
                </h6>
            </div>
            <div class="card-body">
                <div class="testimonial-content text-center">
                    <div class="mb-4">
                        <i class="bi bi-quote quote-icon-left text-primary" style="font-size: 2rem;"></i>
                        <span class="testimonial-text">{{ $testimonial->isi }}</span>
                        <i class="bi bi-quote quote-icon-right text-primary" style="font-size: 2rem;"></i>
                    </div>

                    <div class="testimonial-author">
                        <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.png') }}"
                             class="rounded-circle mb-3" style="width: 80px; height: 80px;">
                        <h4 class="text-primary">{{ $testimonial->user->name }}</h4>
                        <p class="text-muted">{{ $testimonial->user->username }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Testimonial Info -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Testimonial
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="font-weight-bold text-primary">
                        <i class="fas fa-calendar mr-1"></i>Tanggal Dibuat:
                    </h6>
                    <p class="mb-1">{{ $testimonial->created_at->format('d F Y H:i') }}</p>
                    <small class="text-muted">{{ $testimonial->created_at->diffForHumans() }}</small>
                </div>

                <div class="mb-3">
                    <h6 class="font-weight-bold text-primary">
                        <i class="fas fa-font mr-1"></i>Jumlah Karakter:
                    </h6>
                    <div class="h4 text-primary font-weight-bold">{{ strlen($testimonial->isi) }}</div>
                </div>

                <div class="mb-3">
                    <h6 class="font-weight-bold text-primary">
                        <i class="fas fa-tags mr-1"></i>ID Testimonial:
                    </h6>
                    <code class="bg-light px-2 py-1 rounded">{{ $testimonial->id }}</code>
                </div>

                <div>
                    <h6 class="font-weight-bold text-primary">
                        <i class="fas fa-user mr-1"></i>ID User:
                    </h6>
                    <code class="bg-light px-2 py-1 rounded">{{ $testimonial->user_id }}</code>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bolt mr-2"></i>Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block"
                                onclick="return confirm('Yakin hapus testimonial ini?')">
                            <i class="fas fa-trash mr-1"></i>Hapus Testimonial
                        </button>
                    </form>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-list mr-1"></i>Daftar Semua Testimonial
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styless')
<style>
.testimonial-content {
    padding: 20px;
}

.testimonial-text {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #333;
    font-style: italic;
}

.quote-icon-left, .quote-icon-right {
    color: #007bff;
}

.testimonial-author img {
    border: 3px solid #007bff;
}
</style>
@endpush
