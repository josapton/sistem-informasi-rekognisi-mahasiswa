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
    <div class="card-body">
        @if($kegiatan->isEmpty())
            <div class="alert alert-info text-center mb-0">
                Belum ada kegiatan yang ditambahkan.
            </div>
        @else
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
                            <form action="{{ route('pendaftaranKegiatan', $item) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Apakah Anda yakin ingin mendaftar kegiatan ini?')">
                                    <i class="fas fa-paper-plane mr-1"></i>
                                    Daftar Kegiatan
                                </button>
                            </form>
                            @if (session('kegiatan_id') == $item->id)
                                @if(session('success'))
                                    <div style="color: green;">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                    <div style="color: red;">{{ session('error') }}</div>
                                @endif
                            @endif
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