<section class="portfolio portfolio-card">
    <section class="examples">
        <div class="container">
            <div class="examples__list">
                @foreach ($page->images() as $item)
                    <div class="examples__item">
                        <img style="min-width: 180px" src="{{ $item->size(180, 300)->url }}" alt="photo" class="examples__photo" width="180" height="300">
                        <p class="examples__desc">
                            {{ $page->introtext ?: $page->name }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="text">
        {!! $page->text !!}
    </div>
</section>
