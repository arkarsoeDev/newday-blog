<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    @if (isset($title))
        <label for="{{ $id }}" class="form-label">{{ $title }}</label>
    @endif
    {{ $slot }}

    {{-- showing errors --}}
    @if (isset($nameArr))
        @if ($errors->has("$nameArr.*"))
            <div class="alert alert-danger p-2 mt-3">{{ $errors->first("$nameArr.*") }}</div>
        @elseif ($errors->has("$nameArr"))
            <div class="alert alert-danger p-2 mt-3">{{ $errors->first("$nameArr") }}</div>
        @endif
    @elseif(isset($body))
        @error("$name")
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    @else
        @error("$name")
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    @endif
</div>
