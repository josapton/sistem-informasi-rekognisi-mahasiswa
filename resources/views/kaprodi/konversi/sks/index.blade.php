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
            <div class="alert alert-success text-center mb-0">
                Tidak ada pengajuan yang perlu ditinjau saat ini. ✨
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM Mahasiswa</th>
                        <th>Nama Mahasiswa</th>
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
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ $item->total_sks }} SKS</td>
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