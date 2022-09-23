<nav class="navbar navbar-expand-lg c-topbar py-0 mb-4">
    <button id="sidebarToggleTop" class="sidebar-toggler btn btn-link me-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="bi bi-justify"></i>
    </button>

    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <li class="nav-item dropdown d-sm-none d-inline-block">
            <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-search"></i></a>
            <div class="dropdown-menu shadow">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="notification"
                            aria-label="Recipient's username" aria-describedby="button-addon2" />
                        <button class="btn btn-primary" type="button" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-bell-fill"></i></a>
            <div class="dropdown-menu dropdown-menu-list shadow">
                <h6 class="dropdown-header">
                    notification header
                </h6>
                <a href="" class="dropdown-item d-flex align-items-center">
                    <div class="icon bg-primary me-3">
                        <i class="bi bi-list"></i>
                    </div>
                    <div class="content">
                        <span class="c-secondary-text">December 12, 2020</span>
                        <span class="c-main-text">A new monthly report is
                            ready to download.</span>
                    </div>
                </a>
                <a href="" class="dropdown-item d-flex align-items-center">
                    <div class="icon bg-primary me-3">
                        <i class="bi bi-list"></i>
                    </div>
                    <div class="content">
                        <span class="c-secondary-text">December 12, 2020</span>
                        <span class="c-main-text">A new monthly report is
                            ready to download.</span>
                    </div>
                </a>
                <a href="" class="dropdown-item d-flex align-items-center">
                    <div class="icon bg-primary me-3">
                        <i class="bi bi-list"></i>
                    </div>
                    <div class="content">
                        <span class="c-secondary-text">December 12, 2020</span>
                        <span class="c-main-text">A new monthly report is
                            ready to download.</span>
                    </div>
                </a>
                <a href="" class="dropdown-item text-center">
                    <span class="text-xs text-gray-600">Show all noti</span>
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-envelope"></i></a>
            <div class="dropdown-menu dropdown-menu-list shadow">
                <h6 class="dropdown-header">
                    notification header
                </h6>
                <a href="" class="dropdown-item d-flex align-items-center">
                    <div class="icon bg-primary me-3">
                        <i class="bi bi-list"></i>
                    </div>
                    <div class="content">
                        <span class="c-main-text text-truncate mb-1">A new monthly report is now
                            able to download.
                        </span>
                        <span class="c-secondary-text">Ben Tennyson . 39m</span>
                    </div>
                </a>
                <a href="" class="dropdown-item d-flex align-items-center">
                    <div class="icon bg-primary me-3">
                        <i class="bi bi-list"></i>
                    </div>
                    <div class="content">
                        <span class="c-main-text text-truncate mb-1">A new monthly report is now
                            able to download.
                        </span>
                        <span class="c-secondary-text">December 12, 2020</span>
                    </div>
                </a>
                <a href="" class="dropdown-item d-flex align-items-center">
                    <div class="icon bg-primary me-3">
                        <i class="bi bi-list"></i>
                    </div>
                    <div class="content">
                        <span class="c-main-text text-truncate mb-1">A new monthly report is now
                            able to download.
                        </span>
                        <span class="c-secondary-text">December 12, 2020</span>
                    </div>
                </a>
                <a href="" class="dropdown-item text-center">
                    <span class="text-xs text-gray-600">Show all noti</span>
                </a>
            </div>
        </li>
        <li class="nav-item dropdown avatar-nav">
            <a class="nav-link justify-content-center" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="text-sm d-none d-lg-inline-block me-2">{{ Auth::user()->name }}</span>
                <div class="c-avatar"></div>
            </a>
            <div class="dropdown-menu avatar-menu shadow">
                {{-- <a href="" class="dropdown-item d-flex align-items-center">
                    <i class="bi bi-person me-3"></i>
                    <span class="">Profile</span>
                </a>
                <a href="" class="dropdown-item d-flex align-items-center">
                    <i class="bi bi-wrench me-3"></i>
                    <span class="">Profile</span>
                </a>
                <a href="" class="dropdown-item d-flex align-items-center">
                    <i class="bi bi-list me-3"></i>
                    <span class="">Acitivity log</span>
                </a>
                <div class="dropdown-divider"></div> --}}

                <form class="dropdown-item d-flex align-items-center" action="{{ route('logout') }}" method="post">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    this.closest('form').submit();"><i
                            class="bi bi-box-arrow-right me-3"></i><span class="">Log out</span></a>
                </form>
            </div>
        </li>
    </ul>
</nav>
