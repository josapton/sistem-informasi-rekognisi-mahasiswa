@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-edit mr-1"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('usersAdmin') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('usersUpdateAdmin2', $admin->username) }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <span class="text-danger">*</span>
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $admin->nama }}" placeholder="Masukkan nama">
                    @error('nama')
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