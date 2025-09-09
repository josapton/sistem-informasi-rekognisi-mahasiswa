@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-plus mr-1"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('kegiatan') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('kegiatanStore') }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <span class="text-danger">*</span>
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" placeholder="Masukkan nama kegiatan">
                @error('nama_kegiatan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <span class="text-danger">*</span>
                <label for="tipe_konversi">Tipe Konversi</label>
                <select name="tipe_konversi" id="tipe_konversi" class="form-control @error('tipe_konversi') is-invalid @enderror">
                <option selected disabled>Pilih Tipe Konversi</option>
                <option value="SKS" {{ old('tipe_konversi') == 'SKS' ? 'selected' : '' }}>SKS</option>
                <option value="Mikrokredensial" {{ old('tipe_konversi') == 'Mikrokredensial' ? 'selected' : '' }}>Mikrokredensial</option>
                </select>
                @error('tipe_konversi')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <span class="text-danger">*</span>
                <label for="bobot">Bobot</label>
                <input type="number" step="0.1" class="form-control @error('bobot') is-invalid @enderror" id="bobot" name="bobot" value="{{ old('bobot') }}" placeholder="Masukkan bobot">
                @error('bobot')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                <span class="text-danger">*</span>
                <label for="deskripsi">Detail Kegiatan</label>
                <input type="text" class="form-control @error('penempatan') is-invalid @enderror" id="penempatan" name="penempatan" value="{{ old('penempatan') }}" placeholder="Masukkan penempatan">
                @error('penempatan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <input type="text" class="form-control @error('kriteria') is-invalid @enderror" id="kriteria" name="kriteria" value="{{ old('kriteria') }}" placeholder="Masukkan kriteria">
                @error('kriteria')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Masukkan deskripsi">
                @error('deskripsi')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <input type="text" class="form-control @error('cpl') is-invalid @enderror" id="cpl" name="cpl" value="{{ old('cpl') }}" placeholder="Masukkan CPL">
                @error('cpl')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            </div>
            <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i>
                Simpan
            </button>
            </div>
        </div>
        </form>
    </div>
    <div class="card-footer py-1.5">
        <div class="col-md-6 small">
            <span class="text-danger">*</span>
            Wajib diisi
        </div>
    </div>
</div>
@endsection