<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
    <div class="container-fluid">
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                <i class="ph-list"></i>
            </button>
        </div>

        <div class="navbar-brand flex-1 flex-lg-0">
            <a href="{{ route('admin.dashboard.index') }}" class="d-inline-flex align-items-center">
                <img src="{{ asset('assets/images/text-logo-white.png') }}" alt=""
                    style="width: 100px; height: auto;">
            </a>
        </div>

        <ul class="nav flex-row justify-content-end order-1 order-lg-2">
            <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/images/profile.png') }}" class="w-32px h-32px rounded-pill"
                        alt="">
                    <span
                        class="d-none d-lg-inline-block mx-lg-2">{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'User' }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="ph-sign-out me-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
