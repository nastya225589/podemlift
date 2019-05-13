<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @include('admin::ui.form.label')

    <textarea name="{{ $name }}"
              id="{{ $name }}"
              class="form-control {{ $class ?? '' }}"
              placeholder="{{ $placeholder ?? '' }}"
              rows="{{ $rows ?? 3 }}"
              style="{{ ($resizable ?? true) ? '' : 'resize: none' }}"
        {{ ($disabled ?? false) ? 'disabled="disabled"' :  '' }}
        {{ ($required ?? false) ? 'required="true"' :  '' }}
    >{!! old($name, $value ?? null) !!}</textarea>

    @include('admin::ui.form.error')
</div>