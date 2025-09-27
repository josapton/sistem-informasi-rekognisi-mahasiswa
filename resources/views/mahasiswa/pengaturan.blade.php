@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-cogs mr-1"></i>
        {{ $title }}
    </h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="mb-0">Ganti Password</h5>
    </div>
    <div class="card-body">
        {{-- Menampilkan pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('updatePassword') }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- Password Saat Ini --}}
            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password" 
                       class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Baru --}}
            <div class="form-group">
                <label for="new_password">Password Baru</label>
                <input type="password" id="new_password" name="new_password" 
                       class="form-control @error('new_password') is-invalid @enderror" required>
                @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Konfirmasi Password Baru --}}
            <div class="form-group">
                <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                       class="form-control" required>
            </div>

            {{-- Checkbox Tampilkan Password --}}
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="showPasswordCheck">
                <label class="form-check-label" for="showPasswordCheck">Tampilkan Password</sabel>
            </div>
                        
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i>
                Update Password
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-times mr-1"></i>
                Batal
            </a>
        </form>
    </div>
<script>
    // Script untuk toggle tampilkan password
    document.addEventListener('DOMContentLoaded', function () {
        const passwordFields = document.querySelectorAll('#current_password, #new_password, #new_password_confirmation');
        const showPasswordCheck = document.querySelector('#showPasswordCheck');

        showPasswordCheck.addEventListener('change', function () {
            const newType = this.checked ? 'text' : 'password';
            passwordFields.forEach(field => {
                field.type = newType;
            });
        });
    });
</script>
</div>
@endsection