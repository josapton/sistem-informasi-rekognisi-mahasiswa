@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-edit mr-1"></i>
        {{ $title }}
    </h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('cpl.index') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('cpl.update', $cpl->kode_cpl) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kode CPL</label>
                <p>
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

                    <span style="background-color: {{ $colorClass }}">{{ $cpl->kode_cpl }}</span></td>
                </p>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $cpl->deskripsi) }}</textarea>
            </div>
            <button class="btn btn-primary">
                <i class="fas fa-save mr-1"></i>
                Simpan
            </button>
        </form>
    </div>
</div>
@endsection
