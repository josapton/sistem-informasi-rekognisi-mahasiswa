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
        <span class="mr-1">Tabungan SKS Anda Saat Ini:</span>
        <span>
            <strong style="color: #17a2b8;">{{ Auth::user()->mahasiswa->sks }}</strong> SKS
        </span>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card-body">
        @if(Auth::user()->mahasiswa->sks<=0)
            <div class="alert alert-info text-center mb-0">
                Anda tidak memiliki SKS untuk dikonversi.
            </div>
        @else
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
                                    <select name="nama_item[]" class="form-control nama-item-select" required>
                                        <option value="">-- Pilih Matakuliah / Mikrokredensial --</option>
                                        <optgroup label="Matakuliah">
                                            @foreach(($matakuliahs ?? []) as $m)
                                                @php $text = $m->nama_matakuliah ?? '' ; $sksVal = $m->bobot ?? 0; @endphp
                                                <option value="{{ $text }}" data-sks="{{ $sksVal }}" data-type="matakuliah" {{ $item['nama_item'] == $text ? 'selected' : '' }}>{{ $text }}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Mikrokredensial">
                                            @foreach(($mikrokredensials ?? []) as $mk)
                                                @php $text = $mk->nama_mikrokredensial ?? '' ; $sksVal = $mk->bobot ?? 0; @endphp
                                                <option value="{{ $text }}" data-sks="{{ $sksVal }}" data-type="mikrokredensial" {{ $item['nama_item'] == $text ? 'selected' : '' }}>{{ $text }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Jenis</label>
                                    <select class="form-control jenis-display" disabled>
                                        <option value="matakuliah">Matakuliah</option>
                                        <option value="mikrokredensial">Mikrokredensial</option>
                                    </select>
                                    <input type="hidden" name="jenis[]" value="{{ $item['jenis'] }}">
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
        @endif
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

                function escapeHtml(unsafe) {
                    return String(unsafe).replace(/[&<>"']/g, function (m) { return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#039;"})[m]; });
                }

                function updateDisabledOptions() {
                    const selected = Array.from(document.querySelectorAll('.nama-item-select')).map(s => s.value).filter(v => v);
                    document.querySelectorAll('.nama-item-select').forEach(function(sel) {
                        sel.querySelectorAll('option').forEach(function(opt) {
                            if (!opt.value) return;
                            if (sel.value === opt.value) {
                                opt.disabled = false;
                                return;
                            }
                            opt.disabled = selected.includes(opt.value);
                        });
                    });
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

                // Wire existing selects and set sks based on selected option
                itemsContainer.querySelectorAll('.nama-item-select').forEach(function(sel){
                    wireSelect(sel);
                    // trigger initial fill
                    sel.dispatchEvent(new Event('change'));
                });
                updateDisabledOptions();

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
                                    <select class="form-control jenis-display" disabled>
                                        <option value="matakuliah">Matakuliah</option>
                                        <option value="mikrokredensial">Mikrokredensial</option>
                                    </select>
                                    <input type="hidden" name="jenis[]" value="matakuliah">
                                </div>
                                <div class="col-md-3">
                                    <label>Bobot SKS</label>
                                    <input type="number" step="0.1" name="sks[]" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    `;
                    itemsContainer.appendChild(newRow);
                    // wire the new select
                    const sel = newRow.querySelector('.nama-item-select');
                    if (sel) wireSelect(sel);
                });
            });
        </script>
    </div>
</div>
@endsection