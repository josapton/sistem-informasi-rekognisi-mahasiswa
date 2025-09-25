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
        <a href="{{ route('konversiSKS') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali
        </a>
    </div>
    <div class="card-body">
    <p>
        <strong>Mahasiswa:</strong> {{ $konversi->mahasiswa->nama }} <br>
        <strong>NIM:</strong> {{ $konversi->mahasiswa->username }} <br>
        <strong>Sisa Tabungan SKS:</strong> <span style="color: #17a2b8; font-weight: bold;">{{ $konversi->mahasiswa->sks }}</span> SKS <br>
        <strong>CPL:</strong> @if($konversi->mahasiswa)
                                @foreach($konversi->mahasiswa->cpls as $cpl)
                                    @php
                                        $kategoriCpl = substr($cpl->kode_cpl, 0, 5);

                                        switch ($kategoriCpl) {
                                            case 'CPL01': 
                                                $colorClass = '#90ee90';
                                                break;
                                            case 'CPL02': 
                                                $colorClass = '#90ee90';
                                                break;
                                            case 'CPL03':
                                                $colorClass = '#add8e6';
                                                break;
                                            case 'CPL04':
                                                $colorClass = '#add8e6';
                                                break;
                                            case 'CPL05':
                                                $colorClass = '#ffff4c';
                                                break;
                                            case 'CPL06': 
                                                $colorClass = '#ffff4c';
                                                break;
                                            case 'CPL07': 
                                                $colorClass = '#ff9999';
                                                break;
                                            case 'CPL08':
                                                $colorClass = '#ff9999';
                                                break;
                                            case 'CPL09':
                                                $colorClass = '#ff9999';
                                                break;
                                            case 'CPL10':
                                                $colorClass = '#ff9999';
                                                break;
                                            default:
                                                $colorClass = 'bg-secondary';
                                        }
                                    @endphp

                                    <span style="background-color: {{ $colorClass }}">{{ $cpl->kode_cpl }}</span>
                                @endforeach
                            @else
                                -
                            @endif
    </p>

        <form action="{{ route('konversi2Update', $konversi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div id="items-container">
                 @foreach ($konversi->details as $index => $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Item Konversi #{{ $index + 1 }} (Bisa dimodifikasi)</h5>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Nama Matakuliah / Mikrokredensial</label>
                                    <input type="text" name="nama_item[]" class="form-control" value="{{ $item->nama_item }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Jenis</label>
                                    <select name="jenis[]" class="form-control">
                                        <option value="matakuliah" {{ $item->jenis == 'matakuliah' ? 'selected' : '' }}>Matakuliah</option>
                                        <option value="mikrokredensial" {{ $item->jenis == 'mikrokredensial' ? 'selected' : '' }}>Mikrokredensial</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Bobot SKS</label>
                                    <input type="number" step="0.1" name="sks[]" class="form-control" value="{{ $item->sks }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="catatan_kaprodi">Catatan (jika ditolak/dikembalikan)</label>
                <textarea name="catatan_kaprodi" id="catatan_kaprodi" class="form-control" rows="3">{{ $konversi->catatan_kaprodi }}</textarea>
            </div>

            <div class="form-group mt-3">
                <label for="status">Pilih Tindakan:</label>
                <select name="status" class="form-control" required>
                    <option value="divalidasi">Validasi / Setujui</option>
                    <option value="ditolak">Tolak</option>
                    <option value="dikembalikan">Kembalikan (untuk direvisi)</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-save mr-1"></i>
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection