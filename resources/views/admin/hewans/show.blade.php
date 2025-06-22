@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Hewan</h1>
    <a href="{{ route('admin.hewans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Pemilik</th>
                <td>{{ $hewan->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Hewan</th>
                <td>{{ $hewan->nama }}</td>
            </tr>
            <tr>
                <th>Jenis</th>
                <td>{{ $hewan->jenis }}</td>
            </tr>
            <tr>
                <th>Umur</th>
                <td>{{ $hewan->umur }}</td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td>{{ $hewan->catatan }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
