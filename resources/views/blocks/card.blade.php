<article class="card {{ UserConfig::catalogListingInline() ? 'card__sorting-view' : '' }}">
    <a class="card__inner" href="/catalog/child">
        <img class="card__img" src="{{ $product->firstImage()->size(260, 260)->url }}" width="260" height="260" alt="{{ $product->name }}"/>
        <div>
            <h2 class="card__name">{{ $product->name }}</h2>
            <ul class="card__list">
                <li class="card__item">
                    <div>Грузоподъемность</div>
                    <div class="card__dots">
                        <div class="card__dot"></div>
                        <div class="card__value">до 2000 кг</div>
                    </div>
                </li>
                <li class="card__item">
                    <div>Высота подъема</div>
                    <div class="card__dots">
                        <div class="card__dot"></div>
                        <div class="card__value">до 50 м</div>
                    </div>
                </li>
            </ul>
        </div>
    </a>
    <div class="card__wrap">
        <p class="card__buy">От <span>{{ $product->price }}</span> руб.</p>
        <a class="btn card__btn" href="/catalog/child">
            <span>Подробнее</span>
        </a>
    </div>
</article>
