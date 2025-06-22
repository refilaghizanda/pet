@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Pesanan Saya</h1>
    <a href="{{ route('pelanggan.pesanans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('pelanggan.pesanans.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_hewan">Hewan <span class="text-danger">*</span></label>
                    <select name="id_hewan" id="id_hewan" class="form-control" required>
                        <option value="">-- Pilih Hewan --</option>
                        @foreach($hewans as $hewan)
                            <option value="{{ $hewan->id }}">{{ $hewan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_layanan">Layanan <span class="text-danger">*</span></label>
                    <select name="id_layanan" id="id_layanan" class="form-control" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($layanans as $layanan)
                            <option value="{{ $layanan->id }}">{{ $layanan->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_layanan">Tanggal Layanan <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" placeholder="Opsional">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" placeholder="Opsional">
                </div>
                {{-- <div class="col-md-6 mb-3">
                    <label for="catatan">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="1" placeholder="Catatan khusus (opsional)"></textarea>
                </div> --}}
                <input type="hidden" name="status_pembayaran" value="belum">
                <input type="hidden" name="status_pesanan" value="menunggu">
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
