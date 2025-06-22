@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Transaksi</h1>
    <a href="{{ route('pelanggan.transaksis.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<!-- Informasi Pembayaran -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-left-primary shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-university mr-2"></i>Informasi Rekening Bank
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary">Bank BCA</h6>
                        <p class="mb-1"><strong>No. Rekening:</strong></p>
                        <p class="text-success font-weight-bold">1234-5678-9012</p>
                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                        <p class="text-dark">PetCare Ngunut</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary">Bank Mandiri</h6>
                        <p class="mb-1"><strong>No. Rekening:</strong></p>
                        <p class="text-success font-weight-bold">9876-5432-1098</p>
                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                        <p class="text-dark">PetCare Ngunut</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-left-success shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-mobile-alt mr-2"></i>E-Wallet & QRIS
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-success">DANA</h6>
                        <p class="mb-1"><strong>No. HP:</strong></p>
                        <p class="text-success font-weight-bold">0812-3456-7890</p>
                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                        <p class="text-dark">PetCare Ngunut</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-success">OVO</h6>
                        <p class="mb-1"><strong>No. HP:</strong></p>
                        <p class="text-success font-weight-bold">0812-3456-7890</p>
                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                        <p class="text-dark">PetCare Ngunut</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-edit mr-2"></i>Form Edit Transaksi
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('pelanggan.transaksis.update', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Pesanan</label>
                    <input type="text" class="form-control" value="{{ $transaksi->pesanan->hewan->nama ?? '-' }} - {{ $transaksi->pesanan->layanan->nama ?? '-' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Jumlah Bayar</label>
                    <input type="text" class="form-control" value="Rp {{ number_format($transaksi->jumlah_bayar,0,',','.') }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="metode_pembayaran">Metode Pembayaran <span class="text-danger">*</span></label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="transfer" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="cash" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="qris" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'qris' ? 'selected' : '' }}>QRIS</option>
                        <option value="dana" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'dana' ? 'selected' : '' }}>DANA</option>
                        <option value="ovo" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'ovo' ? 'selected' : '' }}>OVO</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bukti_transfer">Bukti Transfer <span class="text-danger">*</span></label><br>
                    @if($transaksi->bukti_transfer)
                        <a href="{{ asset('storage/' . $transaksi->bukti_transfer) }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">
                            <i class="fas fa-file"></i> Lihat Bukti
                        </a><br>
                    @endif
                    <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control-file">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah. Format: JPG, PNG, PDF</small>
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
