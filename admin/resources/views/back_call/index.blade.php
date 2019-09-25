@extends('admin::layouts.admin_list')

@section('links')
    {{ $models->links() }}
@endsection

@section('list')
    @foreach ($models as $model)
        @component('admin::ui.list.row', ['autoWidth' => true])
            <div>{{ $model->phone }}</div>
            <div>{{ $model->created_at->formatLocalized('%d %B %Y %H:%M') }}</div>
            <div>
                <a href="#info-{{ $model->id }}" data-toggle="modal">
                    <i class="far fa-eye"></i>
                </a>
                <div id="info-{{ $model->id }}" class="modal fade bd-example-modal-lg"
                     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                                <div class="text-center">
                                    @if ($model->firstname)
                                        <div class="bg-light"><strong>Имя:</strong></div>
                                        <div>{{ $model->firstname }}</div>
                                    @endif
                                    <div class="bg-light"><strong>Телефон:</strong></div>
                                    <div>{{ $model->phone }}</div>
                                    @if ($model->email)
                                        <div class="bg-light"><strong>Email:</strong></div>
                                        <div>{{ $model->email }}</div>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcomponent
    @endforeach
@endsection

