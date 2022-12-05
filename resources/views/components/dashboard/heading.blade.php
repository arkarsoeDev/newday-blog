@props(['back'=>true])
<div class="d-flex align-items-center mb-4">
    <h1 class="h3 text-gray-800 d-inline-block">{{ $slot }}</h1>
    @if ($back)
        <div class="flex-fill"></div>
        <a href="{{ url()->previous() }}"
            class="btn btn-primary ml-auto text-white fw-bold text-decoration-none border shadow"><i
                class="bi bi-chevron-left me-1"></i> <span class="d-none d-sm-inline-block">
                Back
            </span>
        </a>
    @endif
</div>
