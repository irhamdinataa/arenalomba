<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Menu</div>
            <!-- Sidenav Link (Dashboard)-->
            <a class="nav-link {{ (request()->is('admin') || request()->is('admin/dashboard')) ? 'active' : '' }}" href="{{ route('admin-dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <!-- Sidenav Accordion (Posts)-->
            <a class="nav-link {{ (request()->is('admin/pos*')) ? 'active' : '' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pos-menu" aria-expanded="false" aria-controls="pos-menu">
                <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                    Artikel
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ (request()->is('admin/pos*')) ? 'show' : '' }}" id="pos-menu" data-bs-parent="#pos-menu">
                <nav class="sidenav-menu-nested nav" id="pos-menu">
                    <a class="nav-link {{ (request()->is('admin/pos/post') || request()->is('admin/pos/post/*/edit') || request()->is('admin/pos/published') || request()->is('admin/pos/draft') || request()->is('admin/pos/trash')) ? 'active' : '' }}" href="{{ route('post.index') }}">Semua Artikel</a>
                    @if (Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Penulis')
                        <a class="nav-link {{ (request()->is('admin/pos/post/create')) ? 'active' : '' }}" href="{{ route('post.create') }}">Tambah Baru</a>
                    @endif
                    @if (Auth::user()->roles == 'Administrator')
                        <a class="nav-link {{ (request()->is('admin/pos/category*')) ? 'active' : '' }}" href="{{ route('category.index') }}">Kategori</a>
                        <a class="nav-link {{ (request()->is('admin/pos/tag*')) ? 'active' : '' }}" href="{{ route('tag.index') }}">Tag</a>
                    @endif
                </nav>
            </div>
            @if (Auth::user()->roles == 'Administrator')
            <a class="nav-link {{ (request()->is('admin/contest*')) ? 'active' : '' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#contest-menu" aria-expanded="false" aria-controls="contest-menu">
                <div class="nav-link-icon"><i data-feather="monitor"></i></div>
                    Lomba
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ (request()->is('admin/contest*')) ? 'show' : '' }}" id="contest-menu" data-bs-parent="#contest-menu">
                <nav class="sidenav-menu-nested nav" id="contest-menu">
                    <a class="nav-link {{ (request()->is('admin/contest') || request()->is('admin/pos/post/*/edit') || request()->is('admin/contest-published') || request()->is('admin/contest-draft') || request()->is('admin/contest-trash')) ? 'active' : '' }}" href="{{ route('contest.index') }}">Semua Lomba</a>
                    @if (Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Penulis')
                        <a class="nav-link {{ (request()->is('admin/contest/create')) ? 'active' : '' }}" href="{{ route('contest.create') }}">Tambah Baru</a>
                    @endif
                    @if (Auth::user()->roles == 'Administrator')
                        <a class="nav-link {{ (request()->is('admin/contest-category*')) ? 'active' : '' }}" href="{{ route('contest-category.index') }}">Kategori</a>
                        <a class="nav-link {{ (request()->is('admin/contest-tag*')) ? 'active' : '' }}" href="{{ route('contest-tag.index') }}">Tag</a>
                        <a class="nav-link {{ (request()->is('admin/contest-request*')) ? 'active' : '' }}" href="{{ route('contest-request') }}">Pengajuan</a>
                    @endif
                </nav>
            </div>
            <a class="nav-link {{ (request()->is('admin/course*')) ? 'active' : '' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#course-menu" aria-expanded="false" aria-controls="course-menu">
                <div class="nav-link-icon"><i data-feather="layers"></i></div>
                    Kelas
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ (request()->is('admin/course*')) ? 'show' : '' }}" id="course-menu" data-bs-parent="#course-menu">
                <nav class="sidenav-menu-nested nav" id="course-menu">
                    <a class="nav-link {{ (request()->is('admin/course') || request()->is('admin/course-published') || request()->is('admin/course-draft') || request()->is('admin/course-trash')) ? 'active' : '' }}" href="{{ route('course.index') }}">Semua Kelas</a>
                    @if (Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Penulis')
                        <a class="nav-link {{ (request()->is('admin/contest/create')) ? 'active' : '' }}" href="{{ route('course.create') }}">Tambah Baru</a>
                    @endif
                    @if (Auth::user()->roles == 'Administrator')
                        <a class="nav-link {{ (request()->is('admin/course-category*')) ? 'active' : '' }}" href="{{ route('course-category.index') }}">Kategori</a>
                        <a class="nav-link {{ (request()->is('admin/course-tag*')) ? 'active' : '' }}" href="{{ route('course-tag.index') }}">Tag</a>
                    @endif
                </nav>
            </div>
            <a class="nav-link {{ (request()->is('admin/video*')) ? 'active' : '' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#video-menu" aria-expanded="false" aria-controls="video-menu">
                <div class="nav-link-icon"><i data-feather="film"></i></div>
                    Video
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ (request()->is('admin/video*')) ? 'show' : '' }}" id="video-menu" data-bs-parent="#video-menu">
                <nav class="sidenav-menu-nested nav" id="video-menu">
                    <a class="nav-link {{ (request()->is('admin/video') || request()->is('admin/video-published') || request()->is('admin/video-draft') || request()->is('admin/video-trash')) ? 'active' : '' }}" href="{{ route('video.index') }}">Semua Video</a>
                    @if (Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Penulis')
                        <a class="nav-link {{ (request()->is('admin/contest/create')) ? 'active' : '' }}" href="{{ route('video.create') }}">Tambah Baru</a>
                    @endif
                    @if (Auth::user()->roles == 'Administrator')
                        <a class="nav-link {{ (request()->is('admin/video-category*')) ? 'active' : '' }}" href="{{ route('video-category.index') }}">Kategori</a>
                        <a class="nav-link {{ (request()->is('admin/video-tag*')) ? 'active' : '' }}" href="{{ route('video-tag.index') }}">Tag</a>
                    @endif
                </nav>
            </div>
            @endif
            <!-- Sidenav Accordion (Pengguna)-->
            <a class="nav-link {{ (request()->is('admin/users*')) ? 'active' : '' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
                <div class="nav-link-icon"><i data-feather="user"></i></div>
                Pengguna
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ (request()->is('admin/users*')) ? 'show' : '' }}" id="collapseUtilities" data-bs-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    @if (Auth::user()->roles == 'Administrator')
                        <a class="nav-link {{ (request()->is('admin/users/user')) ? 'active' : '' }}" href="{{ route('user.index') }}">Semua Pengguna</a>
                        <a class="nav-link {{ (request()->is('admin/users/user/create')) ? 'active' : '' }}" href="{{ route('user.create') }}">Tambah Baru</a>
                    @endif
                    <a class="nav-link {{ (request()->is('admin/users/user/profile') || request()->is('admin/users/user/profile/password')) ? 'active' : '' }}" href="{{ route('profile-user') }}">Profil</a>
                </nav>
            </div>
            @if (Auth::user()->roles == 'Administrator')
                <!-- Sidenav Link (Pengaturan)-->
                <a class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings">
                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                        Pengaturan
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ (request()->is('admin/settings*')) ? 'show' : '' }}" id="collapseSettings" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link {{ (request()->is('admin/settings/apps')) ? 'active' : '' }}" href="{{ route('apps.index') }}">Aplikasi</a>
                    </nav>
                </div>
            @endif
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>