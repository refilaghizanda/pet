@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Transaksi</h1>
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
            <i class="fas fa-plus mr-2"></i>Form Transaksi
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('pelanggan.transaksis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_pesanan">Pesanan <span class="text-danger">*</span></label>
                    <select name="id_pesanan" id="pesananSelect" class="form-control" required>
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pesanans as $pesanan)
                            <option value="{{ $pesanan->id }}" {{ $selectedPesananId == $pesanan->id ? 'selected' : '' }}>
                                {{ $pesanan->hewan->nama ?? '-' }} - {{ $pesanan->layanan->nama ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="metode_pembayaran">Metode Pembayaran <span class="text-danger">*</span></label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="qris" {{ old('metode_pembayaran') == 'qris' ? 'selected' : '' }}>QRIS</option>
                        <option value="dana" {{ old('metode_pembayaran') == 'dana' ? 'selected' : '' }}>DANA</option>
                        <option value="ovo" {{ old('metode_pembayaran') == 'ovo' ? 'selected' : '' }}>OVO</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="text" id="jumlah_bayar" class="form-control" placeholder="Otomatis dari layanan" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bukti_transfer">Bukti Transfer <span class="text-danger">*</span></label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control-file" required>
                    <small class="form-text text-muted">Upload bukti transfer/pembayaran (JPG, PNG, PDF)</small>
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
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pesananSelect = document.getElementById('pesananSelect');
    const jumlahBayarInput = document.getElementById('jumlah_bayar');

    console.log('Script loaded');

    pesananSelect.addEventListener('change', function() {
        const pesananId = this.value;
        console.log('Pesanan changed to:', pesananId);

        if (pesananId) {
            // Fetch harga layanan dari server
            fetch(`/pelanggan/transaksis/get-harga/${pesananId}`)
                .then(response => response.json())
                .then(data => {
                    const harga = data.harga || 0;
                    jumlahBayarInput.value = 'Rp ' + Number(harga).toLocaleString('id-ID');
                    console.log('Harga layanan:', harga);
                })
                .catch(error => {
                    console.error('Error fetching harga:', error);
                    jumlahBayarInput.value = 'Harga tidak tersedia';
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
