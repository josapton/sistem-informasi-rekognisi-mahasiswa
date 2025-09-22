<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-graduation-cap"></i> --}}
            <img src="{{ asset('logo-uby.png') }}" alt="Logo Universitas Boyolali" width="50">
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
        Menu
    </div>

    @if (Auth::user()->role == 'Admin')
        <li class="nav-item {{ $menuAdminUsers ?? '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesAdminUsers"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-users"></i>
                <span>User</span>
            </a>
            <div id="collapseUtilitiesAdminUsers" class="collapse {{ $menuAdminUsersCollapse ?? '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ $menuAdminUsersAll ?? '' }}" href="{{ route('users') }}">Data User</a>
                    <h6 class="collapse-header">Lihat Data:</h6>
                    <a class="collapse-item {{ $menuAdminUsersAdmin ?? '' }}" href="{{ route('usersAdmin') }}">Admin</a>
                    <a class="collapse-item {{ $menuAdminUsersKaprodi ?? '' }}" href="{{ route('usersKaprodi') }}">Kaprodi</a>
                    <a class="collapse-item {{ $menuAdminUsersMahasiswa ?? '' }}" href="{{ route('usersMahasiswa') }}">Mahasiswa</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ $menuAdminKegiatan ?? '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesAdminKegiatan"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Kegiatan</span>
            </a>
            <div id="collapseUtilitiesAdminKegiatan" class="collapse {{ $menuAdminKegiatanCollapse ?? '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ $menuAdminKegiatanAll ?? '' }}" href="{{ route('kegiatan') }}">Data Kegiatan</a>
                    <a class="collapse-item {{ $menuAdminPengajuanKegiatan ?? '' }}" href="{{ route('pengajuanKegiatan') }}">Data Pengajuan Kegiatan</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ $menuAdminKonversi ?? '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesAdminKonversi"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-exchange-alt"></i>
                <span>Konversi</span>
            </a>
            <div id="collapseUtilitiesAdminKonversi" class="collapse {{ $menuAdminKonversiCollapse ?? '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kegiatan:</h6>
                    <a class="collapse-item {{ $menuAdminKonversiKegiatan ?? '' }}" href="{{ route('konversiKegiatan') }}">Konversi Kegiatan</a>
                    <a class="collapse-item {{ $menuAdminKonversiKegiatan2 ?? '' }}" href="{{ route('riwayatKonversiKegiatan') }}">Riwayat Konversi Kegiatan</a>
                    <h6 class="collapse-header">SKS:</h6>
                    <a class="collapse-item {{ $menuAdminKonversiMatkul ?? '' }}" href="#">Konversi Matkul/Mikro</a>
                </div>
            </div>
        </li>
    @elseif (Auth::user()->role == 'Kaprodi')
        <li class="nav-item {{ $menuKaprodiUsersMahasiswa ?? '' }}">
            <a class="nav-link" href="{{ route('usersMahasiswa') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Mahasiswa</span></a>
        </li>

        <li class="nav-item {{ $menuKaprodiKegiatan ?? '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesKaprodiKegiatan"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Kegiatan</span>
            </a>
            <div id="collapseUtilitiesKaprodiKegiatan" class="collapse {{ $menuKaprodiKegiatanCollapse ?? '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ $menuKaprodiKegiatanAll ?? '' }}" href="{{ route('kegiatan') }}">Data Kegiatan</a>
                    <a class="collapse-item {{ $menuKaprodiPengajuanKegiatan ?? '' }}" href="{{ route('pengajuanKegiatan') }}">Data Pengajuan Kegiatan</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ $menuKaprodiKonversi ?? '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesKaprodiKonversi"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-exchange-alt"></i>
                <span>Konversi</span>
            </a>
            <div id="collapseUtilitiesKaprodiKonversi" class="collapse {{ $menuKaprodiKonversiCollapse ?? '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kegiatan:</h6>
                    <a class="collapse-item {{ $menuKaprodiKonversiKegiatan ?? '' }}" href="{{ route('konversiKegiatan') }}">Konversi Kegiatan</a>
                    <a class="collapse-item {{ $menuKaprodiKonversiKegiatan2 ?? '' }}" href="{{ route('riwayatKonversiKegiatan') }}">Riwayat Konversi Kegiatan</a>
                    <h6 class="collapse-header">SKS:</h6>
                    <a class="collapse-item {{ $menuKaprodiKonversiMatkul ?? '' }}" href="#">Konversi Matkul/Mikro</a>
                </div>
            </div>
        </li>
    @else
        <li class="nav-item {{ $menuMahasiswaKegiatan ?? '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesMahasiswaKegiatan"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Kegiatan</span>
            </a>
            <div id="collapseUtilitiesMahasiswaKegiatan" class="collapse {{ $menuMahasiswaKegiatanCollapse ?? '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ $menuMahasiswaKegiatanAll ?? '' }}" href="{{ route('kegiatan') }}">Kegiatan</a>
                    <a class="collapse-item {{ $menuMahasiswaPengajuanKegiatan ?? '' }}" href="{{ route('pengajuanKegiatan') }}">Pengajuan Kegiatan</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ $menuMahasiswaKonversi ?? '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesMahasiswaKonversi"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-exchange-alt"></i>
                <span>Konversi</span>
            </a>
            <div id="collapseUtilitiesMahasiswaKonversi" class="collapse {{ $menuMahasiswaKonversiCollapse ?? '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kegiatan:</h6>
                    <a class="collapse-item {{ $menuMahasiswaKonversiKegiatan ?? '' }}" href="{{ route('konversiKegiatan') }}">Konversi Kegiatan</a>
                    <a class="collapse-item {{ $menuMahasiswaKonversiKegiatan2 ?? '' }}" href="{{ route('riwayatKonversiKegiatan') }}">Riwayat Konversi Kegiatan</a>
                    <h6 class="collapse-header">SKS:</h6>
                    <a class="collapse-item {{ $menuMahasiswaKonversiMatkul ?? '' }}" href="#">Konversi Matkul/Mikro</a>
                </div>
            </div>
        </li>
    @endif

    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>