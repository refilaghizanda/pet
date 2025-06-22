@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil</h1>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('pelanggan.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="no_telepon">No. Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-control" value="{{ $user->no_telepon }}" placeholder="08xxxxxxxxxx">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Alamat lengkap">{{ $user->alamat }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti">
                    <small class="form-text text-muted">Minimal 6 karakter</small>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary shadow px-4"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
