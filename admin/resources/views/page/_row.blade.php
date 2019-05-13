@component('admin::ui.list.row', ['id' => $model->id, 'nestable' => true])
    <div>
        {{ str_limit($model->name, 70) }}
    </div>
    <div>
        @if($model->published)
            <i class="fas fa-eye" style="margin-right: 10px"></i>
        @else
            <i class="fas fa-eye-slash" style="margin-right: 10px"></i>
        @endif

        <a href="{{ route($name . '.edit', ['id' => $model->id]) }}"><i class="far fa-edit"></i></a>
        <a onclick="return confirm('Создать копию страницы?');" href="{{ route($name . '.copy', ['id' => $model->id]) }}" class="ml-3 mr-3"><i class="far fa-copy"></i></a>
        <a onclick="return confirm('Создать дочернюю страницу?');" href="{{ route($name . '.child', ['id' => $model->id]) }}"class="mr-3"><i class="fas fa-child"></i></a>

        @component('admin::ui.form.delete', ['route' => route($name . '.destroy', ['id' => $model->id])])
        @endcomponent
    </div>

    @if($model->childrens->count())
        @slot('child')
        @component('admin::ui.list.list')
            @foreach($model->childrens as $model)
                @includeFirst(["admin.{$name}._row", "admin::{$name}._row", "admin::base._row"], [
                    'model' => $model
                ])
            @endforeach
        @endcomponent
        @endslot
    @endif
@endcomponent