@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Hewan</h1>
    <a href="{{ route('admin.hewans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.hewans.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_user">Pemilik <span class="text-danger">*</span></label>
                    <select name="id_user" id="id_user" class="form-control @error('id_user') is-invalid @enderror" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('id_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama">Nama Hewan <span class="text-danger">*</span></label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan nama hewan" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jenis">Jenis <span class="text-danger">*</span></label>
                    <input type="text" name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" value="{{ old('jenis') }}" placeholder="Contoh: Kucing, Anjing, Burung" required>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="umur">Umur <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" name="umur" id="umur" class="form-control @error('umur') is-invalid @enderror" value="{{ old('umur') }}" min="0" placeholder="0" required>
                        <span class="input-group-text">tahun</span>
                    </div>
                    @error('umur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="catatan">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3" placeholder="Catatan khusus tentang hewan (opsional)">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary shadow px-4"><i class="fas fa-save mr-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
