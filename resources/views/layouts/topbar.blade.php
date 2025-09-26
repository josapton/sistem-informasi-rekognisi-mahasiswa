<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-lg-inline text-gray-600 small">
                    {{ auth()->user()->role === 'Admin' && auth()->user()->admin ? auth()->user()->admin->nama : (auth()->user()->role === 'Kaprodi' && auth()->user()->kaprodi ? auth()->user()->kaprodi->nama : (auth()->user()->role === 'Mahasiswa' && auth()->user()->mahasiswa ? auth()->user()->mahasiswa->nama : '-')) }}
                </span>
                <img class="img-profile rounded-circle"
                    src="{{ asset('sbadmin2/img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <div class="d-flex justify-content-center">
                    <span class="badge badge-{{ auth()->user()->role === 'Admin' ? 'primary' : (auth()->user()->role === 'Kaprodi' ? 'info' : 'secondary') }}">
                        {{ auth()->user()->role }}
                    </span>
                </div>
                {{-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pengaturan
                </a> --}}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>