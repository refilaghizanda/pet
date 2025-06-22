@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Pesanan</h1>
    <a href="{{ route('admin.pesanans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.pesanans.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_user">Pelanggan <span class="text-danger">*</span></label>
                    <select name="id_user" id="id_user" class="form-control @error('id_user') is-invalid @enderror" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
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
                            <option value="{{ $layanan->id }}" {{ old('id_layanan') == $layanan->id ? 'selected' : '' }}>{{ $layanan->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_layanan">Tanggal Layanan <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" class="form-control @error('tanggal_layanan') is-invalid @enderror" value="{{ old('tanggal_layanan') }}" required>
                    @error('tanggal_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}">
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" value="{{ old('tanggal_kembali') }}">
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
                        <option value="belum" {{ old('status_pembayaran') == 'belum' ? 'selected' : '' }}>Belum</option>
                        <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status_pesanan">Status Pesanan <span class="text-danger">*</span></label>
                    <select name="status_pesanan" id="status_pesanan" class="form-control @error('status_pesanan') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="menunggu" {{ old('status_pesanan') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ old('status_pesanan') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ old('status_pesanan') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="batal" {{ old('status_pesanan') == 'batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                    @error('status_pesanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="catatan">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3" placeholder="Catatan khusus tentang pesanan (opsional)">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
    const userSelect = document.getElementById('id_user');
    const hewanSelect = document.getElementById('id_hewan');

    userSelect.addEventListener('change', function() {
        const userId = this.value;

        // Reset hewan select
        hewanSelect.innerHTML = '<option value="">-- Pilih Hewan --</option>';

        if (userId) {
            // Fetch hewan berdasarkan user
            fetch(`/admin/pesanans/get-hewan/${userId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(hewan => {
                        const option = document.createElement('option');
                        option.value = hewan.id;
                        option.textContent = hewan.nama;
                        hewanSelect.appendChild(option);
                    });
                    console.log('Hewan loaded:', data.length);
                })
                .catch(error => {
                    console.error('Error fetching hewan:', error);
                });
        }
    });

    // Trigger change event if there's a pre-selected value
    if (userSelect.value) {
        userSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
