@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-receipt text-primary mr-2"></i>
        Detail Transaksi
    </h1>
    <div>
        <a href="{{ route('admin.transaksis.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit mr-1"></i> Edit
        </a>
        <a href="{{ route('admin.transaksis.index') }}" class="btn btn-secondary btn-sm">
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
                    Informasi Transaksi
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Kode Transaksi</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-hashtag text-primary mr-1"></i>
                                {{ $transaksi->code_transaksi ?? 'TRX-' . str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Pesanan</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-shopping-cart text-info mr-1"></i>
                                #{{ $transaksi->pesanan->id ?? '-' }} - {{ $transaksi->pesanan->code_pesanan ?? 'PS-' . str_pad($transaksi->pesanan->id, 4, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Pelanggan</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-user text-success mr-1"></i>
                                {{ $transaksi->pesanan->user->name ?? '-' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Hewan</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-paw text-warning mr-1"></i>
                                {{ $transaksi->pesanan->hewan->nama ?? '-' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Layanan</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-tools text-info mr-1"></i>
                                {{ $transaksi->pesanan->layanan->nama ?? '-' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Metode Pembayaran</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-credit-card text-primary mr-1"></i>
                                {{ ucfirst($transaksi->metode_pembayaran) }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Jumlah Bayar</label>
                            <div class="form-control-plaintext bg-success text-white rounded p-2">
                                <i class="fas fa-money-bill-wave mr-1"></i>
                                Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold text-dark">Tanggal Transaksi</label>
                            <div class="form-control-plaintext bg-light rounded p-2">
                                <i class="fas fa-calendar text-secondary mr-1"></i>
                                {{ $transaksi->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-file-alt mr-1"></i>
                    Bukti Transfer
                </h6>
            </div>
            <div class="card-body text-center">
                @if($transaksi->bukti_transfer)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $transaksi->bukti_transfer) }}"
                             alt="Bukti Transfer"
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 200px;">
                    </div>
                    <a href="{{ asset('storage/' . $transaksi->bukti_transfer) }}"
                       target="_blank"
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-external-link-alt mr-1"></i>
                        Lihat Full Size
                    </a>
                @else
                    <div class="text-muted">
                        <i class="fas fa-image fa-3x mb-3"></i>
                        <p>Bukti transfer tidak tersedia</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow">
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
                        @if($transaksi->pesanan->status_pembayaran == 'lunas')
                            <span class="badge badge-success badge-lg">
                                <i class="fas fa-check-circle mr-1"></i> Lunas
                            </span>
                        @elseif($transaksi->pesanan->status_pembayaran == 'pending')
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
                        @if($transaksi->pesanan->status_pesanan == 'selesai')
                            <span class="badge badge-success badge-lg">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @elseif($transaksi->pesanan->status_pesanan == 'proses')
                            <span class="badge badge-info badge-lg">
                                <i class="fas fa-cog mr-1"></i> Proses
                            </span>
                        @elseif($transaksi->pesanan->status_pesanan == 'menunggu')
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
    </div>
</div>
@endsection
