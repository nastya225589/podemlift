<section class="portfolio portfolio-item">
    <div class="portfolio__wrap">
        @foreach ($page->works as $item)
            <article class="card">
                <a class="card__inner" href="/portfolio-card/{{ $item->slug }}">
                    <img src="{{ $item->firstImage()->size(260)->url }}" width="260" height="260" alt="{{ $item->name }}">
                    <div>
                        <h3 class="card__name">{{ $item->name }}</h3>
                        <p class="text">{{ $item->introtext }}</p>
                    </div>
                    <a class="btn card__btn" href="/portfolio-card/{{ $item->slug }}">
                        <span>Подробнее</span>
                    </a>
                </a>
            </article>
        @endforeach
    </div>
</section>
