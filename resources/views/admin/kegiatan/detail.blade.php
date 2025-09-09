@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-details-alt mr-1"></i>
        {{ $title }}
    </h1>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Kegiatan</h6>
    </div>
    <div class="card-body">
        <p><strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>
        <p><strong>Tipe Konversi:</strong> {{ $kegiatan->tipe_konversi }}</p>
        <p><strong>Bobot:</strong> {{ $kegiatan->bobot }}</p>
        <p><strong>Deskripsi:</strong> {{ $kegiatan->deskripsiKegiatan->deskripsi }}</p>
        <p><strong>CPL:</strong> {{ $kegiatan->deskripsiKegiatan->cpl }}</p>
    </div>
</div>
@endsection