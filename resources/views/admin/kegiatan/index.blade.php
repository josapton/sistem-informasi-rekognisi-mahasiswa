@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-calendar-alt mr-1"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('kegiatanCreate') }}" class="btn btn-sm btn-primary">
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
                        <th>Nama Kegiatan</th>
                        <th>Tipe Konversi</th>
                        <th>Bobot</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kegiatan }}</td>
                        <td>
                            <span class="badge badge-{{ $item->tipe_konversi === 'SKS' ? 'success' : 'secondary' }}">{{ $item->tipe_konversi }}</span>
                        </td>
                        <td><strong>{{ $item->bobot ?? $item->kegiatan->bobot }}</strong> SKS</td>
                        <td>
                            <a href="{{ route('kegiatanDetail', $item->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-info-circle mr-1"></i>
                                Detail
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('kegiatanEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                <i class="fas fa-trash mr-1"></i>
                                Hapus
                            </button>
                            @include('admin.kegiatan.modal')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection