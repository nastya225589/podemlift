@component('admin::ui.list.row', ['id' => $model->id, 'nestable' => true])
    <div>
        {{ \Illuminate\Support\Str::limit($model->name, 70) }}
    </div>
    <div>
        @if($model->in_menu)
            <i class="fas fa-bars mr-3" data-toggle="tooltip" title="Выводится в меню"></i>
        @endif

        @if($model->published)
            <i class="fas fa-eye mr-3" data-toggle="tooltip" title="Опубликован"></i>
        @else
            <i class="fas fa-eye-slash mr-3" data-toggle="tooltip" title="Не опубликован"></i>
        @endif

        <a data-toggle="tooltip" title="Редактировать" href="{{ route($route . '.edit', ['id' => $model->id]) }}"><i class="far fa-edit"></i></a>
        <a data-toggle="tooltip" title="Создать копию страницы" onclick="return confirm('Создать копию страницы?');" href="{{ route($route . '.copy', ['id' => $model->id]) }}" class="ml-3 mr-3"><i class="far fa-copy"></i></a>
        <a data-toggle="tooltip" title="Создать дочернюю страницу" onclick="return confirm('Создать дочернюю страницу?');" href="{{ route($route . '.child', ['id' => $model->id]) }}"class="mr-3"><i class="fas fa-stream"></i></a>

        @component('admin::ui.form.delete', ['route' => route($route . '.destroy', ['id' => $model->id])])
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
