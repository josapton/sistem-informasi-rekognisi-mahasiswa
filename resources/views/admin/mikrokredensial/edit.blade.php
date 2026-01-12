@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-plus mr-1"></i>
        {{ $title }}
    </h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('mikrokredensial.index') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('mikrokredensial.store', $mikrokredensial->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <span class="text-danger">*</span>
                <label for="nama_mikrokredensial">Nama</label>
                <input type="text" name="nama_mikrokredensial" id="nama_mikrokredensial" class="form-control @error('nama_mikrokredensial') is-invalid @enderror" value="{{ old('nama_mikrokredensial', $mikrokredensial->nama_mikrokredensial) }}" placeholder="Masukan Nama Mikrokredensial">
                @error('nama_mikrokredensial')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <span class="text-danger">*</span>
                <label for="bobot">Bobot (desimal)</label>
                <input type="number" step="0.1" min="0" max="1" name="bobot" id="bobot" class="form-control @error('bobot') is-invalid @enderror" value="{{ old('bobot', $mikrokredensial->bobot) }}" placeholder="Masukan Bobot">
                @error('bobot')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $mikrokredensial->deskripsi) }}</textarea>
            </div>
            <button class="btn btn-primary">
                <i class="fas fa-save mr-1"></i>
                Simpan
            </button>
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
