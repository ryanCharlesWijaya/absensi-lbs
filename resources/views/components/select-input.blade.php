<div class="mb-3">
    <label
        for="{{ $id }}"
        class="form-label text-capitalize">
        {{ $title }}
    </label>
    <select
        name="{{ $name }}"
        class="form-control form-select form-select-lg @error($name) is-invalid @enderror"
        data-control="select2"
        data-placeholder="Select an option"
        data-allow-clear="true"
        id="{{ $id }}"
        @if($multiple) multiple="multiple" @endif
        @if ($required) required @endif>
        {{ $slot }}
    </select>

    @if($multiple && $error_name)
        @error($error_name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @elseif ($multiple == false)
        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @endif
    
    

    <small>{{ $info }}</small>
</div>