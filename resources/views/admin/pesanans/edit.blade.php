@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Pesanan</h1>
    <a href="{{ route('admin.pesanans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.pesanans.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_user">Pelanggan <span class="text-danger">*</span></label>
                    <select name="id_user" id="id_user" class="form-control @error('id_user') is-invalid @enderror" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_user', $pesanan->id_user) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('id_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_hewan">Hewan <span class="text-danger">*</span></label>
                    <select name="id_hewan" id="id_hewan" class="form-control @error('id_hewan') is-invalid @enderror" required>
                        <option value="">-- Pilih Hewan --</option>
                        @foreach($hewans as $hewan)
                            <option value="{{ $hewan->id }}" {{ old('id_hewan', $pesanan->id_hewan) == $hewan->id ? 'selected' : '' }}>{{ $hewan->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_layanan">Layanan <span class="text-danger">*</span></label>
                    <select name="id_layanan" id="id_layanan" class="form-control @error('id_layanan') is-invalid @enderror" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($layanans as $layanan)
                            <option value="{{ $layanan->id }}" {{ old('id_layanan', $pesanan->id_layanan) == $layanan->id ? 'selected' : '' }}>{{ $layanan->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_layanan">Tanggal Layanan <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" class="form-control @error('tanggal_layanan') is-invalid @enderror" value="{{ old('tanggal_layanan', $pesanan->tanggal_layanan) }}" required>
                    @error('tanggal_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', $pesanan->tanggal_mulai) }}">
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" value="{{ old('tanggal_kembali', $pesanan->tanggal_kembali) }}">
                    @error('tanggal_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status_pembayaran">Status Pembayaran <span class="text-danger">*</span></label>
                    <select name="status_pembayaran" id="status_pembayaran" class="form-control @error('status_pembayaran') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="belum" {{ old('status_pembayaran', $pesanan->status_pembayaran) == 'belum' ? 'selected' : '' }}>Belum</option>
                        <option value="lunas" {{ old('status_pembayaran', $pesanan->status_pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status_pesanan">Status Pesanan <span class="text-danger">*</span></label>
                    <select name="status_pesanan" id="status_pesanan" class="form-control @error('status_pesanan') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="menunggu" {{ old('status_pesanan', $pesanan->status_pesanan) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ old('status_pesanan', $pesanan->status_pesanan) == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ old('status_pesanan', $pesanan->status_pesanan) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="batal" {{ old('status_pesanan', $pesanan->status_pesanan) == 'batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                    @error('status_pesanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="catatan">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3" placeholder="Catatan khusus tentang pesanan (opsional)">{{ old('catatan', $pesanan->catatan) }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary shadow px-4"><i class="fas fa-save mr-1"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
