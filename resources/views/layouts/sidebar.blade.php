<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-graduation-cap"></i> --}}
            <img src="logo-ti-2.png" alt="Logo SIREMA" width="60">
        </div>
        <div class="sidebar-brand-text mx-3">Rekognisi Mahasiswa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $menuDashboard ?? '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tv"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data User
    </div>

    <!-- Nav Item - Users -->
    {{-- <li class="nav-item {{ $menuAdminUsers ?? '' }}">
        <a class="nav-link" href="{{ route('users') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span></a>
    </li> --}}

    <li class="nav-item {{ $menuAdminUsers ?? '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>Data User</span>
        </a>
        <div id="collapseUtilities" class="collapse {{ $menuAdminUsersCollapse ?? '' }}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ $menuAdminUsersAll ?? '' }}" href="{{ route('users') }}">User</a>
                <a class="collapse-item {{ $menuAdminUsersAdmin ?? '' }}" href="{{ route('usersAdmin') }}">Admin</a>
                <a class="collapse-item {{ $menuAdminUsersKaprodi ?? '' }}" href="{{ route('usersKaprodi') }}">Kaprodi</a>
                <a class="collapse-item {{ $menuAdminUsersMahasiswa ?? '' }}" href="{{ route('usersMahasiswa') }}">Mahasiswa</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item {{ $menuAdminKegiatan ?? '' }}">
        <a class="nav-link" href="{{ route('kegiatan') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Data Kegiatan</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item {{ $menuAdminPengajuan ?? '' }}">
        <a class="nav-link" href="{{ route('pengajuan') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Data Pengajuan</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item {{ $menuAdminKonversi ?? '' }}">
        <a class="nav-link" href="{{ route('konversi') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Data Konversi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>