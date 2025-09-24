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
<div class="card shadow mb-4">
    <div class="card-body">
        @if($riwayat->isEmpty())
            <div class="alert alert-info text-center mb-0">
                Belum ada riwayat pengajuan yang diproses.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>CPL</th>
                        <th>Kegiatan Diterima</th>
                        <th>Tipe Konversi</th>
                        <th>Jumlah Konversi</th>
                        <th>Status</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $konversi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($konversi->created_at)
                                    {{ $konversi->created_at->format('d M Y') }}
                                @else
                                    - (Tanggal tidak tersedia)
                                @endif
                            </td>
                            <td>{{ $konversi->mahasiswa->username }}</td>
                            <td>{{ $konversi->mahasiswa->nama }}</td>
                            <td>@if($konversi->mahasiswa)
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
                            @endif</td>
                            <td>{{ $konversi->kegiatan->nama_kegiatan }}</td>
                            <td>
                                <span class="badge badge-{{ $konversi->kegiatan->tipe_konversi === 'SKS' ? 'success' : 'secondary' }}">{{ $konversi->kegiatan->tipe_konversi }}</span>
                            </td>
                            <td>{{ $konversi->kegiatan->bobot }}</td>
                            <td>
                                @if ($konversi->status === 'divalidasi')
                                    <span class="text-success font-weight-bold">Divalidasi</span>
                                @elseif ($konversi->status === 'ditolak')
                                    <span class="text-danger font-weight-bold">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $konversi->catatan_validator }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection