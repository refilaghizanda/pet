@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-eye mr-2"></i>Detail Blog
    </h1>
    <div>
        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning shadow-sm">
            <i class="fas fa-edit mr-1"></i> Edit
        </a>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Blog Content -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-blog mr-2"></i>Konten Blog
                </h6>
            </div>
            <div class="card-body">
                @if($blog->image)
                <div class="text-center mb-4">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->judul }}"
                         class="img-fluid rounded shadow" style="max-height: 400px;">
                </div>
                @endif

                <h2 class="text-primary font-weight-bold mb-3">{{ $blog->judul }}</h2>

                <div class="mb-4">
                    <span class="badge badge-info mr-2">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $blog->created_at->format('d F Y') }}
                    </span>
                    <span class="badge badge-secondary mr-2">
                        <i class="fas fa-clock mr-1"></i>
                        {{ $blog->created_at->format('H:i') }}
                    </span>
                    <span class="badge badge-success">
                        <i class="fas fa-check-circle mr-1"></i>
                        Published
                    </span>
                </div>

                <div class="blog-content">
                    {!! $blog->content !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Blog Info -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Blog
                </h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h4 text-primary font-weight-bold">{{ strlen($blog->judul) }}</div>
                            <small class="text-muted">Karakter Judul</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h4 text-success font-weight-bold">{{ strlen($blog->content) }}</div>
                            <small class="text-muted">Karakter Konten</small>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <h6 class="font-weight-bold text-primary">
                        <i class="fas fa-image mr-1"></i>Status Gambar:
                    </h6>
                    @if($blog->image)
                        <span class="badge badge-success">
                            <i class="fas fa-check mr-1"></i>Ada Gambar
                        </span>
                    @else
                        <span class="badge badge-warning">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Tidak Ada Gambar
                        </span>
                    @endif
                </div>

                <div class="mb-3">
                    <h6 class="font-weight-bold text-primary">
                        <i class="fas fa-calendar mr-1"></i>Tanggal Dibuat:
                    </h6>
                    <p class="mb-1">{{ $blog->created_at->format('d F Y H:i') }}</p>
                    <small class="text-muted">{{ $blog->created_at->diffForHumans() }}</small>
                </div>

                @if($blog->updated_at != $blog->created_at)
                <div class="mb-3">
                    <h6 class="font-weight-bold text-primary">
                        <i class="fas fa-edit mr-1"></i>Terakhir Diupdate:
                    </h6>
                    <p class="mb-1">{{ $blog->updated_at->format('d F Y H:i') }}</p>
                    <small class="text-muted">{{ $blog->updated_at->diffForHumans() }}</small>
                </div>
                @endif

                <div class="mb-3">
                    <h6 class="font-weight-bold text-primary">
                        <i class="fas fa-tags mr-1"></i>ID Blog:
                    </h6>
                    <code class="bg-light px-2 py-1 rounded">{{ $blog->id }}</code>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->


        <!-- Content Analysis -->

    </div>
</div>
@endsection

@push('styless')
<style>
.blog-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.blog-content h1, .blog-content h2, .blog-content h3,
.blog-content h4, .blog-content h5, .blog-content h6 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.blog-content p {
    margin-bottom: 1rem;
}

.blog-content ul, .blog-content ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.blog-content blockquote {
    border-left: 4px solid #3498db;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    color: #7f8c8d;
}
</style>
@endpush
