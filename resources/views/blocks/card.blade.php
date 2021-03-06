<article class="card {{ UserConfig::catalogListingInline() ? 'card__sorting-view' : '' }}">
    <a class="card__inner" href="{{ $product->url }}">
        @php ($firstImage = $product->firstImage())
        <img class="card__img" src="{{ is_object($firstImage) ? $firstImage->size(260, 260)->url : '/images/default.png' }}" width="260" height="260" alt="{{ $product->name }}"/>
        <div>
            <h2 class="card__name">{{ $product->name }}</h2>
            <ul class="card__list">
                @if(count($product->properties) > 5)
                    @php($loopTo = 5)
                @else
                    @php($loopTo = count($product->properties))
                @endif
                @for($i = 0; $i < $loopTo; $i++)
                    <li class="card__item">
                        <div>{{ $product->properties[$i]->name }}</div>
                        <div class="card__dots">
                            <div class="card__dot"></div>
                            <div class="card__value">{{ $product->properties[$i]->value . ' ' . $product->properties[$i]->measure }}</div>
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </a>
    <div class="card__wrap">
        <p class="card__buy">От <span>{{ $product->price }}</span> руб.</p>
        <a class="btn card__btn" href="{{ $product->url }}">
            <span>Подробнее</span>
        </a>
    </div>
</article>
