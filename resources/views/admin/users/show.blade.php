@extends('layouts.dashboard')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail User</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $user->alamat }}</td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <td>{{ $user->no_telepon }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ ucfirst($user->role) }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
