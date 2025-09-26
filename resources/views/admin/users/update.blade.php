@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-edit mr-1"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('users') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('usersUpdate2', $user->id) }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <span class="text-danger">*</span>
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $user -> username }}" placeholder="Masukkan username">
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user -> email }}" placeholder="Masukkan email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <span class="text-danger">*</span>
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                        <option disabled>Pilih role</option>
                        <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Kaprodi" {{ $user->role === 'Kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                        <option value="Mahasiswa" {{ $user->role === 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    </select>
                    @error('role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <span class="text-danger">*</span>
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <span class="text-danger">*</span>
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Masukkan password konfirmasi">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="showPasswordCheck">
                    <label class="form-check-label" for="showPasswordCheck">Tampilkan Password</sabel>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i>
                    Simpan
                </button>
            </div>
        </div>
        </form>
    </div>
    <div class="card-footer py-1.5">
        <div class="col-md-6 small">
            <span class="text-danger">*</span>
            Wajib diisi
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Ubah ini dari querySelector menjadi querySelectorAll
            //    Selector ini sekarang memilih #password DAN #password_confirmation
            const passwordFields = document.querySelectorAll('#password, #password_confirmation');
            
            const showPasswordCheck = document.querySelector('#showPasswordCheck');
        
            showPasswordCheck.addEventListener('change', function () {
                // Tentukan tipe berdasarkan status checkbox (checked/unchecked)
                const newType = this.checked ? 'text' : 'password';
            
                // 2. Loop melalui setiap input field yang sudah dipilih
                passwordFields.forEach(function(field) {
                    // Terapkan tipe baru ke setiap field
                    field.type = newType;
                });
            });
        });
    </script>
</div>
@endsection