@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-shopping-cart text-primary mr-2"></i>
        Detail Pesanan Saya
    </h1>
    <div>
        <a href="{{ route('pelanggan.pesanans.edit', $pesanan->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit mr-1"></i> Edit
        </a>
        <a href="{{ route('pelanggan.pesanans.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-1"></i>
                    Informasi Pesanan
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Kode Pesanan</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-hashtag text-primary mr-1"></i>
                                {{ $pesanan->code_pesanan ?? 'PS-' . str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Hewan</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-paw text-warning mr-1"></i>
                                {{ $pesanan->hewan->nama ?? '-' }}
                                <small class="text-muted d-block mt-1">
                                    {{ $pesanan->hewan->jenis ?? '-' }} - {{ $pesanan->hewan->ras ?? '-' }}
                                </small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Layanan</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-tools text-info mr-1"></i>
                                {{ $pesanan->layanan->nama ?? '-' }}
                                <small class="text-muted d-block mt-1">
                                    Rp {{ number_format($pesanan->layanan->harga ?? 0, 0, ',', '.') }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Tanggal Layanan</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-calendar text-primary mr-1"></i>
                                {{ \Carbon\Carbon::parse($pesanan->tanggal_layanan)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Tanggal Mulai</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-play text-success mr-1"></i>
                                {{ $pesanan->tanggal_mulai ? \Carbon\Carbon::parse($pesanan->tanggal_mulai)->format('d/m/Y') : '-' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Tanggal Kembali</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-stop text-danger mr-1"></i>
                                {{ $pesanan->tanggal_kembali ? \Carbon\Carbon::parse($pesanan->tanggal_kembali)->format('d/m/Y') : '-' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Tanggal Dibuat</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-clock text-secondary mr-1"></i>
                                {{ $pesanan->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>

                @if($pesanan->catatan)
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Catatan</label>
                            <div class="form-control-plaintext bg-light rounded p-3">
                                <i class="fas fa-sticky-note text-warning mr-1"></i>
                                {{ $pesanan->catatan }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-1"></i>
                    Status
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="font-weight-bold text-dark">Status Pembayaran</label>
                    <div class="mt-1">
                        @if($pesanan->status_pembayaran == 'lunas')
                            <span class="badge badge-success badge-lg">
                                <i class="fas fa-check-circle mr-1"></i> Lunas
                            </span>
                        @elseif($pesanan->status_pembayaran == 'pending')
                            <span class="badge badge-warning badge-lg">
                                <i class="fas fa-clock mr-1"></i> Pending
                            </span>
                        @else
                            <span class="badge badge-secondary badge-lg">
                                <i class="fas fa-times-circle mr-1"></i> Belum
                            </span>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold text-dark">Status Pesanan</label>
                    <div class="mt-1">
                        @if($pesanan->status_pesanan == 'selesai')
                            <span class="badge badge-success badge-lg">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @elseif($pesanan->status_pesanan == 'proses')
                            <span class="badge badge-info badge-lg">
                                <i class="fas fa-cog mr-1"></i> Proses
                            </span>
                        @elseif($pesanan->status_pesanan == 'menunggu')
                            <span class="badge badge-warning badge-lg">
                                <i class="fas fa-clock mr-1"></i> Menunggu
                            </span>
                        @else
                            <span class="badge badge-danger badge-lg">
                                <i class="fas fa-times-circle mr-1"></i> Batal
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-receipt mr-1"></i>
                    Transaksi
                </h6>
            </div>
            <div class="card-body">
                @if($pesanan->transaksi)
                    <div class="mb-3">
                        <label class="font-weight-bold text-dark">Kode Transaksi</label>
                        <div class="form-control-plaintext bg-light rounded p-2">
                            <i class="fas fa-hashtag text-primary mr-1"></i>
                            {{ $pesanan->transaksi->code_transaksi ?? 'TRX-' . str_pad($pesanan->transaksi->id, 4, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold text-dark">Metode Pembayaran</label>
                        <div class="form-control-plaintext bg-light rounded p-2">
                            <i class="fas fa-credit-card text-primary mr-1"></i>
                            {{ ucfirst($pesanan->transaksi->metode_pembayaran) }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold text-dark">Jumlah Bayar</label>
                        <div class="form-control-plaintext bg-success text-white rounded p-2">
                            <i class="fas fa-money-bill-wave mr-1"></i>
                            Rp {{ number_format($pesanan->transaksi->jumlah_bayar, 0, ',', '.') }}
                        </div>
                    </div>
                    <a href="{{ route('pelanggan.transaksis.show', $pesanan->transaksi->id) }}" class="btn btn-primary btn-sm btn-block">
                        <i class="fas fa-eye mr-1"></i> Lihat Detail Transaksi
                    </a>
                @else
                    <div class="text-center text-muted">
                        <i class="fas fa-receipt fa-3x mb-3"></i>
                        <p>Belum ada transaksi</p>
                        @if($pesanan->status_pembayaran != 'lunas' && $pesanan->status_pesanan != 'menunggu')
                            <a href="{{ route('pelanggan.transaksis.create', ['pesanan_id' => $pesanan->id]) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus mr-1"></i> Buat Transaksi
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
