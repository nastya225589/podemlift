@inject('filterService', 'App\Services\Contracts\FilterServiceInterface')
    
@php($values = $filterService->getValues($item))
<article class="card">
    <a class="card__inner" href="{{ $item->url }}">
        <img class="card__img" src="{{ $item->image() }}" width="260" height="260" alt="{{ $item->name }}"/>
        <div>
            <h2 class="card__name">{{ $item->name }}</h2>
            <ul class="card__list">
                @if(count($values) > 5)
                    @php($loopTo = 5)
                @else
                    @php($loopTo = count($values))
                @endif
                @for($i = 0; $i < $loopTo; $i++)
                    <li class="card__item">
                        <div>{{ $values[$i]['name'] }}</div>
                        <div class="card__dots">
                            <div class="card__dot"></div>
                            <div class="card__value">
                                от {{ $values[$i]['values']['min'] }} - до {{ $values[$i]['values']['max'] }} {{$values[$i]['values']['measure']}}
                            </div>
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </a>
    <div class="card__wrap">
        <p class="card__buy">От <span>{{ $item->price() }}</span> руб.</p>
        <a class="btn card__btn" href="{{ $item->url }}">
            <span>Подробнее</span>
        </a>
    </div>
</article>
