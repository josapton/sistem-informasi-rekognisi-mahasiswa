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
        @if($pengajuan->isEmpty())
            <div class="alert alert-info text-center mb-0">
                Anda belum mendaftar kegiatan.
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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $nomor = 1; @endphp
                    @foreach ($pengajuan as $item)
                        @foreach ($item->mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ $nomor }}</td>
                                <td>{{ $item->nama_kegiatan ?? $item->kegiatan_id }}</td>
                                <td>
                                    <span class="badge badge-{{ $item->tipe_konversi === 'SKS' ? 'success' : 'secondary' }}">{{ $item->tipe_konversi }}</span>
                                </td>
                                <td><strong>{{ $item->bobot ?? $item->kegiatan->bobot }}</strong> SKS</td>
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
                            @php $nomor++; @endphp
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection