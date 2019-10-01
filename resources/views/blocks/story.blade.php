<li class="story__item">
    <div class="story__photo">
        <img class="story__img" src="{{ $item->image->url }}" alt="">
    </div>
    <div class="story__desc">
        <a href="/story-card/{{ $item->slug }}" class="story__name">{{ $item->name }}</a>
        <p class="story__text text">{!! Str::limit(strip_tags($item->text), 300, '...') !!}</p>
    </div>
</li>
