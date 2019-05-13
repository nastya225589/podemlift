<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @include('admin::ui.form.label')

    <input type="text"
           class="form-control timepicker {{ $class ?? '' }}"
           name="{{ $name }}"
           value="{{ old($name, $value ?? null) }}"
            {{ isset($required) ? 'required' :  '' }}
            {{ isset($disabled) ? 'disabled' :  '' }}
    />

    @include('admin::ui.form.error')
</div>