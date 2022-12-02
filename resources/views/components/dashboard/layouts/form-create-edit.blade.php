<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card c-card mb-3">
            <div class="card-body">
                <h2 class="h4">{{ $title }} {{ $control ?? 'Create' }}</h2>
                <hr>
                {{ $slot }}
            </div>
        </div>
    </div>
    @if(isset($rightSide))
    <div class="col-12 col-lg-4">
        <div class="row">
            {{ $rightSide }}
        </div>
    </div>
    @endif
</div>
