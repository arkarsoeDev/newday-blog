<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    <label for="{{ $id }}" class="form-label">{{ $title }}</label>
    {{ $slot }}
    @error("$name")
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
