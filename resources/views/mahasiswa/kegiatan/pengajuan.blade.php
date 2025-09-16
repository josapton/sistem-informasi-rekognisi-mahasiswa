@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-fw fa-file"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Kegiatan Diajukan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $item)
                        @foreach ($item->mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mahasiswa->username }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $item->nama_kegiatan ?? $item->kegiatan_id }}</td>
                                <td>
                                    @if ($mahasiswa->pivot->status == 'menunggu')
                                        <span class="text-secondary font-weight-bold">Menunggu</span>
                                    @elseif ($mahasiswa->pivot->status == 'diterima')
                                        <span class="text-success font-weight-bold">Diterima</span>
                                    @elseif ($mahasiswa->pivot->status == 'ditolak')
                                        <span class="text-danger font-weight-bold">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection