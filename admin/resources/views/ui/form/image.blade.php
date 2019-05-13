<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @include('admin::ui.form.label')

    @php($val = old($name, $value ?? null))

    <input type="file" class="upload-image-file" style="display: none"/>
    <input type="hidden" value="{{ $val }}" name="{{ $name }}" class="upload-image-id">

    <div class="input-group mb-3">
        <input type="text" value="{{ image($val)->alt }}" class="upload-image-name form-control" placeholder="Название">
        <div class="input-group-append upload-image-button">
            <span class="input-group-text">
                <span class="upload-image-preview">
                    @if($val)
                        <img src="{{ image($val)->url }}">
                    @endif
                </span>
                <i class="fas fa-cloud-upload-alt"></i>
            </span>
        </div>
    </div>

    @include('admin::ui.form.error')
</div>