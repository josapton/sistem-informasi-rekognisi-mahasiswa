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
@if($history->isEmpty())
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="alert alert-info text-center mb-0">
            Anda belum memiliki riwayat pengajuan konversi SKS.
        </div>
    </div>
</div>
@else

<div class="table-responsive">
@foreach ($history as $pengajuan)
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <span>Diajukan pada: {{ $pengajuan->created_at->format('d F Y, H:i') }}</span>
            @php
                $statusClass = [
                    'diajukan' => 'text-secondary font-weight-bold',
                    'divalidasi' => 'text-success font-weight-bold',
                    'ditolak' => 'text-danger font-weight-bold',
                    'dikembalikan' => 'text-warning font-weight-bold',
                ][$pengajuan->status] ?? 'text-white';
            @endphp
            <span class="{{ $statusClass }}">{{ ucfirst($pengajuan->status) }}</span>
        </div>
        <div class="card-body">
            <h5 class="card-title">Detail Item (Total: {{ $pengajuan->total_sks }} SKS)</h5>
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Nama Item</th>
                        <th>Jenis</th>
                        <th style="width: 15%;">Bobot SKS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->nama_item }}</td>
                            <td>{{ ucfirst($detail->jenis) }}</td>
                            <td class="text-center">{{ $detail->sks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
            @if(!empty($pengajuan->catatan_kaprodi))
                <div class="mt-3">
                    <strong>Catatan dari Kaprodi:</strong>
                    <blockquote class="blockquote bg-light p-3 rounded mt-1 mb-0">
                        <p class="mb-0 fst-italic">"{{ $pengajuan->catatan_kaprodi }}"</p>
                    </blockquote>
                </div>
            @endif
        </div>
        @if($pengajuan->status == 'dikembalikan')
            <div class="card-footer text-end">
                <a href="{{ route('konversi2Edit', $pengajuan->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit mr-1"></i>
                    Perbaiki Pengajuan
                </a>
            </div>
        @endif
    </div>
@endforeach
</div>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.dataTable').DataTable();
    });
</script>
@endpush