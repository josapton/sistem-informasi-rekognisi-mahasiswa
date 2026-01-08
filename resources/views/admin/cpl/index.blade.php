@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-book mr-1"></i>
        {{ $title }}
    </h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        @if($cplCount !== 10)
            <div class="alert alert-warning text-center mb-0">Jumlah CPL saat ini: <strong>{{ $cplCount }}</strong>. Sistem mengharuskan tepat 10 CPL. Silakan perbaiki data CPL sebelum mengubah deskripsi.</div>
        @endif

        @if($cpls->isEmpty())
            <div class="alert alert-info text-center mb-0">Belum ada CPL.</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode CPL</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cpls as $cpl)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>@php
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
                        <td>{{ $cpl->deskripsi }}</td>
                        <td>
                            @if($cplCount === 10)
                                <a href="{{ route('cpl.edit', $cpl->kode_cpl) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                            @else
                                <button class="btn btn-sm btn-secondary" disabled>Locked</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
