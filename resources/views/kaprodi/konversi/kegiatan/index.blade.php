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
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>CPL</th>
                        <th>Kegiatan Diterima</th>
                        <th>Tipe Konversi</th>
                        <th>Jumlah Konversi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $konversi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
                            <td><strong>{{ $konversi->kegiatan->bobot }}</strong> SKS</td>
                            <td>
                                <form action="{{ route('validasiPengajuanKonversi', $konversi) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control mb-1" required>
                                        <option value="divalidasi">Setujui</option>
                                        <option value="ditolak">Tolak</option>
                                    </select>
                                    <textarea name="catatan_validator" class="form-control mb-1" placeholder="Catatan . . ."></textarea>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-save mr-1"></i>
                                        Simpan
                                    </button>
                                </form>
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