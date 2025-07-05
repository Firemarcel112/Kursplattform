<div @class(['mb-3', 'form-floating', $divClass])>
    <input {{ $attributes->except('class')->merge([
        'class' => 'form-control ' . $inputClass . ($errors->has($name) ? ' is-invalid' : ''),
    ]) }} @required($required) id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}">

    @if ($label)
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
