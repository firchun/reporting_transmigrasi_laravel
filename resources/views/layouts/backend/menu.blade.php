<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        {{-- logo aplikasi --}}
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">

                <img src="{{ asset('img/merauke.png') }}" alt="logo" style="width: 40px; height:auto;"> </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ env('APP_NAME') ?? 'Laravel' }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ env('APP_NAME') ?? 'Laravel' }}</span>
        </li>
        <li class="menu-item {{ request()->is('home*') ? 'active' : '' }}">
            <a href="{{ url('/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard {{ Auth::user()->role }}</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>
        <li class="menu-item {{ request()->is('bidang') ? 'active' : '' }}">
            <a href="{{ url('/bidang') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Analytics">Data Bidang</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('pendidikan') ? 'active' : '' }}">
            <a href="{{ url('/pendidikan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Analytics">Data Pendidikan</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengguna</span>
        </li>
        <li class="menu-item {{ request()->is('users/admin') ? 'active' : '' }}">
            <a href="{{ url('/users/admin') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Admin</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('users/kepala-bidang') ? 'active' : '' }}">
            <a href="{{ url('/users/kepala-bidang') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Kepala Bidang</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('users/perusahaan') ? 'active' : '' }}">
            <a href="{{ url('/users/perusahaan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">perusahaan</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Akun</span>
        </li>
        <li class="menu-item {{ request()->is('profile') ? 'active' : '' }}">
            <a href="{{ url('/profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profile</div>
            </a>
        </li>

    </ul>
</aside>
