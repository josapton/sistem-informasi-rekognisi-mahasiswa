<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rekognisi Mahasiswa</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <img src="https://static.vecteezy.com/system/resources/previews/005/322/429/original/happy-university-students-free-vector.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Sistem Informasi Rekognisi Mahasiswa</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('loginProcess') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user @error('username') is-invalid @enderror"
                                                placeholder="Masukkan Username/NIM/NPM..." name="username" value="{{ old('username') }}">
                                                @error('username')
                                                    <small class="text-danger d-flex justify-content-center">{{ $message }}</small>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="password" placeholder="Password" name="password">
                                                @error('password')
                                                    <small class="text-danger d-flex justify-content-center">{{ $message }}</small>
                                                @enderror
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input mb-1" type="checkbox" id="showPasswordCheck">
                                                        <label class="form-check-label small mt-1" for="showPasswordCheck">
                                                            Tampilkan Password
                                                        </label>
                                                    </div>
                                                </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="text-center">
                                                <label class="small">Masukkan NIM/NPM dan Password</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-sign-in-alt mr-1"></i>
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <label class="small">Mengalami kendala?</label>
                                        <a class="small" href="{{ route('contact.whatsapp') }}" target="_blank">Hubungi Staff/Admin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    @session('success')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}'
            });
        </script>
    @endsession
    @session('error')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}'
            });
        </script>
    @endsession

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.querySelector('#password');
            const showPasswordCheck = document.querySelector('#showPasswordCheck');

            // Dengarkan event 'change', bukan 'click'
            showPasswordCheck.addEventListener('change', function () {
                // Gunakan properti 'checked' dari checkbox untuk menentukan tipe input
                // Jika dicentang (true), tipe = 'text'. Jika tidak (false), tipe = 'password'.
                passwordInput.type = this.checked ? 'text' : 'password';
            });
        });
    </script>

</body>

</html>