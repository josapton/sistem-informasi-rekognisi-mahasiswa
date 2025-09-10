@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<a href="{{ route('kegiatan') }}" class="btn btn-sm btn-primary mb-3">
    <i class="fas fa-arrow-left mr-1"></i>
    Kembali
</a>
<div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h1 mb-0 text-gray-800">
        {{ $kegiatan->nama_kegiatan }}
    </h1>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="mb-0 text-primary">
        {{ $kegiatan->deskripsiKegiatan->penempatan }}
    </h3>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                            Tipe Konversi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kegiatan->tipe_konversi }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-secondary text-uppercase mb-1">
                            Bobot</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kegiatan->bobot }} SKS</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-weight fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success text-uppercase">Kriteria</h6>
    </div>
    <div class="card-body">
        <p>{{ $kegiatan->deskripsiKegiatan->kriteria }}</p>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info text-uppercase">Deskripsi</h6>
    </div>
    <div class="card-body">
        <p>{{ $kegiatan->deskripsiKegiatan->deskripsi }}</p>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning text-uppercase">Capaian Pembelajaran</h6>
    </div>
    <div class="card-body">
        <p>{{ $kegiatan->deskripsiKegiatan->cpl }}</p>
    </div>
</div>
@endsection