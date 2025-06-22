@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Hewan Saya</h1>
    <a href="{{ route('pelanggan.hewans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('pelanggan.hewans.update', $hewan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama">Nama Hewan <span class="text-danger">*</span></label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $hewan->nama }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jenis">Jenis <span class="text-danger">*</span></label>
                    <input type="text" name="jenis" id="jenis" class="form-control" value="{{ $hewan->jenis }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="umur">Umur <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" name="umur" id="umur" class="form-control" value="{{ $hewan->umur }}" min="0" required>
                        <span class="input-group-text">tahun</span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="catatan">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Catatan khusus tentang hewan (opsional)">{{ $hewan->catatan }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary shadow px-4"><i class="fas fa-save mr-1"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
