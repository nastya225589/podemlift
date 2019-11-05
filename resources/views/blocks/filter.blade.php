<form class="filters" id="filters-form">
    <button class="filters__btn-close btn"></button>
    @foreach($filters as $filter)
        @if($filter['type'] == 'text' && $filter['values'] !== null && count($filter['values']) > 1)
            <fieldset>
                <div class='field-checkbox'>
                    <div class="field-checkbox__name">{{ $filter['name'] }}</div>
                    <div class="field-checkbox__checkbox-wrap">
                        <div class="field-checkbox__checkbox" id="scope-checkbox">
                            @foreach($filter['values'] as $key => $value)
                            <p>
                                @if(Request::get($filter['slug']))
                                    <input 
                                        {{ in_array($key, Request::get($filter['slug'])) ? 'checked' : '' }} 
                                        value="{{ $key }}" 
                                        name="{{ $filter['slug'].'[]' }}" 
                                        type="checkbox" 
                                        id="{{ $filter['slug'] . $key }}" 
                                        class="field-checkbox__input"
                                        style="display:none">
                                @elseif(isset($singleValue) && isset($singleProperty))
                                    <input 
                                        {{ ($key == $singleValue && $filter['slug'] == $singleProperty) ? 'checked' : '' }} 
                                        value="{{ $key }}" 
                                        name="{{ $filter['slug'].'[]' }}" 
                                        type="checkbox" 
                                        id="{{ $filter['slug'] . $key }}" 
                                        class="field-checkbox__input"
                                        style="display:none">
                                @else
                                    <input 
                                        value="{{ $key }}" 
                                        name="{{ $filter['slug'].'[]' }}" 
                                        type="checkbox" 
                                        id="{{ $filter['slug'] . $key }}" 
                                        class="field-checkbox__input"
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
        @elseif(($filter['type'] == 'number' || $filter['type'] == 'range') 
            && $filter['values'] !== null && $filter['values']['min'] !== $filter['values']['max'])
            <fieldset>
                <div class="field-weight">
                    <div class="field-weight__name">{{ $filter['name'] . ', до' }}</div>
                    <div class="field-weight__range-wrap">
                        <div class="field-weight__range" id="weight-range">
                            <div class="slider-item">
                                @if(Request::get($filter['slug']))
                                    <div class="wrap" style="--min: {{ $filter['values']['min'] }};--max: {{ $filter['values']['max'] }};--val: {{ Request::get($filter['slug']) }};">
                                        <input 
                                            value="{{ Request::get($filter['slug']) }}"
                                            name="{{ Request::get($filter['slug']) ? $filter['slug'] : '' }}" 
                                            slug="{{ $filter['slug'] }}" 
                                            min="{{ $filter['values']['min'] }}" 
                                            max="{{ $filter['values']['max'] }}" 
                                            id="range-input" class="slider range-input" 
                                            type="range" 
                                        />
                                        <output for="range-input">{{ Request::get($filter['slug']) }}</output>
                                    </div>
                                @elseif(isset($singleValue) && isset($singleProperty))
                                    <div class="wrap" style="--min: {{ $filter['values']['min'] }};--max: {{ $filter['values']['max'] }};--val: {{ $filter['slug'] == $singleProperty ? $singleValue : $filter['values']['max'] }};">
                                        <input 
                                            value="{{ $filter['slug'] == $singleProperty ? $singleValue : $filter['values']['max'] }}"
                                            name="{{ $filter['slug'] == $singleProperty ? $singleProperty : '' }}" 
                                            slug="{{ $filter['slug'] }}" min="{{ $filter['values']['min'] }}" 
                                            max="{{ $filter['values']['max'] }}" 
                                            id="range-input" 
                                            class="slider range-input" 
                                            type="range"
                                        />
                                        <output for="range-input">{{ $filter['slug'] == $singleProperty ? $singleValue : $filter['values']['max'] }}</output>
                                    </div>
                                @else
                                    <div class="wrap" style="--min: {{ $filter['values']['min'] }};--max: {{ $filter['values']['max'] }};--val: {{ $filter['values']['max'] }};">
                                        <input 
                                            name="" 
                                            slug="{{ $filter['slug'] }}" 
                                            min="{{ $filter['values']['min'] }}" 
                                            max="{{ $filter['values']['max'] }}" 
                                            id="range-input" 
                                            class="slider range-input" 
                                            type="range" 
                                            value="{{ $filter['values']['max'] }}"
                                        />
                                        <output for="range-input">{{ $filter['values']['max'] }}</output>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        @endif
    @endforeach
    <button class="btn filters__btn">Применить</button>
    <div class="filters__btn-clear_wrap" reset="{{ isset($resetFiltersUrl) ? $resetFiltersUrl : '' }}">
        <span class="filters__btn-clear--icon"></span>
        <button class="btn filters__btn-clear">Сбросить фильтры</button>
    </div>
    @if(Auth::check() && isset($resetFiltersUrl))
        @if($seoData)
            <a href="/admin/seo-data/{{ $seoData->id }}/edit">Изменить мета-информацию</a>
        @else
            <a href="/admin/seo-data/create?product_category_id={{ $page instanceof App\Models\ProductCategory ? $page->id : '' }}&url=/{{ $singleProperty . '/' . $singleValue }}">Добавить мета-информацию</a>
        @endif
    @endif
</form>
