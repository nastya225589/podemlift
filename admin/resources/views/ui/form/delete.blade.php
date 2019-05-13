<form action="{{ $route }}" class="delete-form" method="POST" onsubmit="return confirm('Удалить?');">
    @method('DELETE')
    {{ csrf_field() }}
    @component('admin::ui.form.button', ['type' => 'submit', 'class' => 'btn btn-link'])
        <i class="far fa-trash-alt"></i>
    @endcomponent
</form>