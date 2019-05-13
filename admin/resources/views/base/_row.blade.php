@component('admin::ui.list.row')
    <div>{{ $model->name }}</div>
    <div>
        <a href="{{ route($name . '.edit', ['id' => $model->id]) }}" class="mr-3"><i class="far fa-edit"></i></a>
        @component('admin::ui.form.delete', ['route' => route($name . '.destroy', ['id' => $model->id])])
        @endcomponent
    </div>
@endcomponent