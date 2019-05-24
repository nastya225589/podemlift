@extends('admin::layouts.admin_list')

@section('controls')
    <a class="btn btn-outline-primary" href="{{ route($route . '.create') }}"><i class="fas fa-plus"></i> Добавить</a>
@endsection

@section('links')
    {{ $models->links() }}
@endsection

@section('list')
    @foreach ($models as $model)
        @includeFirst(["admin.{$name}._row", "admin::{$name}._row", "admin::base._row"])
    @endforeach
@endsection
