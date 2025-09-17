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
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan Diterima</th>
                        <th>Tipe Konversi</th>
                        <th>Jumlah Konversi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kegiatan }}</td>
                            <td>{{ $item->tipe_konversi }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                <form action="{{ route('konversiStore', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengajukan konversi kegiatan ini?')">
                                        <i class="fas fa-exchange-alt mr-1"></i>
                                        Ajukan Konversi
                                    </button>
                                </form>

                                @if(session('success'))
                                    <div style="color: green;">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                    <div style="color: red;">{{ session('error') }}</div>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection