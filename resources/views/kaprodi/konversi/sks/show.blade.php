@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-fw fa-history"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="table-responsive">
    @if($detail->isEmpty())
        <div class="alert alert-info text-center mb-0">
            Belum ada riwayat pengajuan yang diproses.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>NIM Mahasiswa</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal Diajukan</th>
                            <th>Tanggal Diproses</th>
                            <th>Total SKS</th>
                            <th class="text-center">Status Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->mahasiswa->username ?? 'N/A' }}</td>
                                <td>{{ $item->mahasiswa->nama ?? 'N/A' }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>{{ $item->updated_at->format('d M Y') }}</td>
                                <td>{{ $item->total_sks }} SKS</td>
                                <td class="text-center">
                                    @php
                                        $statusClass = [
                                            'divalidasi' => 'text-success font-weight-bold',
                                            'ditolak' => 'text-danger font-weight-bold',
                                        ][$item->status] ?? 'text-white';
                                    @endphp
                                    <span class="{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection