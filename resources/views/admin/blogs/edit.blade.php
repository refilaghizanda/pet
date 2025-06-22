@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-edit mr-2"></i>Edit Blog
    </h1>
    <div>
        <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-info shadow-sm">
            <i class="fas fa-eye mr-1"></i> Detail
        </a>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-edit mr-2"></i>Form Edit Blog
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul" class="font-weight-bold">
                            <i class="fas fa-heading mr-1"></i>Judul Blog <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul" value="{{ old('judul', $blog->judul) }}"
                               placeholder="Masukkan judul blog..." required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="font-weight-bold">
                            <i class="fas fa-image mr-1"></i>Gambar Blog
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            <label class="custom-file-label" for="image">
                                @if($blog->image)
                                    {{ basename($blog->image) }}
                                @else
                                    Pilih file gambar...
                                @endif
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle mr-1"></i>
                            Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.
                        </small>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="font-weight-bold">
                            <i class="fas fa-align-left mr-1"></i>Konten Blog <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content" name="content" rows="15"
                                  placeholder="Tulis konten blog di sini..." required>{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>Update Blog
                        </button>
                        <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Current Image Preview -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-image mr-2"></i>Gambar Saat Ini
                </h6>
            </div>
            <div class="card-body text-center">
                @if($blog->image)
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->judul }}"
                         class="img-fluid rounded shadow mb-3" style="max-height: 200px;">
                    <div class="mb-2">
                        <small class="text-muted">
                            <i class="fas fa-file-image mr-1"></i>
                            {{ basename($blog->image) }}
                        </small>
                    </div>
                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="remove_image" value="1">
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Yakin hapus gambar ini?')">
                            <i class="fas fa-trash mr-1"></i>Hapus Gambar
                        </button>
                    </form>
                @else
                    <div class="text-muted">
                        <i class="fas fa-image fa-3x mb-2"></i>
                        <p>Belum ada gambar</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- New Image Preview -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-eye mr-2"></i>Preview Gambar Baru
                </h6>
            </div>
            <div class="card-body text-center">
                <div id="imagePreview" class="d-none">
                    <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                </div>
                <div id="noImage" class="text-muted">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <p>Belum ada gambar dipilih</p>
                </div>
            </div>
        </div>

        <!-- Blog Info -->

        <!-- Quick Actions -->

    </div>
</div>
@endsection

@push('scriptss')
<script>
    // Preview image
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const noImage = document.getElementById('noImage');
        const previewImg = document.getElementById('previewImg');
        const label = document.querySelector('.custom-file-label');

        if (file) {
            label.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('d-none');
                noImage.classList.add('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            label.textContent = 'Pilih file gambar...';
            preview.classList.add('d-none');
            noImage.classList.remove('d-none');
        }
    });

    // Character counter for content
    document.getElementById('content').addEventListener('input', function() {
        const charCount = this.value.length;
        const counter = document.getElementById('charCounter');
        if (!counter) {
            const counterDiv = document.createElement('small');
            counterDiv.id = 'charCounter';
            counterDiv.className = 'form-text text-muted';
            this.parentNode.appendChild(counterDiv);
        }
        document.getElementById('charCounter').textContent = `${charCount} karakter`;
    });

    // Initialize character counter on page load
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.getElementById('content');
        const charCount = content.value.length;
        const counterDiv = document.createElement('small');
        counterDiv.id = 'charCounter';
        counterDiv.className = 'form-text text-muted';
        counterDiv.textContent = `${charCount} karakter`;
        content.parentNode.appendChild(counterDiv);
    });
</script>
@endpush
