<ul class="navbar-nav mb-2 mb-lg-0 position-fixed sidebar" id="accordionSidebar">

    <a href="{{ route('page.dashboard') }}" class="db-title px-2 px-md-4 py-3 d-flex align-items-center justify-content-center">
        <div class="d-inline-block icon">
            ND
        </div>
        <div class="text-lg fw-bold mx-1 name">New day</div>
    </a>

    <div class="sidebar-divider"></div>

    <li class="nav-item mb-2">
        <a class="nav-link {{ request()->routeIs('page.dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('page.dashboard') }}"><i class="bi bi-speedometer"></i>
            <span>Dashboard</span></a>
    </li>

    <div class="sidebar-heading text-white-50">Manage</div>

    @admin
        <x-dashboard.sidebar.collapse-link title="User" icon="bi bi-people-fill" target="#UserCollapse" id="UserCollapse"
            active="{{ Str::contains(request()->path(), 'dashboard/user') }}">
            <a class="collapse-item" href="{{ route('dashboard.user.index') }}">Users</a>
            <a class="collapse-item" href="{{ route('dashboard.user.create') }}">Add User</a>
        </x-dashboard.sidebar.collapse-link>
    @endadmin

    <x-dashboard.sidebar.collapse-link title="Post" icon="bi bi-newspaper" target="#PostCollapse" id="PostCollapse"
        active="{{ Str::contains(request()->path(), 'dashboard/post') }}">
        <a class="collapse-item" href="{{ route('dashboard.post.index') }}">Posts</a>
        <a class="collapse-item" href="{{ route('dashboard.post.create') }}">Add Post</a>
        
    </x-dashboard.sidebar.collapse-link>

    <x-dashboard.sidebar.collapse-link title="Category" icon="bi bi-list" target="#CategoryCollapse"
        id="CategoryCollapse" active="{{ Str::contains(request()->path(), 'dashboard/category') }}">
        <a class="collapse-item" href="{{ route('dashboard.category.index') }}">Categories</a>
        @can('create', App\Models\Category::class)
            <a class="collapse-item" href="{{ route('dashboard.category.create') }}">Add Category</a>
        @endcan

    </x-dashboard.sidebar.collapse-link>

    <li class="nav-item mb-2">
        <a class="nav-link {{ request()->routeIs('dashboard.comment.index') ? 'active': '' }}" aria-current="page" href="{{ route('dashboard.comment.index') }}"><i
                class="bi bi-chat"></i>
            <span>Comments</span></a>
    </li>

</ul>
