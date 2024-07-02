<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ url('storage/' . config('app.logo', 'vendor/admin-lte/img/AdminLTELogo.png')) }}" alt="Application Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Kursus Online') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::check() && Auth::user()->foto_profil)
                    <!-- Tampilkan gambar profil pengguna -->
                    <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <!-- Tampilkan gambar profil default -->
                    <img src="{{ asset('vendor/admin-lte/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama ?? 'Guest' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::check() && Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kategoriKursus.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>Kategori Kursus</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kursus.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Kursus</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.materi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Materi Kursus</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>Pendaftaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pembayaran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>Pembayaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.tugas.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Tugas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pengumpulanTugas.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-upload"></i>
                            <p>Pengumpulan Tugas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.penilaian.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Penilaian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kehadiran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Kehadiran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.isi_kehadiran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Isi Kehadiran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.informasi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>Informasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pengaturan.edit') }}" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Pengaturan</p>
                        </a>
                    </li>
                @elseif(Auth::check() && Auth::user()->role == 'guru')
                    <li class="nav-item">
                        <a href="{{ route('guru.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.kursus.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book-reader"></i>
                            <p>Kursus Saya</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.materi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Materi Kursus</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.tugas.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Tugas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.pengumpulan_tugas.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-upload"></i>
                            <p>Pengumpulan Tugas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.kehadiran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Kehadiran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.penilaian.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Penilaian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.profile.show') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                @elseif(Auth::check() && Auth::user()->role == 'siswa')
                    <li class="nav-item">
                        <a href="{{ route('siswa.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.kursus.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Kursus yang Tersedia</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.pendaftaran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>Pendaftaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.pembayaran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>Pembayaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.kursus_saya.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book-reader"></i>
                            <p>Kursus Saya</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.materi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Materi Kursus</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.tugas.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Daftar Tugas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.pengumpulan_tugas.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-upload"></i>
                            <p>Pengumpulan Tugas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.kehadiran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Kehadiran Tersedia</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.isi_kehadiran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Data Kehadiran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.penilaian.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Data Penilaian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.informasi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>Data Informasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.profile.show') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
