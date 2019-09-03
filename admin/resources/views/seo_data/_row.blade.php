@component('admin::ui.list.row')
    <div>{{ ($model->category ? $model->category->slug : '') . $model->url }}</div>
    <div>
        <a data-toggle="tooltip" title="Редактировать" href="{{ route($route . '.edit', ['id' => $model->id]) }}" class="mr-3"><i class="far fa-edit"></i></a>
        @component('admin::ui.form.delete', ['route' => route($route . '.destroy', ['id' => $model->id])])
        @endcomponent
    </div>
@endcomponent
