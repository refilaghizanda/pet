@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Transaksi</h1>
    <a href="{{ route('admin.transaksis.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.transaksis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_pesanan">Pesanan <span class="text-danger">*</span></label>
                    <select name="id_pesanan" id="id_pesanan" class="form-control @error('id_pesanan') is-invalid @enderror" required>
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pesanans as $pesanan)
                            <option value="{{ $pesanan->id }}" {{ old('id_pesanan') == $pesanan->id ? 'selected' : '' }}>#{{ $pesanan->id }} - {{ $pesanan->user->name ?? '-' }}</option>
                        @endforeach
                    </select>
                    @error('id_pesanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="metode_pembayaran">Metode Pembayaran <span class="text-danger">*</span></label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control @error('metode_pembayaran') is-invalid @enderror" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="qris" {{ old('metode_pembayaran') == 'qris' ? 'selected' : '' }}>QRIS</option>
                        <option value="dana" {{ old('metode_pembayaran') == 'dana' ? 'selected' : '' }}>DANA</option>
                        <option value="ovo" {{ old('metode_pembayaran') == 'ovo' ? 'selected' : '' }}>OVO</option>
                    </select>
                    @error('metode_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jumlah_bayar">Jumlah Bayar <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar') }}" min="0" placeholder="0" readonly required>
                    </div>
                    <small class="form-text text-muted">Jumlah bayar otomatis dari harga layanan pesanan</small>
                    @error('jumlah_bayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bukti_transfer">Bukti Transfer <span class="text-danger">*</span></label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control @error('bukti_transfer') is-invalid @enderror" accept="image/*" required>
                    @error('bukti_transfer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary shadow px-4"><i class="fas fa-save mr-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pesananSelect = document.getElementById('id_pesanan');
    const jumlahBayarInput = document.getElementById('jumlah_bayar');

    pesananSelect.addEventListener('change', function() {
        const pesananId = this.value;

        if (pesananId) {
            // Fetch harga layanan dari server
            fetch(`/admin/transaksis/get-harga/${pesananId}`)
                .then(response => response.json())
                .then(data => {
                    jumlahBayarInput.value = data.harga;
                    console.log('Harga layanan:', data.harga);
                })
                .catch(error => {
                    console.error('Error fetching harga:', error);
                    jumlahBayarInput.value = '';
                });
        } else {
            jumlahBayarInput.value = '';
        }
    });

    // Trigger change event if there's a pre-selected value
    if (pesananSelect.value) {
        pesananSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
