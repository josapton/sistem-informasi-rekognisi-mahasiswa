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
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Kegiatan Diterima</th>
                        <th>Pilih CPL</th>
                        <th>Tipe_Konversi</th>
                        <th>Jumlah_Konversi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>F2306103501017</td>
                        <td>Joko Saptono</td>
                        <td>MBKM Wirausaha</td>
                        <td>
                        <select class="form-control">
                            <option value="1">CPL 1</option>
                            <option value="2">CPL 2</option>
                            <option value="3">CPL 3</option>
                            <option value="4">CPL 4</option>
                            <option value="5">CPL 5</option>
                            <option value="6">CPL 6</option>
                            <option value="7">CPL 7</option>
                            <option value="8">CPL 8</option>
                            <option value="9">CPL 9</option>
                            <option value="10">CPL 10</option>
                        </select>
                        </td>


                        <td>
                            <select class="form-control">
                                <option value="1">SKS</option>
                                <option value="2">Mikrokredensial</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control">
                                <option value="1">1 sks</option>
                                <option value="2">2 sks</option>
                                <option value="3">3 sks</option>
                            </select>
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