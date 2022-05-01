<div class="mb-3">
    <label
        for="{{ $id }}"
        class="form-label text-capitalize">
        {{ $title }}
    </label>
    <select
        name="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $id }}"
        @if ($required) required @endif>
        {{ $slot }}
    </select>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <small>{{ $info }}</small>
</div>