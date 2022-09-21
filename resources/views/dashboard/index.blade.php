<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin Dashboard</title>
        @vite(['resources/sass/dashboard/app.scss', 'resources/js/dashboard.js'])

        <!-- open sans -->
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"
            rel="stylesheet"
        />
    </head>
    <body>
        <div class="main-wrapper toggled">
            <ul
                class="navbar-nav mb-2 mb-lg-0 position-fixed sidebar toggled"
                id="accordionSidebar"
            >
                <div
                    class="db-title px-2 px-md-4 py-3 d-flex align-items-center justify-content-center"
                >
                    <div class="d-inline-block icon">
                        <i class="fa fa-n fa-2x me-2"></i>
                    </div>
                    <div class="text-lg fw-bold mx-1 name">News ad</div>
                </div>
                <div class="sidebar-divider"></div>
                <li class="nav-item mb-2">
                    <a
                        class="nav-link active"
                        aria-current="page"
                        href="index.html"
                        ><i class="fa fa-dashboard"></i>
                        <span>Dashboard</span></a
                    >
                </li>
                <div class="sidebar-heading text-white-50">Manage</div>
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseOne"
                        aria-expanded="true"
                        aria-controls="collapseOne"
                    >
                        <i class="fas fa-fw fa-user"></i>
                        <span>User</span>
                    </a>
                    <div
                        id="collapseOne"
                        class="collapse"
                        aria-labelledby="headingOne"
                        data-parent="#accordionSidebar"
                    >
                        <div class="collapse-inner">
                            <a class="collapse-item" href="users.html">Users</a>
                            <a class="collapse-item" href="add-user.html"
                                >Add User</a
                            >
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo"
                        aria-expanded="true"
                        aria-controls="collapseTwo"
                    >
                        <i class="fa fa-fw fa-newspaper-o"></i>
                        <span>Post</span>
                    </a>
                    <div
                        id="collapseTwo"
                        class="collapse"
                        aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar"
                    >
                        <div class="collapse-inner">
                            <a class="collapse-item" href="posts.html">Posts</a>
                            <a class="collapse-item" href="add-post.html"
                                >Add Post</a
                            >
                        </div>
                    </div>
                </li>
            </ul>

            <div class="content-wrapper d-flex flex-column">
                <div class="content">
                    <div class="container-fluid bg-white shadow px-4">
                        <nav class="navbar navbar-expand-lg c-topbar py-0 mb-4">
                            <button
                                id="sidebarToggleTop"
                                class="sidebar-toggler btn btn-link me-3"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent"
                                aria-expanded="false"
                                aria-label="Toggle navigation"
                            >
                                <i class="fa fa-bars"></i>
                            </button>

                            <ul
                                class="navbar-nav flex-row align-items-center ms-auto"
                            >
                                <li
                                    class="nav-item dropdown d-sm-none d-inline-block"
                                >
                                    <a
                                        class="nav-link"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        ><i class="fas fa-search"></i
                                    ></a>
                                    <div class="dropdown-menu shadow">
                                        <form action="">
                                            <div class="input-group">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="notification"
                                                    aria-label="Recipient's username"
                                                    aria-describedby="button-addon2"
                                                />
                                                <button
                                                    class="btn btn-primary"
                                                    type="button"
                                                    id="button-addon2"
                                                >
                                                    <i
                                                        class="fas fa-search"
                                                    ></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a
                                        class="nav-link"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        ><i class="fas fa-bell"></i
                                    ></a>
                                    <div
                                        class="dropdown-menu dropdown-menu-list shadow"
                                    >
                                        <h6 class="dropdown-header">
                                            notification header
                                        </h6>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <div class="icon bg-primary me-3">
                                                <i class="fas fa-list"></i>
                                            </div>
                                            <div class="content">
                                                <span class="c-secondary-text"
                                                    >December 12, 2020</span
                                                >
                                                <span class="c-main-text"
                                                    >A new monthly report is
                                                    ready to download.</span
                                                >
                                            </div>
                                        </a>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <div class="icon bg-primary me-3">
                                                <i class="fas fa-list"></i>
                                            </div>
                                            <div class="content">
                                                <span class="c-secondary-text"
                                                    >December 12, 2020</span
                                                >
                                                <span class="c-main-text"
                                                    >A new monthly report is
                                                    ready to download.</span
                                                >
                                            </div>
                                        </a>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <div class="icon bg-primary me-3">
                                                <i class="fas fa-list"></i>
                                            </div>
                                            <div class="content">
                                                <span class="c-secondary-text"
                                                    >December 12, 2020</span
                                                >
                                                <span class="c-main-text"
                                                    >A new monthly report is
                                                    ready to download.</span
                                                >
                                            </div>
                                        </a>
                                        <a
                                            href=""
                                            class="dropdown-item text-center"
                                        >
                                            <span class="text-xs text-gray-600"
                                                >Show all noti</span
                                            >
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a
                                        class="nav-link"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        ><i class="fas fa-envelope"></i
                                    ></a>
                                    <div
                                        class="dropdown-menu dropdown-menu-list shadow"
                                    >
                                        <h6 class="dropdown-header">
                                            notification header
                                        </h6>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <div class="icon bg-primary me-3">
                                                <i class="fas fa-list"></i>
                                            </div>
                                            <div class="content">
                                                <span
                                                    class="c-main-text text-truncate mb-1"
                                                    >A new monthly report is now
                                                    able to download.
                                                </span>
                                                <span class="c-secondary-text"
                                                    >Ben Tennyson . 39m</span
                                                >
                                            </div>
                                        </a>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <div class="icon bg-primary me-3">
                                                <i class="fas fa-list"></i>
                                            </div>
                                            <div class="content">
                                                <span
                                                    class="c-main-text text-truncate mb-1"
                                                    >A new monthly report is now
                                                    able to download.
                                                </span>
                                                <span class="c-secondary-text"
                                                    >December 12, 2020</span
                                                >
                                            </div>
                                        </a>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <div class="icon bg-primary me-3">
                                                <i class="fas fa-list"></i>
                                            </div>
                                            <div class="content">
                                                <span
                                                    class="c-main-text text-truncate mb-1"
                                                    >A new monthly report is now
                                                    able to download.
                                                </span>
                                                <span class="c-secondary-text"
                                                    >December 12, 2020</span
                                                >
                                            </div>
                                        </a>
                                        <a
                                            href=""
                                            class="dropdown-item text-center"
                                        >
                                            <span class="text-xs text-gray-600"
                                                >Show all noti</span
                                            >
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown avator-nav">
                                    <a
                                        class="nav-link"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <span
                                            class="text-sm d-none d-lg-inline-block me-2"
                                            >John maclane</span
                                        >
                                        <div class="c-avator"></div
                                    ></a>
                                    <div
                                        class="dropdown-menu avator-menu shadow"
                                    >
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <i class="fas fa-user me-3"></i>
                                            <span class="">Profile</span>
                                        </a>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <i class="fas fa-wrench me-3"></i>
                                            <span class="">Profile</span>
                                        </a>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <i class="fas fa-list me-3"></i>
                                            <span class="">Acitivity log</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a
                                            href=""
                                            class="dropdown-item d-flex align-items-center"
                                        >
                                            <i class="fas fa-sign-out me-3"></i>
                                            <span class="">Log out</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Page Content -->
                    <div class="container-fluid px-4">
                        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div
                                    class="card shadow border-left-primary h-100 py-2"
                                >
                                    <div class="card-body">
                                        <div
                                            class="row align-items-center mx-0 flex-nowrap"
                                        >
                                            <div class="col-8 me-auto px-0">
                                                <span
                                                    class="text-xs text-wrap fw-bold text-primary text-uppercase mb-1 d-block"
                                                    >Total Users</span
                                                >
                                                <span
                                                    class="h5 fw-bold text-gray-800"
                                                    >40,000</span
                                                >
                                            </div>
                                            <div class="col-auto px-0">
                                                <i
                                                    class="fas fa-users fa-2x"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div
                                    class="card shadow border-left-primary h-100 py-2"
                                >
                                    <div class="card-body">
                                        <div
                                            class="row align-items-center mx-0 flex-nowrap"
                                        >
                                            <div class="col-8 me-auto px-0">
                                                <span
                                                    class="text-xs text-wrap fw-bold text-primary text-uppercase mb-1 d-block"
                                                    >Total Posts</span
                                                >
                                                <span
                                                    class="h5 fw-bold text-gray-800"
                                                    >900,000</span
                                                >
                                            </div>
                                            <div class="col-auto px-0">
                                                <i
                                                    class="fa fa-newspaper-o fa-2x"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div
                                    class="card shadow border-left-primary h-100 py-2"
                                >
                                    <div class="card-body">
                                        <div
                                            class="row align-items-center mx-0 flex-nowrap"
                                        >
                                            <div class="col-8 me-auto px-0">
                                                <span
                                                    class="text-xs text-wrap fw-bold text-primary text-uppercase mb-1 d-block"
                                                    >Total Comments</span
                                                >
                                                <span
                                                    class="h5 fw-bold text-gray-800"
                                                    >30,000</span
                                                >
                                            </div>
                                            <div class="col-auto px-0">
                                                <i
                                                    class="fas fa-comments fa-2x"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">

                                <div
                                    class="card shadow border-left-primary h-100 py-2"
                                >
                                    <div class="card-body">
                                        <div
                                            class="row align-items-center mx-0 flex-nowrap"
                                        >
                                            <div class="col-8 me-auto px-0">
                                                <span
                                                    class="text-xs text-wrap fw-bold text-primary text-uppercase mb-1 d-block"
                                                    >Total View</span
                                                >
                                                <span
                                                    class="h5 fw-bold text-gray-800"
                                                    >40,000</span
                                                >
                                            </div>
                                            <div class="col-auto px-0">
                                                <i
                                                    class="fas fa-calendar fa-2x"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="backdrop hide"></div>
        </div>

        <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>
