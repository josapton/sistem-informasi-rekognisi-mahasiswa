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
    <div class="card-body">
        @if($pengajuan->isEmpty())
            <div class="alert alert-info text-center mb-0">
                Tidak ada pengajuan yang perlu ditinjau saat ini.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM Mahasiswa</th>
                        <th>Nama Mahasiswa</th>
                        <th>CPL</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Total SKS</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mahasiswa->username ?? 'N/A' }}</td>
                            <td>{{ $item->mahasiswa->nama ?? 'N/A' }}</td>
                            <td>
                                @if($item->mahasiswa)
                                @foreach($item->mahasiswa->cpls as $cpl)
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
                            </td>
                            <td>{{ $item->created_at->format('d M Y') ?? 'N/A' }}</td>
                            <td><strong>{{ $item->total_sks }}</strong> SKS</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'diajukan' => 'text-secondary font-weight-bold',
                                        'dikembalikan' => 'text-warning font-weight-bold',
                                    ][$item->status] ?? 'text-white';
                                @endphp
                                <span class="{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('konversi2Edit', $item->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-search mr-1"></i> Periksa
                                </a>
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