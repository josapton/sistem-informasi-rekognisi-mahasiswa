@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-book mr-1"></i>
        {{ $title }}
    </h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('matakuliah.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-1"></i>
            Tambah Data
        </a>
    </div>
    <div class="card-body">
        @if($matakuliah->isEmpty())
            <div class="alert alert-info text-center mb-0">Belum ada mata kuliah.</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matakuliah as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_matakuliah }}</td>
                        <td>{{ $item->bobot }} SKS</td>
                        <td>
                            <a href="{{ route('matakuliah.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                <i class="fas fa-trash mr-1"></i>
                                Hapus
                            </button>
                            @include('admin.matakuliah.modal')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
