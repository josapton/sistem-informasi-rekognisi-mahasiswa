@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-fw fa-history"></i>
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
                        <th>Tanggal Pengajuan</th>
                        <th>Nama Kegiatan</th>
                        <th>Tipe Konversi</th>
                        <th>Jumlah Konversi</th>
                        <th>Status</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>{{ $item->kegiatan->nama_kegiatan }}</td>
                            <td>
                                <span class="badge badge-{{ $item->kegiatan->tipe_konversi === 'SKS' ? 'success' : 'secondary' }}">{{ $item->kegiatan->tipe_konversi }}</span>
                            </td>
                            <td>{{ $item->kegiatan->bobot }}</td>
                            <td>
                                @if ($item->status === 'diajukan')
                                    <span class="badge badge-secondary">Diajukan</span>
                                @elseif ($item->status === 'divalidasi')
                                    <span class="badge badge-success">Divalidasi</span>
                                @elseif ($item->status === 'ditolak')
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $item->catatan_validator }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection