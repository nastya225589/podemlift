<div class="form-group">
    @include('admin::ui.form.label')
    <div class="form-control-static">
        {{ !empty($value) ? $value : '-- --' }}
    </div>
</div>
