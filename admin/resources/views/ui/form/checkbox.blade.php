<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label class="checkbox-inline i-checks required-checkbox">
        <input type="hidden" name="{{ $name }}" value="0">
        <input type="checkbox"
               name="{{ $name }}"
               value="1"
                {{ isset($required) && $required ? 'required' : '' }}
                {{ isset($disabled) && $disabled ? 'disabled' : '' }}
                {{ isset($custom) ? implode($custom, ' ') : '' }}

                @if (isset($value))
                    {{ $value == 1 ? 'checked' : '' }}
                @else
                    {{ $name == 1 ? 'checked' : '' }}
                @endif
        />
        <i></i>
        <span class="name">{{ $label ?? '' }}</span>
    </label>
    @include('admin::ui.form.error')
</div>