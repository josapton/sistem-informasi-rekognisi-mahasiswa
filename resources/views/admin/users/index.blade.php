@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-users mr-1"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('usersCreate') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-1"></i>
            Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->nama }}</td>
                        <td><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
                        <td><span class="badge badge-{{ $item->role === 'Admin' ? 'primary' : ($item->role === 'Dosen' ? 'info' : 'secondary') }}">{{ $item->role }}</span></td>
                        <td>
                            <a href="{{ route('usersUpdate', $item->id) }}">
                                <i class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </i>
                            </a>
                            <a href="#">
                                <i class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection