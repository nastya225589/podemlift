<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @php($type = $type ?? 'text')
    @if($type != 'hidden')
        @include('admin::ui.form.label')
    @endif

    <input id="{{ $id ?? $name }}"
           type="{{ $type }}"
           class="form-control {{ $class ?? '' }}"
           placeholder="{{ $placeholder ?? '' }}"
           name="{{ $name }}"
           value="{{ old($name, $value ?? null) }}"
            {{ isset($step)&&!empty($step) ? "step=$step" : '' }}
            {{ isset($min)&&!empty($min) ? "min=$min" : '' }}
            {{ isset($required)&&!empty($required) ? "required" :  '' }}
            {{ isset($disabled)&&!empty($disabled) ? "disabled" :  '' }}
            {!! isset($custom) ? implode($custom, ' ') : '' !!}
    />

    @include('admin::ui.form.error')
</div>