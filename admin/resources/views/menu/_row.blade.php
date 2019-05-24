@component('admin::ui.list.row', ['id' => $model->id, 'nestable' => true])
    <div>{{ $model->name }}</div>
    <div>
        <a href="{{ route($route . '.edit', ['id' => $model->id]) }}"><i class="far fa-edit"></i></a>
        <a href="{{ route($route . '.copy', ['id' => $model->id]) }}" class="ml-3 mr-3"><i class="far fa-copy"></i></a>
        <a href="{{ route($route . '.child', ['id' => $model->id]) }}"class="mr-3"><i class="fas fa-child"></i></a>
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
