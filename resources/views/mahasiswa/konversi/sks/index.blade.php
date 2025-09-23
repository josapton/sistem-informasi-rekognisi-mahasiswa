@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-fw fa-exchange-alt"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        Tabungan SKS Anda Saat Ini: <strong>{{ Auth::user()->mahasiswa->sks }} SKS</strong>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card-body">
        <form action="{{ route('konversi2Store') }}" method="POST">
            @csrf
            <div id="items-container">
                @foreach ($items as $index => $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Item Konversi #{{ $index + 1 }}</h5>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Nama Matakuliah / Mikrokredensial</label>
                                    <input type="text" name="nama_item[]" class="form-control" value="{{ $item['nama_item'] }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Jenis</label>
                                    <select name="jenis[]" class="form-control">
                                        <option value="matakuliah" {{ $item['jenis'] == 'matakuliah' ? 'selected' : '' }}>Matakuliah</option>
                                        <option value="mikrokredensial" {{ $item['jenis'] == 'mikrokredensial' ? 'selected' : '' }}>Mikrokredensial</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Bobot SKS</label>
                                    <input type="number" name="sks[]" class="form-control" value="{{ $item['sks'] }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tombol untuk menambah baris (menggunakan metode PHP) --}}
            <a href="{{ route('konversiMatkul', ['action' => 'add_item'] + request()->except('action')) }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-plus mr-1"></i>
                Tambah Baris
            </a>

            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane mr-1"></i>
                Ajukan Konversi
            </button>
        </form>
    </div>
</div>
@endsection