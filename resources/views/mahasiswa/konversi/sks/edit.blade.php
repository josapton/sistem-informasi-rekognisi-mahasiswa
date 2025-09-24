@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-fw fa-search"></i>
        {{ $title }}
    </h1>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <span class="mr-1">Tabungan SKS Anda Saat Ini:</span>
        <span>
            <strong style="color: #17a2b8;">{{ Auth::user()->mahasiswa->sks }}</strong> SKS
        </span>
    </div>
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card-body">
        {{-- Tampilkan Catatan dari Kaprodi --}}
        @if(!empty($konversi->catatan_kaprodi))
            <div class="alert alert-warning">
                <strong><i class="fas fa-info-circle me-1"></i> Catatan Perbaikan dari Kaprodi:</strong>
                <p class="mb-0 fst-italic">"{{ $konversi->catatan_kaprodi }}"</p>
            </div>
        @endif
    <form action="{{ route('konversi2Update', $konversi->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- PENTING: Gunakan method PUT untuk update --}}

        <div id="items-container">
            {{-- Loop data yang sudah ada --}}
            @foreach ($konversi->details as $index => $detail)
                <div class="card mb-3 item-konversi">
                    <div class="card-body">
                        <h5>Item Konversi #<span class="item-number">{{ $index + 1 }}</span></h5>
                        <div class="row">
                            <div class="col-md-5">
                                <label>Nama Matakuliah / Mikrokredensial</label>
                                <input type="text" name="nama_item[]" class="form-control" value="{{ $detail->nama_item }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Jenis</label>
                                <select name="jenis[]" class="form-control">
                                    <option value="matakuliah" {{ $detail->jenis == 'matakuliah' ? 'selected' : '' }}>Matakuliah</option>
                                    <option value="mikrokredensial" {{ $detail->jenis == 'mikrokredensial' ? 'selected' : '' }}>Mikrokredensial</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Bobot SKS</label>
                                <input type="number" step="0.1" name="sks[]" class="form-control" value="{{ $detail->sks }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tombol untuk menambah baris (versi JavaScript) --}}
        <button type="button" id="tambah-baris-btn" class="btn btn-sm btn-secondary">
            <i class="fas fa-plus mr-1"></i>
            Tambah Baris
        </button>
        
        <hr>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i>
            Simpan Perubahan & Ajukan Kembali
        </button>
        <a href="{{ route('riwayatKonversiSKS') }}" class="btn btn-secondary">
            <i class="fas fa-times mr-1"></i>
            Batal
        </a>
    </form>
    </div>
</div>
@endsection

{{-- Sertakan kembali script JavaScript untuk tambah baris --}}
@push('scripts')
<script>
    // Kode JavaScript yang sama persis dengan yang ada di halaman create Anda
    document.addEventListener('DOMContentLoaded', function () {
        const tambahBtn = document.getElementById('tambah-baris-btn');
        const itemsContainer = document.getElementById('items-container');
        
        tambahBtn.addEventListener('click', function () {
            let itemCount = itemsContainer.querySelectorAll('.item-konversi').length;
            const newRow = document.createElement('div');
            newRow.classList.add('card', 'mb-3', 'item-konversi');
            newRow.innerHTML = `
                <div class="card-body">
                    <h5>Item Konversi #<span class="item-number">${itemCount + 1}</span></h5>
                    <div class="row">
                        <div class="col-md-5"><label>Nama Matakuliah / Mikrokredensial</label><input type="text" name="nama_item[]" class="form-control" required></div>
                        <div class="col-md-4"><label>Jenis</label><select name="jenis[]" class="form-control"><option value="matakuliah">Matakuliah</option><option value="mikrokredensial">Mikrokredensial</option></select></div>
                        <div class="col-md-3"><label>Bobot SKS</label><input type="number" name="sks[]" class="form-control" required></div>
                    </div>
                </div>
            `;
            itemsContainer.appendChild(newRow);
        });
    });
</script>
@endpush