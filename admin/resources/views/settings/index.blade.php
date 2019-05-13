@extends('admin::layouts.admin_form')

@section('action', route($name . '.index'))

@section('controls')
    <button type="submit" class="btn btn-outline-primary"><i class="far fa-save"></i> Сохранить</button>
@endsection

@section('fields')
    @foreach ($groups as $models)
        @foreach ($models as $model)
            @if ($loop->first)
                <h3>{{ $model->group }}</h3>
            @endif
            @includeIf('admin::ui.form.' . $model->type, [
                'name' => $model->name,
                'label' => $model->label,
                'value' => $model->value
            ])
        @endforeach
    @endforeach
@endsection
