@props(['value' => old($name)])

<div @class(['form-floating mb-3 position-relative', $divClass])>
    <input {{ $attributes->except('class')->merge([
        'class' => 'form-control ' . $inputClass . ($errors->has($name) ? ' is-invalid' : ''),
    ]) }} id="{{ $name }}" name="{{ $name }}" placeholder="{{ $label }}" type="password" value="{{ $value }}">

    <label for="{{ $name }}">{{ $label }}</label>

    <span class="password-toggle position-absolute top-50 end-0 translate-middle-y me-3" data-input-id="{{ $name }}" style="cursor: pointer;">
        <x-icon name="eye" />
    </span>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
