@extends('admin::layouts.admin_list')

@section('links')
    {{ $models->links() }}
@endsection

@section('list')
    @foreach ($models as $model)
        @component('admin::ui.list.row', ['autoWidth' => true])
            <div>{{ $model->firstname }}</div>
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
                                    <div class="bg-light"><strong>Имя:</strong></div>
                                    <div>{{ $model->firstname }}</div>
                                    <div class="bg-light"><strong>Организация:</strong></div>
                                    <div>{{ $model->organization }}</div>
                                    <div class="bg-light"><strong>Телефон:</strong></div>
                                    <div>{{ $model->phone }}</div>
                                    @if ($model->email)
                                        <div class="bg-light"><strong>Адрес электронной почты:</strong></div>
                                        <div>{{ $model->email }}</div>
                                    @endif
                                    @if ($model->mailing_address)
                                        <div class="bg-light"><strong>Почтовый адрес:</strong></div>
                                        <div>{{ $model->mailing_address }}</div>
                                    @endif
                                    @if ($model->delivery_at)
                                        <div class="bg-light"><strong>Желаемая или максимальная дата поставки/монтажа:</strong></div>
                                        <div>{{ $model->delivery_at }}</div>
                                    @endif
                                    @if ($model->delivery)
                                        <div class="bg-light"><strong>Доставка и монтаж:</strong></div>
                                        <div>{{ $model->delivery }}</div>
                                    @endif
                                    @if ($model->carrying)
                                        <div class="bg-light"><strong>Грузоподъемность, кг:</strong></div>
                                        <div>{{ $model->carrying }}</div>
                                    @endif
                                    @if ($model->lift)
                                        <div class="bg-light"><strong>Высота подъема:</strong></div>
                                        <div>{{ $model->lift }}</div>
                                    @endif
                                    @if ($model->type_of_lift)
                                        <div class="bg-light"><strong>Тип подъемника:</strong></div>
                                        <div>{{ $model->type_of_lift }}</div>
                                    @endif
                                    @if ($model->place)
                                        <div class="bg-light"><strong>Место установки:</strong></div>
                                        <div>{{ $model->place }}</div>
                                    @endif
                                    @if ($model->number_of_stops)
                                        <div class="bg-light"><strong>Количество фиксированных остановок:</strong></div>
                                        <div>{{ $model->number_of_stops }}</div>
                                    @endif
                                    @if ($model->load_method)
                                        <div class="bg-light"><strong>Способ загрузки платформы:</strong></div>
                                        @php ($load_methods = collect($model->load_method))
                                        <div>{{ $load_methods->implode(', ') }}</div>
                                    @endif
                                    @if ($model->type_of_platform)
                                        <div class="bg-light"><strong>Тип платформы:</strong></div>
                                        <div>{{ $model->type_of_platform }}</div>
                                    @endif
                                    <div class="bg-light"><strong>Откидные борты на платформе со сторон загрузки/выгрузки:</strong></div>
                                    <div>{{ $model->tailgate ? 'Да' : 'Нет' }}</div>
                                    <div class="bg-light"><strong>Распашные двери платформы подъемника со сторон загрузки:</strong></div>
                                    <div>{{ $model->swing_doors ? 'Да' : 'Нет' }}</div>
                                    <div class="bg-light"><strong>Системы сигнализации:</strong></div>
                                    <div>{{ $model->signaling ? 'Да' : 'Нет' }}</div>
                                    @if ($model->additionally)
                                        <div class="bg-light"><strong>Примечания:</strong></div>
                                        <div>{{ $model->additionally }}</div>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcomponent
    @endforeach
@endsection

