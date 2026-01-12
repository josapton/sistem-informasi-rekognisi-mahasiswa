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
                                <select name="nama_item[]" class="form-control nama-item-select" required>
                                    <option value="">-- Pilih Matakuliah / Mikrokredensial --</option>
                                    <optgroup label="Matakuliah">
                                        @foreach(($matakuliahs ?? []) as $m)
                                            @php $text = $m->nama_matakuliah ?? ''; $sksVal = $m->bobot ?? 0; @endphp
                                            <option value="{{ $text }}" data-sks="{{ $sksVal }}" data-type="matakuliah" {{ $detail->nama_item == $text ? 'selected' : '' }}>{{ $text }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Mikrokredensial">
                                        @foreach(($mikrokredensials ?? []) as $mk)
                                            @php $text = $mk->nama_mikrokredensial ?? ''; $sksVal = $mk->bobot ?? 0; @endphp
                                            <option value="{{ $text }}" data-sks="{{ $sksVal }}" data-type="mikrokredensial" {{ $detail->nama_item == $text ? 'selected' : '' }}>{{ $text }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Jenis</label>
                                <select class="form-control jenis-display" disabled>
                                    <option value="matakuliah" {{ $detail->jenis == 'matakuliah' ? 'selected' : '' }}>Matakuliah</option>
                                    <option value="mikrokredensial" {{ $detail->jenis == 'mikrokredensial' ? 'selected' : '' }}>Mikrokredensial</option>
                                </select>
                                <input type="hidden" name="jenis[]" value="{{ $detail->jenis }}">
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
    document.addEventListener('DOMContentLoaded', function () {
        const tambahBtn = document.getElementById('tambah-baris-btn');
        const itemsContainer = document.getElementById('items-container');

        const matakuliahs = @json($matakuliahs ?? []);
        const mikrokredensials = @json($mikrokredensials ?? []);

        function buildNamaSelectHtml(selectedName = '') {
            let html = '<select name="nama_item[]" class="form-control nama-item-select" required>';
            html += '<option value="">-- Pilih Matakuliah / Mikrokredensial --</option>';
            html += '<optgroup label="Matakuliah">';
            matakuliahs.forEach(function(m){
                const text = (m.nama || m.nama_matakuliah || m.title || '');
                const sks = (m.sks || m.bobot || 0);
                const selected = (text === selectedName) ? ' selected' : '';
                html += `<option value="${escapeHtml(text)}" data-sks="${sks}" data-type="matakuliah"${selected}>${escapeHtml(text)}</option>`;
            });
            html += '</optgroup>';
            html += '<optgroup label="Mikrokredensial">';
            mikrokredensials.forEach(function(mk){
                const text = (mk.nama || mk.nama_mikrokredensial || mk.title || '');
                const sks = (mk.sks || mk.bobot || 0);
                const selected = (text === selectedName) ? ' selected' : '';
                html += `<option value="${escapeHtml(text)}" data-sks="${sks}" data-type="mikrokredensial"${selected}>${escapeHtml(text)}</option>`;
            });
            html += '</optgroup>';
            html += '</select>';
            return html;
        }

        function wireSelect(selectEl) {
            selectEl.addEventListener('change', function (e) {
                const opt = selectEl.selectedOptions[0];
                const sks = opt ? opt.dataset.sks || 0 : 0;
                const row = selectEl.closest('.item-konversi');
                if (!row) return;
                const sksInput = row.querySelector('input[name="sks[]"]');
                const jenisDisplay = row.querySelector('.jenis-display');
                const jenisHidden = row.querySelector('input[name="jenis[]"]');
                let type = '';
                if (opt) type = opt.dataset.type || '';
                if (sksInput) {
                    sksInput.value = sks;
                }
                if (jenisDisplay && type) {
                    if (type === 'matakuliah' || type === 'mikrokredensial') jenisDisplay.value = type;
                }
                if (jenisHidden && type) {
                    jenisHidden.value = type;
                }
                updateDisabledOptions();
            });
        }

        // Wire existing selects and trigger initial fill
        itemsContainer.querySelectorAll('.nama-item-select').forEach(function(sel){
            wireSelect(sel);
            sel.dispatchEvent(new Event('change'));
        });

        tambahBtn.addEventListener('click', function () {
            let itemCount = itemsContainer.querySelectorAll('.item-konversi').length;
            const newRow = document.createElement('div');
            newRow.classList.add('card', 'mb-3', 'item-konversi');
            newRow.innerHTML = `
                <div class="card-body">
                    <h5>Item Konversi #<span class="item-number">${itemCount + 1}</span></h5>
                    <div class="row">
                        <div class="col-md-5">
                            <label>Nama Matakuliah / Mikrokredensial</label>
                            ${buildNamaSelectHtml()}
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
            itemsContainer.appendChild(newRow);
            const sel = newRow.querySelector('.nama-item-select');
            if (sel) wireSelect(sel);
        });
    });
</script>
@endpush