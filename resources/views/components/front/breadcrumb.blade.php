<nav aria-label="breadcrumb">
    <div class="container">
        <div class="my-3 my-lg-5 mx-lg-3">
            <ol class="breadcrumb fs-5">
                <li class="breadcrumb-item">
                    <a href="{{ route('page.index') }}">Home</a>
                </li>
                {{ $slot }}
            </ol>
        </div>
    </div>
</nav>
