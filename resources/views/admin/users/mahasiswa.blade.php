@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-users mr-1"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('usersCreate') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-1"></i>
            Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" name="mahasiswa">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>CPL</th>
                        <th>SKS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->where('role', 'Mahasiswa') as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->mahasiswa ? $item->mahasiswa->nama : '-' }}</td>
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
                        <td><strong>{{ $item->mahasiswa ? $item->mahasiswa->sks : '0' }}</strong></td>
                        <td>
                            <a href="{{ route('usersUpdateMahasiswa', $item->username) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                <i class="fas fa-trash mr-1"></i>
                                Hapus
                            </button>
                            @include('admin.users.modal')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection