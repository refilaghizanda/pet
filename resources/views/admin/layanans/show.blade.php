@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Layanan</h1>
    <a href="{{ route('admin.layanans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama Layanan</th>
                <td>{{ $layanan->nama }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $layanan->deskripsi }}</td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
            </tr>
        </table>
</div>
