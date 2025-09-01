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
                        <th>Nomor</th>
                        <th>Nama Kegiatan</th>
                        <th>Tipe Konversi</th>
                        <th>Bobot</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>F2306103501017</td>
                        <td>MBKM Wirausaha</td>
                        <td>
                            <span class="badge badge-primary">Admin</span>
                        </td>
                        <td>
                            <span class="badge badge-secondary">Aktif</span>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">Validasi</a>
                            <a href="#" class="btn btn-sm btn-danger">Tolak</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection