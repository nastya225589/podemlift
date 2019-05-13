<div class="form-group">
    @if(trim($slot))
        @php($id = $id ?? str_random(6))
        <label for="{{ $id }}">{{ $slot }}</label>
    @endif
    @include('admin::ui.form.input')
    <small class="error form-text text-danger"></small>
</div>