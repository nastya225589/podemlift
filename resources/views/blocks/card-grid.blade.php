<article class="card">
    <a class="card__inner" href="{{ $item->getUrl() }}">
        <img class="card__img" src="{{ $item->firstImage()->size(260, 260)->url }}" width="260" height="260" alt="{{ $item->name }}"/>
        <div>
            <h2 class="card__name">{{ $item->name }}</h2>
            <ul class="card__list">
                @if(count($item->properties) > 5)
                    @php($loopTo = 5)
                @else
                    @php($loopTo = count($item->properties))
                @endif
                @for($i = 0; $i < $loopTo; $i++)
                    <li class="card__item">
                        <div>{{ $item->properties[$i]->name }}</div>
                        <div class="card__dots">
                            <div class="card__dot"></div>
                            <div class="card__value">{{ $item->properties[$i]->value . ' ' . $item->properties[$i]->measure }}</div>
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </a>
    <div class="card__wrap">
        <p class="card__buy">От <span>{{ $item->price }}</span> руб.</p>
        <a class="btn card__btn" href="{{ $item->getUrl() }}">
            <span>Подробнее</span>
        </a>
    </div>
</article>
