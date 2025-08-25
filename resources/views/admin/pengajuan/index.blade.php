@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="#" class="btn btn-sm btn-primary">Edit Data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Kegiatan</th>
                        <th>Jenis Kegiatan</th>
                        <th>Waktu</th>
                        <th>Bukti</th>
                        <th>Capaian Pembelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Joko Saptono</td>
                        <td>Microsoft Hackathon</td>
                        <td>
                            <span class="badge badge-primary">Lomba</span>
                        </td>
                        <td>
                            1 Minggu
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Bukti</a>
                        </td>
                        <td>
                            <span class="badge badge-success">3 SKS</span>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">Terima</a>
                            <a href="#" class="btn btn-sm btn-danger">Tolak</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection