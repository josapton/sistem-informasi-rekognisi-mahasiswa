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

    <div class="card-body">
        <form action="{{ route('konversi2Store') }}" method="POST">
            @csrf
            <div id="items-container">
                @foreach ($items as $index => $item)
                    <div class="card mb-3 item-konversi">
                        <div class="card-body">
                            <h5>Item Konversi #<span class="item-number">{{ $index + 1 }}</span></h5>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Nama Matakuliah / Mikrokredensial</label>
                                    <input type="text" name="nama_item[]" class="form-control" value="{{ $item['nama_item'] }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Jenis</label>
                                    <select name="jenis[]" class="form-control">
                                        <option value="matakuliah">Matakuliah</option>
                                        <option value="mikrokredensial">Mikrokredensial</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Bobot SKS</label>
                                    <input type="number" step="0.1" name="sks[]" class="form-control" value="{{ $item['sks'] }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        
            <button type="button" id="tambah-baris-btn" class="btn btn-sm btn-secondary">
                <i class="fas fa-plus mr-1"></i>
                Tambah Baris
            </button>

            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-exchange-alt mr-1"></i>
                Ajukan Konversi
            </button>
        </form>
        <script>
            // Pastikan DOM sudah termuat sepenuhnya
            document.addEventListener('DOMContentLoaded', function () {

                // Ambil tombol dan container dari HTML
                const tambahBtn = document.getElementById('tambah-baris-btn');
                const itemsContainer = document.getElementById('items-container');

                // Event listener untuk tombol "Tambah Baris"
                tambahBtn.addEventListener('click', function () {
                    // Hitung jumlah item yang sudah ada untuk penomoran
                    let itemCount = itemsContainer.querySelectorAll('.item-konversi').length;
                
                    // Buat elemen div baru untuk baris item
                    const newRow = document.createElement('div');
                    newRow.classList.add('card', 'mb-3', 'item-konversi');
                
                    // Isi HTML untuk baris baru
                    // Gunakan backtick (`) untuk multiline string yang mudah dibaca
                    newRow.innerHTML = `
                        <div class="card-body">
                            <h5>Item Konversi #<span class="item-number">${itemCount + 1}</span></h5>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Nama Matakuliah / Mikrokredensial</label>
                                    <input type="text" name="nama_item[]" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Jenis</label>
                                    <select name="jenis[]" class="form-control">
                                        <option value="matakuliah">Matakuliah</option>
                                        <option value="mikrokredensial">Mikrokredensial</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Bobot SKS</label>
                                    <input type="number" step="0.1" name="sks[]" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    // Masukkan baris baru ke dalam container
                    itemsContainer.appendChild(newRow);
                });
            });
        </script>
    </div>
</div>
@endsection