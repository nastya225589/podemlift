<form class="filters" id="filters-form">
    <button class="filters__btn-close btn"></button>
    @foreach($filters as $filter)
        @if($filter['type'] == 'text' && $filter['values'] !== null)
            <fieldset>
                <div class='field-checkbox'>
                    <div class="field-checkbox__name">{{ $filter['name'] }}</div>
                    <div class="field-checkbox__checkbox-wrap">
                        <div class="field-checkbox__checkbox" id="scope-checkbox">
                            @foreach($filter['values'] as $key => $value)
                            <p>
                                @if(Request::get($filter['slug']))
                                    <input {{ in_array($key, Request::get($filter['slug'])) ? 'checked' : '' }} value="{{ $key }}" name="{{ $filter['slug'].'[]' }}" type="checkbox" id="{{ $filter['slug'] . $key }}" class="field-checkbox__input"
                                    style="display:none">
                                @elseif(isset($singleValue))
                                    <input {{ ($key === $singleValue && $filter['slug'] === $singleProperty) ? 'checked' : '' }} value="{{ $key }}" name="{{ $filter['slug'].'[]' }}" type="checkbox" id="{{ $filter['slug'] . $key }}" class="field-checkbox__input"
                                    style="display:none">
                                @else
                                    <input value="{{ $key }}" name="{{ $filter['slug'].'[]' }}" type="checkbox" id="{{ $filter['slug'] . $key }}" class="field-checkbox__input"
                                    style="display:none">
                                @endif
                                <label for="{{ $filter['slug'] . $key }}" class="field-checkbox__check">
                                    <span>
                                        <svg width="22px" height="15px">
                                            <use xlink:href="#check">
                                                <symbol id="check" viewBox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                                </symbol>
                                            </use>
                                        </svg>
                                    </span>
                                    <span>{{ $value }}</span>
                                </label>
                            </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </fieldset>
        @elseif($filter['type'] == 'number' && $filter['values'] !== null)
            <fieldset>
                <div class="field-weight">
                    <div class="field-weight__name">{{ $filter['name'] . ', до' }}</div>
                    <div class="field-weight__range-wrap">
                        <div class="field-weight__range" id="weight-range">
                            <div class="slider-item">
                                <div class="wrap" style="--min: {{ $filter['values']['min'] }};--max: {{ $filter['values']['max'] }};--val: {{ Request::get($filter['slug']) ?: $filter['values']['max'] }};">
                                    <input name="{{ Request::get($filter['slug']) ? $filter['slug'] : '' }}" slug="{{ $filter['slug'] }}" min="{{ $filter['values']['min'] }}" max="{{ $filter['values']['max'] }}" id="range-input" class="slider range-input" type="range" value="{{ Request::get($filter['slug']) ?: $filter['values']['max'] }}" />
                                    <output for="range-input">{{ Request::get($filter['slug']) ?: $filter['values']['max'] }}</output>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        @endif
    @endforeach
    <button class="btn filters__btn">Применить</button>
    <div class="filters__btn-clear_wrap">
        <span class="filters__btn-clear--icon"></span>
        <button class="btn filters__btn-clear">Сбросить фильтры</button>
    </div>
</form>
