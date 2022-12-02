<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    @if (isset($title))
        <label for="{{ $id }}" class="form-label">{{ $title }}</label>
    @endif
    {{ $slot }}
    @error("$name")
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
