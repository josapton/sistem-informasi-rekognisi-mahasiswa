@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-fw fa-file"></i>
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
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Kegiatan Diajukan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $item)
                        @foreach ($item->mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mahasiswa->username }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $item->nama_kegiatan ?? $item->kegiatan_id }}</td>
                                <td>
                                    @if ($mahasiswa->pivot->status == 'menunggu')
                                        <span class="text-secondary font-weight-bold">Menunggu</span>
                                    @elseif ($mahasiswa->pivot->status == 'diterima')
                                        <span class="text-success font-weight-bold">Diterima</span>
                                    @elseif ($mahasiswa->pivot->status == 'ditolak')
                                        <span class="text-danger font-weight-bold">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($mahasiswa->pivot->status == 'menunggu')
                                        <form action="{{ route('pengajuanKegiatanUpdate', [$mahasiswa, $item]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-control form-control-sm d-inline w-auto" style="vertical-align:middle;" onchange="this.form.submit()">
                                                <option value="menunggu" {{ $mahasiswa->pivot->status == 'menunggu' ? 'selected' : '' }} disabled>Menunggu</option>
                                                <option value="diterima" {{ $mahasiswa->pivot->status == 'diterima' ? 'selected' : '' }} style="color:green;">
                                                    Terima
                                                </option>
                                                <option value="ditolak" {{ $mahasiswa->pivot->status == 'ditolak' ? 'selected' : '' }} style="color:red;">
                                                    Tolak
                                                </option>
                                            </select>
                                        </form>
                                    @elseif ($mahasiswa->pivot->status == 'diterima')
                                        <form action="{{ route('pengajuanKegiatanUpdate', [$mahasiswa, $item]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-control form-control-sm d-inline w-auto" style="vertical-align:middle;" onchange="this.form.submit()">
                                                <option value="diterima" {{ $mahasiswa->pivot->status == 'diterima' ? 'selected' : '' }} style="color: green;">
                                                    Terima
                                                </option>
                                                <option value="ditolak" {{ $mahasiswa->pivot->status == 'ditolak' ? 'selected' : '' }} style="color: red;">
                                                    Tolak
                                                </option>
                                            </select>
                                        </form>
                                    @else
                                        <form action="{{ route('pengajuanKegiatanUpdate', [$mahasiswa, $item]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-control form-control-sm d-inline w-auto" style="vertical-align:middle;" onchange="this.form.submit()">
                                                <option value="diterima" {{ $mahasiswa->pivot->status == 'diterima' ? 'selected' : '' }} style="color: green;">
                                                    Terima
                                                </option>
                                                <option value="ditolak" {{ $mahasiswa->pivot->status == 'ditolak' ? 'selected' : '' }} style="color: red;">
                                                    Tolak
                                                </option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection