<li class="nav-item">
    <a class="nav-link collapsed {{ $active ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="{{ $target }}" aria-expanded="true"
        aria-controls="collapseOne">
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    <div id="{{ $id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
        <div class="collapse-inner">
            {{ $slot }}
        </div>
    </div>
</li>
