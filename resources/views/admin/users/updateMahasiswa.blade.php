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
        <a href="{{ route('usersMahasiswa') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('usersUpdateMahasiswa2', $mahasiswa->username) }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <span class="text-danger">*</span>
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $mahasiswa->nama }}" placeholder="Masukkan nama">
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cpl">CPL</label>
                    <div>
                        @foreach($data_cpl as $cpl)
                            <div class="form-check">
                                <input 
                                    class="form-check-input @error('cpl') is-invalid @enderror" 
                                    type="checkbox" 
                                    name="cpl[]" 
                                    id="cpl_{{ $cpl->kode_cpl }}" 
                                    value="{{ $cpl->kode_cpl }}"
                                    @if(is_array(old('cpl')) && in_array($cpl->kode_cpl, old('cpl')))
                                        checked
                                    @elseif(old('cpl') === null && $mahasiswa->cpls->contains($cpl->kode_cpl))
                                        checked
                                    @endif
                                    >
                                <label class="form-check-label" for="cpl_{{ $cpl->kode_cpl }}">
                                    {{ $cpl->kode_cpl }}
                                </label>
                            </div>
                        @endforeach
                        @error('cpl')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <span class="text-danger">*</span>
                    <label for="sks">SKS</label>
                    <input type="decimal" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks" value="{{ old('sks', $mahasiswa->sks) }}" placeholder="Masukkan SKS">
                    @error('sks')
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