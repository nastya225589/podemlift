@php ($portfolio = \App\Models\WorkCategory::published()->get())
<section class="portfolio">
    <div class="portfolio__list">
        @foreach ($portfolio as $item)
            <div class="portfolio__item">
                <a href="/portfolio-item/{{ $item->slug }}">
                    <h2 class="title-h2">{{ $item->name }}</h2>
                </a>
                <div class="portfolio__wrap">
                    @foreach ($item->works()->take(4)->get() as $card)
                        <article class="card">
                            <a class="card__inner" href="/portfolio-card/{{ $card->slug }}">
                                <img src="{{ $card->firstImage()->url }}" width="260" height="260" alt="Грузовые лифты">
                                <div>
                                    <h3 class="card__name">{{ $item->name }}</h3>
                                    <p class="text">{{ $card->introtext }}</p>
                                </div>
                                <a class="btn card__btn" href="/portfolio-card/{{ $card->slug }}">
                                    <span>Подробнее</span>
                                </a>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
