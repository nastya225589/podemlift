<article class="card">
    <a class="card__inner" href="/">
        <img class="card__img" src="{{ $product->firstImage()->size(260, 260)->url }}" width="260" height="260" alt="Грузовые лифты"/>
        <h2 class="card__name">{{ $product->name }}</h2>
        <ul class="card__list">
            <li class="card__item">Грузоподъемность ...... до <span>2000</span> кг</li>
            <li class="card__item">Высота подъема ......... до <span>50</span> м</li>
        </ul>

    </a>
    <div class="card__wrap">
        <p class="card__buy">От <span>{{ $product->price }}</span> руб.</p>
        <a class="btn card__btn" onclick="alert('TODO'); return">
            <span>Подробнее</span>
        </a>
    </div>
</article>
